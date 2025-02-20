<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\ValidationException;

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
            'id_kriteria'  => 'required|numeric|min:1',
            'sub_kriteria' => 'required|numeric|min:1',
            'nilai'   => 'required|numeric|min:1',
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }
    }

    public function getField()
    {
        return $this->inputType;
    }

    public function cariKriteria()
    {
        return $this->belongsTo('App\Models\Kriteria', 'id_kriteria', 'id')->withDefault(function ($data) {
            if (collect($data->getFillable())->every(fn ($attr) => $data->$attr === null)) {
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
