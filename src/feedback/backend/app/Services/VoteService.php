<?php

namespace App\Services;

use App\Services\Service;
use App\Models\Vote;
use App\Http\Resources\Api\ProfileResource;

/**
 * Class VoteService
 * @package App\Services
 */
class VoteService implements Service
{
    public function index()
    {
    }

    public function create($data)
    {
        $voter = Vote::create($data+['user_id' => auth()->id()]);
        return new ProfileResource($voter->user());
    }

    public function show($id)
    {
        $voters = Vote::select('users.*')
        ->join('users', 'users.id', '=', 'votes.user_id')
        ->where('feedback_id', $id)
        ->latest()->simplePaginate(12);

        return ProfileResource::collection($voters);
    }

    public function update($data, $id)
    {
        $vote = Vote::where('feedback_id', $data['feedback_id'])->where('user_id', auth()->id())->first();
        if($vote) {
            $vote->delete();
            return new ProfileResource($voter->user());
        } else {
            $voter = Vote::create($data+['user_id' => auth()->id()]);
            return new ProfileResource($voter->user());
        }
    }

    public function delete($id)
    {
    }
}
