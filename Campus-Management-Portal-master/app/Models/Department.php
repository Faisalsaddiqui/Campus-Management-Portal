<?php

namespace App\Models;

use Spatie\Sluggable\HasSlug;
use App\Scopes\AvailableScope;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Department extends Model
{
    use HasFactory, HasSlug;

    protected $fillable = [
        'department_name',
        'slug',
        'faculty_id'
    ];


    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom(function ($model) {
                return "dept " . $model->department_name;
            })
            ->saveSlugsTo('slug');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function faculty()
    {
        return $this->belongsTo(Faculty::class);
    }

    public function programs()
    {
        return $this->hasMany(Program::class);
    }


    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? null, function ($query, $search) {
            $query->where('department_name', 'like', '%' . $search . '%');
        });
    }

    public function scopeAvailableTo($query, User $user)
    {
        $query->when($user->hasRole('super-admin'), function ($query) {
            return $query;
        })->when(!$user->hasRole('super-admin'), function ($query)  use ($user) {
            return $query->whereHas('faculty', function ($query)  use ($user) {
                return $query->whereHas('admins', function ($query) use ($user) {
                    return $query->where('admin_id', $user->id);
                });
            });
        });
    }
}
