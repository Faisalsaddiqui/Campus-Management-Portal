<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Propaganistas\LaravelPhone\Casts\E164PhoneNumberCast;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'father_name',
        'email',
        'cnic',
        'phone',
        'avatar',
        'password',
        'gender',
        'date_of_birth'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'phone' => E164PhoneNumberCast::class . ':PK'
    ];

    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }

    public function faculties()
    {
        return  $this->belongsToMany(Faculty::class, 'admin_faculty', 'admin_id', 'faculty_id', 'id', 'id');
    }

    //hack to make department relation on admin model
    //using admin_faculty pivot table to get the department by joining the departments table with admin_faculty table using faculty_id as key
    //hope this doesnt break
    public function departments()
    {
        return $this->belongsToMany(Department::class, 'admin_faculty', 'admin_id', 'faculty_id', 'id', 'faculty_id');
    }

    public function applications()
    {
        return $this->hasMany(Application::class, 'applicant_id');
    }

    public function academicDetails()
    {
        return $this->hasMany(AcademicDetail::class);
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? null, function ($query, $search) {
            $query->where(function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%')
                    ->orWhere('email', 'like', '%' . $search . '%');
            });
        })->when($filters['role'] ?? null, function ($query, $role) {
            $query->whereHas('roles', function ($query) use ($role) {
                $query->where('name', $role);
            });
        });
    }
}
