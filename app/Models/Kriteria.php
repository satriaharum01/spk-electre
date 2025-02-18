<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\ValidationException;

class Kriteria extends Model
{
    use HasFactory;
    protected $table = 'kriteria';
    protected $primaryKey = 'id';
    protected $fillable = ['kode','nama_kriteria','bobot','tipe'];
    protected $inputType = [
        'kode' => 'text',
        'nama_kriteria' => 'text',
        'bobot' => 'text',
        'tipe' => 'select'
    ];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->validate();
        });

        static::updating(function ($model) {
            $model->validate();
        });
    }

    public function validate()
    {
        $validator = validator($this->attributes, [
            'kode'  => 'required|string|min:2',
            'nama_kriteria' => 'required|string|min:3',
            'bobot'   => 'required|numeric|min:1',
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }
    }

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
