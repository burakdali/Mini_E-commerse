<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CartResource extends JsonResource
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
            "type" => "cart",
            "id" => $this->id,
            "user" => $this->user->name,
            "total_cart_amount" => $this->total_cart_amount,
            "is_finished" => $this->is_finished

        ];
    }
}
