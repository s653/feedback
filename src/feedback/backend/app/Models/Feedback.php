<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'user_id',
        'voter_ids',
        'category_id',
        'total_votes',
        'total_comments'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected function getVoterIdsAttribute($value)
    {
        return $value && !is_null($value) ? explode(',', $value) : [];
    }

    // protected function setVoterIdsAttribute($voterIds)
    // {
    //     return $voterIds ? implode(',', $voterIds) : "";
    // }
}
