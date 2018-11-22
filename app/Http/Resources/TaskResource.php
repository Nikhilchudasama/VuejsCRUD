<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TaskResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // $data = array(
        //     'title' => $this->title,
        //     'description' => $this->description,

        // );
        // foreach ($this->media as $mediaKey => $media) {
        //     // $data['images'][$mediaKey] = $media->getFullUrl();
        //     $data['images'] =  $media->getFullUrl();
        // }
        // return $data;
        return [
            'title' => $this->title,
            'description' => $this->description,
            'image' => asset($this->getFirstMediaUrl('image'))
        ];
    }
}
