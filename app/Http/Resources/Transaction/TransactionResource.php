<?php

namespace App\Http\Resources\Transaction;

use Illuminate\Http\Resources\Json\JsonResource;

class TransactionResource extends JsonResource
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
            'id'=>$this->id,
            'destination_id'=>$this->destination_id,
			'destination_name'=>$this->destination_name,
            'customer_id'=>$this->customer_id,
			'customer_name'=>$this->customer_name,
            'price'=>$this->price,
            'qty'=>$this->qty,
            'total_cost_price'=>$this->total_cost_price,
            'discount'=>$this->discount,
            'total'=>$this->total,
            'invoice_tax'=>$this->invoice_tax,
            'total_tax'=>$this->total_tax,
            'net_tax'=>$this->net_tax,
        ];
    }
}
