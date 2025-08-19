<?php

namespace App\Http\Middleware;

use App\Models\Team;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetCurrentTeam
{
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check()) {
            $user = $request->user();
            
            // If no team is set in session, try to get the first team the user belongs to
            if (!$request->session()->has('current_team_id')) {
                $firstTeam = $user->teams()->first();
                if ($firstTeam) {
                    $request->session()->put('current_team_id', $firstTeam->id);
                }
            }

            // If we have a current team in session, set it on the user model
            if ($teamId = $request->session()->get('current_team_id')) {
                $team = Team::find($teamId);
                if ($team && $user->teams->contains($team->id)) {
                    $user->setCurrentTeam($team);
                } else {
                    // If the team doesn't exist or user doesn't have access, clear it from session
                    $request->session()->forget('current_team_id');
                }
            }
        }

        return $next($request);
    }
}
