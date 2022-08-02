<?php

namespace App\Models;

use Mpociot\Teamwork\TeamworkTeam;
use Illuminate\Support\Facades\Config;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Team extends TeamworkTeam
{
    use HasFactory;

    /**
     * Many-to-Many relations with the user model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function members()
    {
        return $this->belongsToMany(Config::get('teamwork.user_model'), Config::get('teamwork.team_user_table'), 'team_id', 'user_id')->where('id', '<>', $this->owner_id)->withTimestamps();
    }



    /**
     * Sync Members by Detaching Old Members and Attaching New Members
     * @param array|null $members
     * 
     * @return [type]
     */
    public function syncMembers(?array $members)
    {
        $oldMembers = $this->users->where('id', '<>', $this->owner_id);
        foreach ($oldMembers as $oldMember) {
            $oldMember->detachTeam($this);
        }
        if ($members) {
            $newMembers = User::whereIn('id', array_keys($members))->get();
            foreach ($newMembers as $newMember) {
                $newMember->attachTeam($this);
            }
        }
    }
}
