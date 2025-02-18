<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\ValidationException;

class Penilaian extends Model
{
    use HasFactory;
    protected $table = 'penilaian';
    protected $primaryKey = 'id';
    protected $fillable = ['id_alternatif','id_kriteria','nilai'];
    protected $inputType = [
        'id_alternatif' => 'select',
        'id_kriteria' => 'select',
        'nilai' => 'number'
    ];

    public function getField()
    {
        return $this->inputType;
    }
    
    public function cariKriteria()
    {
        return $this->belongsTo('App\Models\Kriteria', 'id_kriteria', 'id')->withDefault(function ($data) {
            if (collect($data->getFillable())->every(fn($attr) => $data->$attr === null)) {
                return null;
            }
            return $data;
        });
    }
    
    public function cariAlternatif()
    {
        return $this->belongsTo('App\Models\Altnernatif', 'id_alternatif', 'id')->withDefault(function ($data) {
            if (collect($data->getFillable())->every(fn($attr) => $data->$attr === null)) {
                return null;
            }
            return $data;
        });
    }
    
    public function subKriteria()
    {
        return $this->belongsTo(SubKriteria::class, 'nilai', 'nilai')
                    ->whereColumn('id_kriteria', 'id_kriteria');
    }
}
