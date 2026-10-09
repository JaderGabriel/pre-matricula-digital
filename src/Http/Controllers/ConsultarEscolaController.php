<?php

namespace iEducar\Packages\PreMatricula\Http\Controllers;

use iEducar\Packages\PreMatricula\Models\Process;
use iEducar\Packages\PreMatricula\Models\ProcessVacancy;
use iEducar\Packages\PreMatricula\Models\School;
use Illuminate\Routing\Controller;

class ConsultarEscolaController extends Controller
{
    public function __invoke()
    {
        $processos = Process::query()
            ->where('active', true)
            ->has('stages')
            ->with('gradesWithSuggestedAges')
            ->orderBy('name')
            ->limit(100)
            ->get();

        $ids = $processos->pluck('id')->map(fn ($id) => (int) $id)->all();

        $escolas = $ids === []
            ? collect()
            : School::query()
                ->whereHas('processes', function ($query) use ($ids) {
                    $query->whereIn('processes.id', $ids);
                })
                ->orderBy('name')
                ->get();

        $vagas = $ids === []
            ? collect()
            : ProcessVacancy::query()->whereIn('process_id', $ids)->get();

        return response()->json([
            'processes' => $processos->map(function (Process $processo) {
                return [
                    'id' => (string) $processo->id,
                    'name' => $processo->name,
                    'grades' => $processo->gradesWithSuggestedAges
                        ->unique('id')
                        ->map(fn ($serie) => [
                            'id' => (string) $serie->id,
                            'name' => $serie->name,
                        ])
                        ->values(),
                ];
            })->values(),
            'schools' => $escolas->map(function (School $escola) {
                return [
                    'id' => (string) $escola->id,
                    'name' => $escola->name,
                    'lat' => $escola->latitude,
                    'lng' => $escola->longitude,
                    'area_code' => $escola->area_code,
                    'phone' => $escola->phone,
                ];
            })->values(),
            'vacancies' => $vagas->map(fn ($vaga) => [
                'process' => (string) $vaga->process_id,
                'grade' => (string) $vaga->grade_id,
                'school' => (string) $vaga->school_id,
                'period' => (string) $vaga->period_id,
            ])->values(),
        ]);
    }
}
