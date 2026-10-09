<?php

namespace iEducar\Packages\PreMatricula\Http\Controllers;

use iEducar\Packages\PreMatricula\Models\PreRegistration;
use iEducar\Packages\PreMatricula\Models\Process;
use iEducar\Packages\PreMatricula\Support\InitialsFromName;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class ConsultaProtocoloController extends Controller
{
    use InitialsFromName;

    public function __invoke(Request $request)
    {
        $protocolo = ltrim(trim((string) $request->query('protocolo', '')), '#');

        if ($protocolo === '') {
            return response()->json(['encontrado' => false]);
        }

        $inscricao = PreRegistration::query()
            ->with([
                'student',
                'school',
                'classroom.period',
                'classroom.grade',
                'stage',
                'process.gradesWithSuggestedAges',
                'waiting.school',
                'waiting.process',
                'parent.school',
                'parent.process',
            ])
            ->where('protocol', $protocolo)
            ->first();

        if ($inscricao === null) {
            return response()->json(['encontrado' => false]);
        }

        return response()->json($this->inscricao($inscricao) + ['encontrado' => true]);
    }

    private function inscricao(PreRegistration $inscricao): array
    {
        $aluno = $inscricao->student;
        $nascimento = $aluno?->date_of_birth;
        if ($nascimento instanceof \DateTimeInterface) {
            $nascimento = $nascimento->format('Y-m-d');
        }

        return [
            'id' => (string) $inscricao->id,
            'type' => $this->tipo((int) $inscricao->preregistration_type_id),
            'status' => $this->situacao((int) $inscricao->status),
            'position' => $inscricao->position,
            'protocol' => $inscricao->protocol,
            'observation' => $inscricao->observation,
            'student' => $aluno === null ? null : [
                'initials' => $aluno->name ? $this->initials($aluno->name) : '',
                'dateOfBirth' => $nascimento,
            ],
            'school' => $this->escola($inscricao->school),
            'classroom' => $inscricao->classroom === null ? null : [
                'name' => $inscricao->classroom->name,
                'period' => [
                    'name' => $inscricao->classroom->period?->name,
                ],
                'grade' => [
                    'name' => $inscricao->classroom->grade?->name,
                ],
            ],
            'waiting' => $this->vinculo($inscricao->waiting),
            'parent' => $this->vinculo($inscricao->parent),
            'stage' => [
                'observation' => $inscricao->stage?->observation,
            ],
            'process' => $this->processo($inscricao->process),
        ];
    }

    private function vinculo(?PreRegistration $inscricao): ?array
    {
        if ($inscricao === null) {
            return null;
        }

        return [
            'position' => $inscricao->position,
            'protocol' => $inscricao->protocol,
            'school' => $this->escola($inscricao->school),
            'process' => [
                'showPriorityProtocol' => (bool) $inscricao->process?->show_priority_protocol,
            ],
        ];
    }

    private function escola($escola): ?array
    {
        if ($escola === null) {
            return null;
        }

        return [
            'name' => $escola->name,
            'area_code' => $escola->area_code,
            'phone' => $escola->phone,
        ];
    }

    private function processo(?Process $processo): ?array
    {
        if ($processo === null) {
            return null;
        }

        return [
            'showPriorityProtocol' => (bool) $processo->show_priority_protocol,
            'forceSuggestedGrade' => (bool) $processo->force_suggested_grade,
            'blockIncompatibleAgeGroup' => (bool) $processo->block_incompatible_age_group,
            'grades' => $processo->gradesWithSuggestedAges
                ->unique('id')
                ->map(fn ($serie) => [
                    'id' => (string) $serie->id,
                    'name' => $serie->name,
                    'startBirth' => $serie->start_birth,
                    'endBirth' => $serie->end_birth,
                ])
                ->values(),
        ];
    }

    private function tipo(int $tipo): string
    {
        return match ($tipo) {
            PreRegistration::REGISTRATION_RENEWAL => 'REGISTRATION_RENEWAL',
            PreRegistration::WAITING_LIST => 'WAITING_LIST',
            default => 'REGISTRATION',
        };
    }

    private function situacao(int $situacao): string
    {
        return match ($situacao) {
            PreRegistration::STATUS_ACCEPTED => 'ACCEPTED',
            PreRegistration::STATUS_REJECTED => 'REJECTED',
            PreRegistration::STATUS_SUMMONED => 'SUMMONED',
            PreRegistration::STATUS_IN_CONFIRMATION => 'IN_CONFIRMATION',
            default => 'WAITING',
        };
    }
}
