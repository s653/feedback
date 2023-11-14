<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\{
    User,
    Feedback
};

use Log;

class Vote extends Model
{
    use HasFactory;

    protected $fillable = [
        'feedback_id',
        'user_id'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }


    protected static function booted(): void
    {
        static::created(function (Vote $vote) {
            $feedback = Feedback::where('id',$vote->feedback_id)->first();
            $voterIds = $feedback->voter_ids ? $feedback->voter_ids : [];
            array_push($voterIds, $feedback->user_id);
            $voterIds = implode(",", $voterIds);
            $feedback->voter_ids = $voterIds;
            $feedback->total_votes = $feedback->total_votes+1;
            $feedback->save();
        });
        static::deleted(function (Vote $vote) {
            $feedback = Feedback::where('id',$vote->feedback_id)->first();
            $voterIds = $feedback->voter_ids ? $feedback->voter_ids : [];
            if(($key = array_search($vote->user_id, $voterIds)) !== false) {
                unset($voterIds[$key]);
            }
            $feedback->voter_ids = $voterIds;
            if($feedback->total_votes > 0) {
                $feedback->total_votes = $feedback->total_votes-1;
            }
            $feedback->save();
        });
    }
}
