<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
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
        ];
    }

    /**
     * Get the user's initials
     */
    public function initials(): string
    {
        return Str::of($this->name)
            ->explode(' ')
            ->take(2)
            ->map(fn ($word) => Str::substr($word, 0, 1))
            ->implode('');
    }

    /**
     * The teams that the user belongs to.
     */
    public function teams()
    {
        return $this->belongsToMany(Team::class, 'team_members')
            ->withPivot('role')
            ->withTimestamps();
    }

    /**
     * Get the user's team role for a specific team.
     */
    public function teamRole(Team $team): ?string
    {
        return $this->teams()
            ->where('team_id', $team->id)
            ->first()
            ?->pivot
            ->role;
    }

    /**
     * Check if the user has a specific role in a team.
     */
    public function hasTeamRole(Team $team, string $role): bool
    {
        return $this->teams()
            ->where('team_id', $team->id)
            ->wherePivot('role', $role)
            ->exists();
    }

    /**
     * Check if the user has any of the given roles in a team.
     */
    public function hasAnyTeamRole(Team $team, array $roles): bool
    {
        return $this->teams()
            ->where('team_id', $team->id)
            ->whereIn('role', $roles)
            ->exists();
    }

    /**
     * Get the current team for the user.
     */
    public function currentTeam()
    {
        if (is_null($this->current_team_id)) {
            return null;
        }
        
        return $this->teams->firstWhere('id', $this->current_team_id);
    }

    /**
     * Set the current team for the user.
     */
    public function setCurrentTeam(?Team $team): void
    {
        if (!is_null($team) && !$this->belongsToTeam($team)) {
            throw new \InvalidArgumentException('The user does not belong to this team.');
        }

        $this->current_team_id = $team?->id;
        
        // Store in session if we have a team
        if ($team) {
            Session::put('current_team_id', $team->id);
        } else {
            Session::forget('current_team_id');
        }
        
        // We'll use a custom property to avoid touching the database
        $this->setRelation('currentTeam', $team);
    }

    /**
     * Determine if the user belongs to the given team.
     */
    public function belongsToTeam(Team $team): bool
    {
        return $this->teams->contains($team->id);
    }

    /**
     * Get the current team role for the user.
     */
    public function currentTeamRole(): ?string
    {
        return $this->currentTeam() ? $this->teamRole($this->currentTeam()) : null;
    }

    /**
     * Check if the user has a specific role in the current team.
     */
    public function hasCurrentTeamRole(string $role): bool
    {
        $currentTeam = $this->currentTeam();
        return $currentTeam ? $this->hasTeamRole($currentTeam, $role) : false;
    }

    /**
     * Check if the user has any of the given roles in the current team.
     */
    public function hasAnyCurrentTeamRole(array $roles): bool
    {
        $currentTeam = $this->currentTeam();
        return $currentTeam ? $this->hasAnyTeamRole($currentTeam, $roles) : false;
    }
}
