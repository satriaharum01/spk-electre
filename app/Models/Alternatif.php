<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alternatif extends Model
{
    use HasFactory;
    protected $table = 'alternatif';
    protected $primaryKey = 'id';
    protected $fillable = ['kode','nama','prodi'];
    protected $inputType = [
        'kode' => 'text',
        'nama' => 'text',
        'prodi' => 'text'
    ];

    public function getField()
    {
        return $this->inputType;
    }
}
