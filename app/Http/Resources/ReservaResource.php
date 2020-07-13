<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ReservaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "date"=> date('D M d Y',strtotime($this->fecha)) ,
            "startTime"=> $this->hora_inicio,
            "endTime"=> $this->hora_fin,
            "cancha_id"=> $this->cancha_id,
            "user_id"=> $this->user_id,
            "user"=> $this->user->name,
            "created_at"=> $this->created_at,
            "updated_at"=> $this->updated_at,
        ];
    }
}
