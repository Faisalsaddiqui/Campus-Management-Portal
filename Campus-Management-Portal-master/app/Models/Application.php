<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;

    protected $fillable = [
        'program_id',
        'status_id',
        'user_id'
    ];

    public function applicant()
    {
        return $this->belongsTo(User::class);
    }

    public function program()
    {
        return  $this->belongsTo(Program::class);
    }

    public function status()
    {
        return $this->belongsTo(ApplicationStatus::class);
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? null, function ($query, $search) {
            $query->whereHas('program', function ($query) use ($search) {
                $query->whereHas('department', function ($query) use ($search) {
                    $query->where('department_name', 'like', "%{$search}%");
                })
                    ->orWhereHas('degree', function ($query) use ($search) {
                        $query->where('degree_name', 'like', "%{$search}%");
                    });
            });
        })->when($filters['status'] ?? null, function ($query, $status) {
            $query->whereHas('status', function ($query) use ($status) {
                $query->where('status', 'like', "%{$status}%");
            });
        });
    }

    public function scopeAvailableTo($query, User $user)
    {
        $query->when($user->hasRole('super-admin'), function ($query) {
            return $query;
        })->when(!$user->hasRole('super-admin'), function ($query)  use ($user) {
            return $query->whereHas('program.department.faculty', function ($query)  use ($user) {
                return $query->whereHas('admins', function ($query) use ($user) {
                    return $query->where('admin_id', $user->id);
                });
            });
        });
    }
}
