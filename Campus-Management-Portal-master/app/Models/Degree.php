<?php

namespace App\Models;

use App\Models\Program;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Degree extends Model
{
    use HasFactory;

    protected $fillable = [
        'degree_name',
        'semesters',
    ];


    public function programs()
    {
        return $this->hasMany(Program::class);
    }
}
