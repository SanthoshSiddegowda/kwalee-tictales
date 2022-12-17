<?php

namespace App\Http\Controllers\v1;

use App\Classes\v1\OrderClass;
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Order\getOrderRequest;
use App\Http\Resources\SaveResource;
use App\Http\Resources\ValidationResource;

class OrderController extends Controller
{
    public function add(getOrderRequest $request): ValidationResource|SaveResource
    {
        $order = new OrderClass();
        $order = $order->add($request->all());
        if ($order['code'] == 422) {
            return new ValidationResource(collect([
                'message' => $order['error'],
            ]));
        }

        return new SaveResource([
            'message' => "Thanks!! Your Order Id $order[data]",
        ]);
    }
}
