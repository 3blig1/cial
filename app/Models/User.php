<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
        public const DELEGABLE_PERMISSIONS = [
            'manage_students' => 'Gerer les eleves',
            'manage_pending_students' => 'Gerer la liste d\'attente etudiants',
            'manage_reports' => 'Gerer les rapports',
            'manage_secretary_reports' => 'Gerer les rapports secretaires des ecoles',
            'manage_secretary_all_reports' => 'Gerer les rapports de tous les secretaires de toutes les ecoles',
            'manage_teacher_reports' => 'Gerer les rapports enseignants des ecoles',
            'manage_teacher_all_reports' => 'Gerer les rapports de tous les enseignants de toutes les ecoles',
            'manage_exams' => 'Gerer les examens',
            'manage_teachers' => 'Gerer les enseignants',
            'manage_courses' => 'Gerer les cours',
            'manage_subjects' => 'Gerer les matieres',
            'manage_schools' => 'Gerer les ecoles',
            'manage_users' => 'Gerer les utilisateurs',
            'delete_students' => 'Supprimer des eleves',
            'delete_reports' => 'Supprimer des rapports',
        ];

    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'permissions',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'permissions' => 'array',
        ];
    }

    
    /**
     * Check if the user has the admin role.
     */
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    /**
     * Check if the user has the secretary role.
     */
    public function isSecretary(): bool
    {
        return $this->role === 'secretary';
    }

    /**
     * Check if the user has the student role.
     */
    public function isStudent(): bool
    {
        return $this->role === 'student';
    }

    /**
     * Check if the user has the teacher role.
     */
    public function isTeacher(): bool
    {
        return $this->role === 'teacher';
    }

    /**
     * Check if the user has any of the given roles.
     */
    public function hasAnyRole(array $roles): bool
    {
        return in_array($this->role, $roles);
    }

    /**
     * Check if the user has a specific role.
     */
    public function hasRole(string $role): bool
    {
        return $this->role === $role;
    }

    public static function delegablePermissions(): array
    {
        return self::DELEGABLE_PERMISSIONS;
    }

    public function canReceiveDelegatedPermissions(): bool
    {
        return $this->isSecretary() || $this->isTeacher();
    }

    public function hasPermission(string $permission): bool
    {
        if ($this->isAdmin()) {
            return true;
        }

        return in_array($permission, $this->permissions ?? [], true);
    }

    public function hasAnyPermission(array $permissions): bool
    {
        foreach ($permissions as $permission) {
            if ($this->hasPermission($permission)) {
                return true;
            }
        }

        return false;
    }

    public function hasSchoolAccess(int $schoolId): bool
    {
        return $this->schools()->whereKey($schoolId)->exists();
    }

    public function canManageReport(DailyReport $report): bool
    {
        if ($this->isAdmin()) {
            return true;
        }

        if ($this->id === $report->user_id) {
            return true;
        }

        $reportAuthor = $report->author()->first();

        if (! $reportAuthor) {
            return false;
        }

        if ($this->isSecretary()) {
            if ($reportAuthor->isSecretary() && $this->hasPermission('manage_secretary_reports') && $this->hasSchoolAccess((int) $report->school_id)) {
                return true;
            }

            if ($reportAuthor->isSecretary() && $this->hasPermission('manage_secretary_all_reports')) {
                return true;
            }
        }

        if ($this->isTeacher()) {
            if ($reportAuthor->isTeacher() && $this->hasPermission('manage_teacher_reports') && $this->hasSchoolAccess((int) $report->school_id)) {
                return true;
            }

            if ($reportAuthor->isTeacher() && $this->hasPermission('manage_teacher_all_reports')) {
                return true;
            }
        }

        return false;
    }

    public function setDelegatedPermissions(array $permissions): void
    {
        $allowedPermissions = array_keys(self::delegablePermissions());
        $filteredPermissions = array_values(array_intersect($allowedPermissions, $permissions));

        $this->permissions = $this->canReceiveDelegatedPermissions() ? $filteredPermissions : [];
    }
    
    /**
     * Get the student profile for the user.
     */
    public function student()
    {
        return $this->hasOne(Student::class);
    }
    
    /**
     * Get the daily reports for the user.
     */
    public function reports(): HasMany
    {
        return $this->hasMany(DailyReport::class);
    }

    public function schools(): BelongsToMany
    {
        return $this->belongsToMany(School::class);
    }

}
