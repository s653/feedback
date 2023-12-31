<?php

namespace App\Observers;

use App\Models\Vote;
use App\Models\Feeback;
use Log;

class VoteObserver
{
    /**
     * Handle the Vote "created" event.
     *
     * @param  \App\Models\Vote  $vote
     * @return void
     */
    public function created(Vote $vote)
    {
        $feedback = Feedback::firstOrFail($vote->feedback_id);
        $feedback->voter_ids->push($feedback->user_id);
        Feedback::update([
            'voter_ids' => $feedback->voter_ids
        ]);
        Log::info($feedback->voter_ids);
    }

    /**
     * Handle the Vote "updated" event.
     *
     * @param  \App\Models\Vote  $vote
     * @return void
     */
    public function updated(Vote $vote)
    {
        //
    }

    /**
     * Handle the Vote "deleted" event.
     *
     * @param  \App\Models\Vote  $vote
     * @return void
     */
    public function deleted(Vote $vote)
    {
        $feedback = Feedback::firstOrFail($vote->feedback_id);
        $feedback->voter_ids->push($feedback->user_id);
        Feedback::update([
            'voter_ids' => $feedback->voter_ids
        ]);
        Log::info($feedback->voter_ids);
    }

    /**
     * Handle the Vote "restored" event.
     *
     * @param  \App\Models\Vote  $vote
     * @return void
     */
    public function restored(Vote $vote)
    {
        //
    }

    /**
     * Handle the Vote "force deleted" event.
     *
     * @param  \App\Models\Vote  $vote
     * @return void
     */
    public function forceDeleted(Vote $vote)
    {
        //
    }
}
