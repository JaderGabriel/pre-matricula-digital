import { ErrorResponse, ID, Nullable, Student } from '@/types';
import { FindProtocolPreRegistration, ProtocolStatusPreRegistration, ProtocolStatusReturnToWait } from '@/modules/protocol/types';
import { cabecalhosPublicos } from '@/maps/localizarEndereco';
import { defineFindProtocolQueryAndVariables } from '@/util';
import { graphql } from '@/modules/protocol/api';

export const show = async (data: {
  search: string;
}): Promise<Nullable<ProtocolStatusPreRegistration>> => {
  const destino = new URL('/pre-matricula-protocolo', window.location.origin);
  destino.searchParams.set('protocolo', data.search);
  const resposta = await fetch(destino.toString(), {
    headers: cabecalhosPublicos(),
    credentials: 'same-origin',
  });

  if (!resposta.ok || !resposta.headers.get('content-type')?.includes('json')) {
    throw new Error('consulta');
  }

  const dados = await resposta.json();

  if (!dados?.encontrado || !dados?.id) {
    return null;
  }

  delete dados.encontrado;

  return dados;
};

export const postReturnToWait = (data: ID, grade: Nullable<string>): Promise<ProtocolStatusReturnToWait> => {
  const payload = {
    variables: {
      ...data,
      grade
    },
    query: `
      mutation keepOnTheWaitingList(
        $id: ID!
        $grade: ID
      ) {
        keepOnTheWaitingList(
          id: $id
          grade: $grade
        )
      }
    `,
  };

  return graphql<{
    data: {
      data: {
        keepOnTheWaitingList: ID;
      };
      errors?: ErrorResponse;
    }
  }>(payload)
    .then(res => ({
      errors: Boolean(res.data.errors),
      keepOnTheWaitingList: res.data.data.keepOnTheWaitingList,
    }));
};

export const postFindProtocol = (data: {
  type: string;
  studentModel: Student;
}): Promise<FindProtocolPreRegistration[]> => {
  const payload = defineFindProtocolQueryAndVariables(
    data.type,
    data.studentModel,
  );

  return graphql<{
    data: {
      data: {
        preregistrations: FindProtocolPreRegistration[];
      }
    }
  }>(payload)
    .then(res => res.data.data.preregistrations);
};
