<?php

namespace App\Http\Controllers;

use App\Exports\PlanilhaExport;
use App\Exports\PlanilhaExport2;
use App\Exports\PlanilhaExports;
use App\Models\Aluno;
use App\Models\AlunoMantenedora;
use App\Models\Matricula;
use Exception;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;

class MainController extends Controller
{

    public function receberDados(Request $request)
    {
        try {
            if ($request->hasFile('arquivo')) {
                $file = $request->file('arquivo');
                $filePath = $file->getRealPath();
                $excelData = Excel::toArray(new Aluno(), $filePath);
                if ($this->validarPlanilha($excelData)) {
                    $resultados = [];
                    for ($i = 1; $i < count($excelData[0]); $i++) {
                        $dados = $excelData[0][$i];
                        $resultados[] = [
                            'MANTENEDORA' => $dados[0] ?? null,
                            'ALUNO' => $dados[5] ?? null,
                        ];
                    }
                    return $resultados;
                } else {
                    return "Erro";
                }
            }
        } catch (Exception $e) {
            return 'Erro';
        }
    }

    public function validarPlanilha($excelData)
    {
        // Verifica se a planilha contém pelo menos um registro e se cada registro possui mantenedora e aluno
        $dados = $excelData[0][0];
        if ($dados[0] != 'MANTENEDORA' && $dados[5] != 'ALUNO') {
            return false;
        } else {
            return true;
        }
    }

    public function enviarDados(Request $request)
    {
        DB::table('PROCESSAR_MANTENEDORA_ALUNO')->truncate();
        $dadosParaEnviar = $this->receberDados($request);

        try {
            if ($dadosParaEnviar != "Erro") {
                if (!empty($dadosParaEnviar)) {
                    $dados = AlunoMantenedora::insert($dadosParaEnviar);
                    return "<script>alert('Sucesso'); window.history.back();</script>";
                    print("Sucesso");
                } else {
                    return "<script>alert('Nenhuma planilha enviada'); window.history.back();</script>";
                }
            } else {
                return "<script>alert('Planilha no formato errado, é necessário um campo MANTENEDORA (coluna 1) e um ALUNO (coluna 5)'); window.history.back();</script>";
            }
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }


    public function downloadCSVDisciplina(Request $request)
    {
        $ano = $request->input('ano');
        $semestre = $request->input('semestre');
        $mantenedora = $request->input('mantenedora');

        return Excel::download(
            new PlanilhaExport($ano, $semestre, $mantenedora),
            'AlunoNossaBolsaDisciplinas' . $mantenedora . '.csv'
        );
    }

    public function downloadCSVDisciplina2(Request $request)
    {
        $ano = $request->input('ano');
        $semestre = $request->input('semestre');
        $mantenedora = $request->input('mantenedora');

        return Excel::download(
            new PlanilhaExport2($ano, $semestre, $mantenedora),
            'AlunoNossaBolsaNotas' . $mantenedora . '.csv'
        );
    }
}
