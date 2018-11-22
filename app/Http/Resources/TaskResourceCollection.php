<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class TaskResourceCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return $this->collection->transform(function ($tasks) {
            $data = [
                    'id' => $tasks->id,
                    'title' => $tasks->title,
                    'description' => $tasks->description,
                    'image' => asset($tasks->getFirstMediaUrl('image')),
            ];
            return $data;
        });
    }
}
