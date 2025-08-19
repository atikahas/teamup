<?php

namespace App\Policies;

use App\Models\Team;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TeamPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return true; // All authenticated users can view teams
    }

    public function view(User $user, Team $team): bool
    {
        return $user->teams->contains($team->id);
    }

    public function create(User $user): bool
    {
        return true; // Any authenticated user can create a team
    }

    public function update(User $user, Team $team): bool
    {
        return $user->hasTeamRole($team, ['owner', 'manager']);
    }

    public function delete(User $user, Team $team): bool
    {
        return $user->hasTeamRole($team, 'owner');
    }

    public function inviteMember(User $user, Team $team): bool
    {
        return $user->hasTeamRole($team, ['owner', 'manager']);
    }

    public function removeMember(User $user, Team $team, User $teamMember): bool
    {
        // Only owners can remove members, and cannot remove themselves if they're the only owner
        if (!$user->hasTeamRole($team, 'owner')) {
            return false;
        }

        // Check if trying to remove self
        if ($user->id === $teamMember->id) {
            // Allow only if there's another owner
            $ownerCount = $team->members()
                ->wherePivot('role', 'owner')
                ->count();
                
            return $ownerCount > 1;
        }

        return true;
    }

    public function updateMemberRole(User $user, Team $team, string $newRole): bool
    {
        // Only owners can update roles
        if (!$user->hasTeamRole($team, 'owner')) {
            return false;
        }

        // Prevent changing the last owner's role
        if ($newRole !== 'owner') {
            $ownerCount = $team->members()
                ->wherePivot('role', 'owner')
                ->count();
                
            if ($ownerCount <= 1) {
                return false;
            }
        }

        return true;
    }
}
