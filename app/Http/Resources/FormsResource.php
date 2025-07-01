<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FormsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id"=>$this->id,
            'title' => $form->title,
            'description' => $form->description,
            // "country_id"=>$this->country_id,
            // "region_id"=>$this->region_id,
            // "status_id"=>$this->status_id,
            // "user_id"=>$this->user_id,
            // "created_at"=>$this->created_at->format("d m Y"),
            // "updated_at"=>$this->updated_at->format("d m Y"),

            "country"=>Country::where("id",$this->country_id)->select(["id","name"])->first(),
            "region"=>Region::where("id",$this->region_id)->select(["id","name"])->first(),
            "user"=>User::where("id",$this->user_id)->select(["id","name"])->first(),
            "status"=>Status::where("id",$this->status_id)->select(["id","name"])->first()
        ];
    }
}
