<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubKriteria extends Model
{
    use HasFactory;
    protected $table = 'sub_kriteria';
    protected $primaryKey = 'id';
    protected $fillable = ['id_kriteria','sub_kriteria','nilai'];
    protected $inputType = [
        'id_kriteria' => 'select',
        'sub_kriteria' => 'text',
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

    public function penilaian()
    {
        return $this->hasMany(Penilaian::class, 'nilai', 'nilai');
    }
}
