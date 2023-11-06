<?php

namespace App\Services;

use App\Services\Service;
use App\Models\Feedback;
use App\Http\Resources\Api\FeedbackResource;

/**
 * Class FeedbackService
 * @package App\Services
 */
class FeedbackService implements Service
{
    public function getUserFeedbacks()
    {
        $feedbacks = Feedback::latest()->simplePaginate(12);
        return FeedbackResource::collection($feedbacks);
    }

    public function create($data)
    {
        $feedback = Feedback::create($data+['user_id' => auth()->id()]);
        return new FeedbackResource($feedback);
    }

    public function show($id)
    {

    }

    public function update($data, $id)
    {

    }

    public function delete($id)
    {

    }

}
