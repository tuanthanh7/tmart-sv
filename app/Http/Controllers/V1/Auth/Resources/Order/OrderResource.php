<?php

namespace App\Http\Controllers\V1\Auth\Resources\Order;

use App\Http\Resources\BaseResource;
use App\Supports\SERVICE_Error;

class OrderResource extends BaseResource
{
    public function __construct($resource)
    {
        parent::__construct($resource);
    }
    /**
     * @param \Illuminate\Http\Request $request
     * @return array
     * @throws \Exception
     */
    public function toArray($request)
    {
        try {
            return [
                'id' => $this->id,
                'user_id' => $this->user_id,
                'order_details' => $this->orderDetails->map(function($item){
                    return [
                        'id' => $item->id,
                        'product_id' => $item->product_id,
                        'product_name' => $item->product?->product_name,
                        'thumpnail_url' => $item->product?->thumpnail_url,
                        'quantity' => $item->quantity,
                        'price' => $item->price,
                        'price_formated' => number_format($item->price, 0, ',', '.') . ' đ',
                        'option' => $item->option,
                        'subtotal' => $item->subtotal,
                        'subtotal_formated' => number_format($item->subtotal, 0, ',', '.') . ' đ',
                    ];
                }),
                'order_number' => $this->order_number,
                'info_total_amount' => $this->info_total_amount,
                'status_code' => $this->status_code,
                'status_name' => $this->orderStatus->name,
                'shipping_company_id' => $this->shipping_companie_id,
                'name' => $this->name,
                'phone' => $this->phone,
                'payment_uid' => $this->payment_uid,
                'payment' => $this->orderPayments,
                'coupon_code' => $this->coupon_code,
                'voucher_code' => $this->voucher_code,
                'note' => $this->note,
                'recipient_address' => $this->recipient_address,
                'shipping_address' => $this->shipping_address,
                'billing_address' => $this->billing_address,
                'free_item' => $this->free_item,
                'order_date' => $this->order_date,
                'created_at' => !empty($this->created_at) ? date('Y-m-d H:i:s', strtotime($this->created_at)) : null,
                'updated_at' => !empty($this->updated_at) ? date('Y-m-d H:i:s', strtotime($this->updated_at)) : null,
                'deleted_at' => !empty($this->deleted_at) ? date('Y-m-d H:i:s', strtotime($this->deleted_at)) : null,
            ];
        } catch (\Exception $ex) {
            $response = SERVICE_Error::handle($ex);
            throw new \Exception($response['message']);
        }
    }
}
