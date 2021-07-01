<?php

namespace App\Http\Resources;

use App\Models\Seller;
use Illuminate\Http\Resources\Json\JsonResource;

class SaleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $seller = Seller::where('uuid',$this->seller_uuid)->first();
        return [
            'id' => $this->uuid,
            'seller' => [
                'name' => $seller->name,
                'email' => $seller->email
            ],
            'sale_value' => $this->sale_value,
            'commission' => $this->commission,
            'created_at' => $this->created_at,
        ];
    }
}