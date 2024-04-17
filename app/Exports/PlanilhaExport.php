<?php

namespace App\Exports;

use App\Models\Matricula;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;

class PlanilhaExport implements FromCollection, WithCustomCsvSettings
{
    protected $ano, $semestre, $mantenedora;
    public function __construct($ano, $semestre, $mantenedora)
    {
        $this->ano = $ano;
        $this->semestre = $semestre;
        $this->mantenedora = $mantenedora;
    }
    public function collection()
    {
        $wherenotin = ['D_ESTAGIO', 'D_ESTAGIO_OBRIG'];
        $resultados = Matricula::selectRaw("LY_PESSOA.CPF,LY_MATRICULA.DISCIPLINA,CONVERT(VARCHAR,LY_MATRICULA.ANO)+'/'+CONVERT(VARCHAR,LY_MATRICULA.SEMESTRE)")
            ->join('LY_ALUNO', 'LY_ALUNO.ALUNO', '=', 'LY_MATRICULA.ALUNO')
            ->join('LY_PESSOA', 'LY_PESSOA.PESSOA', '=', 'LY_ALUNO.PESSOA')
            ->join('PROCESSAR_MANTENEDORA_ALUNO', 'PROCESSAR_MANTENEDORA_ALUNO.ALUNO', '=', 'LY_MATRICULA.ALUNO')
            ->whereNotIn('LY_MATRICULA.DISCIPLINA', $wherenotin, 'and')
            ->where('LY_MATRICULA.ANO', '=', $this->ano, 'and')
            ->where('LY_MATRICULA.SIT_MATRICULA', '=', 'Matriculado', 'and')
            ->where('LY_MATRICULA.SEMESTRE', '=', $this->semestre, 'and')
            ->where('PROCESSAR_MANTENEDORA_ALUNO.MANTENEDORA', '=', $this->mantenedora)
            ->orderBy('LY_PESSOA.CPF', 'asc')
            ->get();

        return $resultados;
    }

    public function getCsvSettings(): array
    {
        return [
            'delimiter' => ';',
            'enclosure' => '',
        ];
    }
}
