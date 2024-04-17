<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlunoMantenedora extends Model
{
    use HasFactory;
    protected $table = 'PROCESSAR_MANTENEDORA_ALUNO';
    protected $filable = ['MANTENEDORA', 'ALUNO'];
    public $timestamps = false;
    public $incrementing = true;
}
