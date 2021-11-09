<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AuthorResource extends JsonResource
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
            'name' => $this->name,
            'age' => $this->age,
            'province' => $this->province,
            'created-at' => $this->created_at->format('m-d-Y | h:i:s A'),
            'updated_at'=>$this->updated_at->format('j, l F Y | h:i:s A'),
        ];
    }
}
