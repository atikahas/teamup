<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class TeamController extends Controller
{
    public function index()
    {
        $teams = Auth::user()->teams()->withCount('members')->get();
        return view('teams.index', compact('teams'));
    }

    public function create()
    {
        return view('teams.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $team = Team::create([
            'name' => $validated['name'],
        ]);

        // Add the creator as the team owner
        $team->members()->attach(Auth::id(), [
            'role' => 'owner',
        ]);

        // Set the new team as current
        Auth::user()->setCurrentTeam($team);

        return redirect()->route('teams.show', $team)
            ->with('status', 'Team created successfully!');
    }

    public function show(Team $team)
    {
        $this->authorize('view', $team);
        
        $members = $team->members()->withPivot('role')->get();
        $availableRoles = ['owner', 'manager', 'player', 'viewer'];
        
        return view('teams.show', compact('team', 'members', 'availableRoles'));
    }

    public function edit(Team $team)
    {
        $this->authorize('update', $team);
        
        return view('teams.edit', compact('team'));
    }

    public function update(Request $request, Team $team)
    {
        $this->authorize('update', $team);
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $team->update($validated);

        return redirect()->route('teams.show', $team)
            ->with('status', 'Team updated successfully!');
    }

    public function destroy(Team $team)
    {
        $this->authorize('delete', $team);
        
        $team->delete();

        // If the deleted team was the current team, set a new current team
        if (Auth::user()->current_team_id === $team->id) {
            Auth::user()->setCurrentTeam(Auth::user()->teams()->first());
        }

        return redirect()->route('teams.index')
            ->with('status', 'Team deleted successfully!');
    }

    public function switchTeam(Team $team)
    {
        if (!Auth::user()->teams->contains($team)) {
            abort(403);
        }

        Auth::user()->setCurrentTeam($team);

        return back()->with('status', 'Team switched successfully!');
    }

    public function inviteMember(Request $request, Team $team)
    {
        $this->authorize('inviteMember', $team);
        
        $validated = $request->validate([
            'email' => 'required|email|exists:users,email',
            'role' => 'required|in:manager,player,viewer',
        ]);

        $user = User::where('email', $validated['email'])->firstOrFail();
        
        // Check if user is already a member
        if ($team->members->contains($user->id)) {
            return back()->with('error', 'User is already a member of this team.');
        }

        $team->members()->attach($user->id, [
            'role' => $validated['role'],
        ]);

        return back()->with('status', 'User invited to team successfully!');
    }

    public function updateMemberRole(Request $request, Team $team, User $member)
    {
        $validated = $request->validate([
            'role' => 'required|in:owner,manager,player,viewer',
        ]);

        $this->authorize('updateMemberRole', [$team, $validated['role']]);
        
        $team->members()->updateExistingPivot($member->id, [
            'role' => $validated['role'],
        ]);

        return back()->with('status', 'Member role updated successfully!');
    }

    public function removeMember(Team $team, User $member)
    {
        $this->authorize('removeMember', [$team, $member]);
        
        $team->members()->detach($member->id);

        return back()->with('status', 'Member removed from team successfully!');
    }
}
