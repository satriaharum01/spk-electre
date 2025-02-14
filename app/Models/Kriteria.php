<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kriteria extends Model
{
    use HasFactory;
    protected $table = 'kriteria';
    protected $primaryKey = 'id';
    protected $fillable = ['nama_kriteria','bobot','tipe'];
    protected $inputType = [
        'nama_kriteria' => 'text',
        'bobot' => 'text',
        'tipe' => 'select'
    ];

    public function getField()
    {
        return $this->inputType;
    }
    
    public function subKriteria()
    {
        return $this->hasMany(SubKriteria::class, 'id_kriteria');
    }

    public function penilaian()
    {
        return $this->hasOne(Penilaian::class, 'id_kriteria');
    }
}
