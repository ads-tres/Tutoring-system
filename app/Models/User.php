<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;

class User extends Authenticatable implements FilamentUser
{
    use HasRoles, Notifiable;

    protected $fillable = [
        'name', 'email', 'password',
        // Profile
        'first_name','middle_name','last_name',
        'phone','date_of_birth',
        'region','city','subcity','district','kebele',
        'profile_photo_path',
        // Suspension
        'suspended_at', 'suspension_reason',
        // Tutor payroll
        'tutor_target_hours_month', 'tutor_salary_base',
        // Add additional fields as your schema evolves
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'date_of_birth' => 'date',
        'suspended_at' => 'datetime',
    ];

    public function canAccessPanel(Panel $panel): bool
    {
        return $this->hasAnyRole(['Manager','Subordinate','Tutor','Accountant']);
    }
}
