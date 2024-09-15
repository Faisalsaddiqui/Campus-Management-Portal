<?php

namespace App\Models;

use App\Models\Degree;
use App\Models\Application;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Program extends Model
{
    use HasFactory, HasSlug;

    protected $fillable = [
        'morning_option',
        'evening_option',
        'department_id',
        'degree_id',
        'credit_hours',
        'slug'
    ];


    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom(function ($model) {
                return "{$model->degree->degree_name} {$model->department->department_name}";
            })
            ->saveSlugsTo('slug');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function courses()
    {
        return $this->belongsToMany(Course::class)->withPivot('semester');
    }

    public function degree()
    {
        return $this->belongsTo(Degree::class);
    }

    public function application()
    {
        return $this->hasMany(Application::class);
    }

    public function getFullProgramNameAttribute()
    {
        return "{$this->degree->degree_name} {$this->department->department_name}";
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? null, function ($query, $search) {
            $query->WhereHas('department', function ($query) use ($search) {
                $query->where('department_name', 'like', "%{$search}%");
            });
        })->when($filters['degree'] ?? null, function ($query, $degree) {
            $query->whereHas('degree', function ($query) use ($degree) {
                $query->where('degree_name', 'like', "%{$degree}%");
            });
        });
    }
}
