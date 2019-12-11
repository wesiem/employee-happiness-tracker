<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Vote extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return parent::toArray($request);
    }

    public function create()
    {
        $vote = Vote::create([
            'mood_id' => 3,
            'datetime' => date("Y-m-d H:i:s")
        ]);

        return new VoteResource($vote);
    }
}
