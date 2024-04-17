<?php

namespace App\Exports;

use App\Models\Pessoa;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;

class PlanilhaExport2 implements FromCollection, WithCustomCsvSettings
{

    protected  $ano, $semestre, $mantenedora;
    public function __construct($ano, $semestre, $mantenedora)
    {
        $this->ano = $ano;
        $this->semestre = $semestre;
        $this->mantenedora = $mantenedora;
    }

    public function collection()
    {
        $wherenotin = ['D_ESTAGIO', 'D_ESTAGIO_OBRIG'];
        $resultados = Pessoa::selectRaw("LY_PESSOA.CPF, UPPER(LY_HISTMATRICULA.DISCIPLINA) AS DISCIPLINA, CONCAT(LY_HISTMATRICULA.SEMESTRE, LY_HISTMATRICULA.ANO) AS SEMESTRE_ANO, REPLACE(ISNULL(LTRIM(LY_HISTMATRICULA.NOTA_FINAL), 0), '.', ',') AS NOTA_FINAL, 
        CASE LY_HISTMATRICULA.SITUACAO_HIST 
        WHEN 'Aprovado' THEN 'A' 
        WHEN 'Rep Freq' THEN 'RF' 
        WHEN 'Rep Nota' THEN 'R' 
        END AS SITUACAO_HIST")
            ->join('LY_ALUNO', 'LY_PESSOA.PESSOA', '=', 'LY_ALUNO.PESSOA')
            ->join('LY_HISTMATRICULA', 'LY_ALUNO.ALUNO', '=', 'LY_HISTMATRICULA.ALUNO')
            ->join('PROCESSAR_MANTENEDORA_ALUNO', 'LY_ALUNO.ALUNO', '=', 'PROCESSAR_MANTENEDORA_ALUNO.ALUNO')
            ->where('LY_HISTMATRICULA.ANO', $this->ano, 'and')
            ->where('LY_HISTMATRICULA.SEMESTRE', $this->semestre, 'and')
            ->where('PROCESSAR_MANTENEDORA_ALUNO.MANTENEDORA', $this->mantenedora, 'and')
            ->whereNotIn('LY_HISTMATRICULA.DISCIPLINA', $wherenotin, 'and')
            ->whereNotNull('LY_HISTMATRICULA.NOTA_FINAL')
            ->where('LY_HISTMATRICULA.NOTA_FINAL', '<>', '')
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
