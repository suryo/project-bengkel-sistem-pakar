<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diagnosis extends Model
{
    use HasFactory;

    protected $fillable = ['code', 'name', 'solution'];

    public function symptoms()
    {
        return $this->belongsToMany(Symptom::class);
    }
}
