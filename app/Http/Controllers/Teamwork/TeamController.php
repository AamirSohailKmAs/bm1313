<?php

namespace App\Http\Controllers\Teamwork;

use App\Models\Team;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class TeamController extends Controller
{
    public function index()
    {
        return view('teams.index', [
            'teams' => Team::with('owner')->get()
        ]);
    }

    public function create()
    {
        return view('teams.create', [
            'users' => User::where(['current_team_id' => null])->whereNot('id', '=', 1)->get(),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'unique:teams,name'],
            'team_owner' => ['required', 'integer'],
            'user' => ['required', 'array'],
        ]);
        $team_owner = User::where(['current_team_id' => null])->findOrFail($request->team_owner);
        $users = User::whereIn('id', array_keys($request->user))->get();

        $team = Team::create([
            'name' => $request->name,
            'owner_id' => $request->team_owner,
        ]);
        $team_owner->attachTeam($team);
        foreach ($users as $user) {
            $user->attachTeam($team);
        }
        return redirect(route('teams.index'))->withSuccess(__('Team Created Successfully'));
    }
    public function show(Team $team)
    {
        return view('teams.show', [
            'team' => $team,
            'members' => $team->members,
        ]);
    }

    public function edit(Team $team)
    {
        return view('teams.edit', [
            'team' => $team,
            'members' => $team->members,
            'users' => User::where(['current_team_id' => null])->get(),
        ]);
    }

    public function update(Request $request, Team $team)
    {
        $request->validate([
            'name' => ['required', 'string', 'unique:teams,name,' . $team->id],
            'user' => ['nullable', 'array'],
        ]);
        $team->name = $request->name;
        $team->syncMembers($request->user);
        $team->save();
        return redirect(route('teams.index'))->withSuccess(__('Team Updated Successfully'));
    }

    public function destroy(Team $team)
    {
        $team->delete();

        $userModel = config('teamwork.user_model');
        $userModel::where('current_team_id', $team->id)
            ->update(['current_team_id' => null]);

        return redirect(route('teams.index'));
    }
}
