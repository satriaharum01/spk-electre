<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\ValidationException;

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
            'nama' => 'required|string|min:3',
            'prodi'   => 'required|string|min:4',
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }
    }

    public function getField()
    {
        return $this->inputType;
    }

    public function penilaian()
    {
        return $this->hasMany(Penilaian::class, 'id_alternatif');
    }
}
