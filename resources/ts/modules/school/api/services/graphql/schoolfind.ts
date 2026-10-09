import {
  Processes,
  SchoolInfo,
  ShowVacanciesReturn,
  Vacancies,
} from '@/modules/school/types';
import { cabecalhosPublicos } from '@/maps/localizarEndereco';
import { graphql } from '@/api';

export const carregarConsulta = async (): Promise<ShowVacanciesReturn & { processes: Processes[] }> => {
  const resposta = await fetch('/pre-matricula-escolas', {
    headers: cabecalhosPublicos(),
    credentials: 'same-origin',
  });

  if (!resposta.ok || !resposta.headers.get('content-type')?.includes('json')) {
    return { processes: [], vacancies: [], schools: [] };
  }

  const dados = await resposta.json();

  return {
    processes: dados.processes || [],
    vacancies: dados.vacancies || [],
    schools: (dados.schools || []).map((school: SchoolInfo) => ({
      ...school,
      position: {
        lat: school.lat,
        lng: school.lng,
      },
    })),
  };
};

export const showProcesses = (): Promise<Processes[]> => {
  const payload = {
    query: `
      {
        processes(
          first: 100
          active: true
        ) {
          data {
            id
            name
            stages {
              id
              type
              name
              startAt
              endAt
              status
            }
            schoolYear {
              year
            }
            grades {
              id
              name
            }
          }
        }
      }
    `,
  };

  return graphql<{
    data: {
      data: {
        processes: {
          data: Processes[]
        };
      };
    };
  }>(payload)
    .then(res => res.data.data.processes.data.filter((process) => process.stages.length));
};

export const showVacancies = (data: {
  processes: string[];
}): Promise<ShowVacanciesReturn> => {
  const payload = {
    variables: data,
    query: `
      query vacancies(
        $processes: [ID!]
      ) {
        vacancies(
          processes: $processes
        ) {
          process
          grade
          school
          period
        }
        schools(
          first: 200
          processes: $processes
        ) {
          data {
            id
            name
            lat: latitude
            lng: longitude
            area_code
            phone
          }
        }
      }
    `,
  };


  return graphql<{
    data: {
      data: {
        vacancies: Vacancies[];
        schools: {
          data: SchoolInfo[];
        };
      };
    };
  }>(payload)
    .then(res => ({
      vacancies: res.data.data.vacancies,
      schools: res.data.data.schools.data.map((school) => ({
        ...school,
        position: {
          lat: school.lat,
          lng: school.lng,
        },
      })),
    }));
};
