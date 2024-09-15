<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AcademicDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'title',
        'exam_type',
        'reg_no',
        'passing_year',
        'organization_id',
        'obtained_marks',
        'total_marks',
        'user_id'
    ];

    public function applicant()
    {
        return $this->belongsTo(User::class);
    }

    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }

    public function media()
    {
        return $this->hasOne(AcademicDetailMedia::class);
    }
}
