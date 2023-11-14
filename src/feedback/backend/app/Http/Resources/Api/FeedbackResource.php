<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class FeedbackResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'isVoted' => $this->checkIfAlreadyVoted($this->voter_ids),
            'total_votes' => $this->total_votes,
            'total_comments' => $this->total_comments,
            'created_at' => $this->created_at
        ];
    }

    private function checkIfAlreadyVoted($voterIds): bool {
        return sizeof($voterIds) > 0 ? in_array(auth()->id(), $voterIds) : false;
    }
}
