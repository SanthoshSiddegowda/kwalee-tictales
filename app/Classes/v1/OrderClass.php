<?php

namespace App\Classes\v1;

use App\Models\Item;
use App\Models\Order;
use App\Models\User;
use App\Models\UserAvatar;
use Illuminate\Support\Str;

class OrderClass
{
    public function add($request): array
    {
        $response = ['code' => 200, 'error' => '', 'data' => ''];
        $request = $this->reStructureRequest($request);
        $userBalance = $this->getUserBalanceById($request['user_id']);
        if ($userBalance <= $request['total_amount']) {
            $response['code'] = 422;
            $response['error'] = 'Low Balance, please recharge the wallet';

            return $response;
        }
        $orderUuid = $this->addOrder($request);
        $response['code'] = 200;
        $response['data'] = $orderUuid;

        return $response;
    }

    private function reStructureRequest(array $request): array
    {
        $request['total_amount'] = 0;
        foreach ($request['items'] as $key => $item) {
            $itemDetails = $this->getItemDetailsById($item['item_id']);
            if (! empty($itemDetails)) {
                $request['items'][$key]['uuid'] = Str::orderedUuid();
                $request['items'][$key]['amount'] = $itemDetails['price'];
                $request['total_amount'] = $request['total_amount'] + ($itemDetails['price'] * $item['quantity']);
            }
        }

        return $request;
    }

    private function getUserBalanceById(float $id): ?float
    {
        $userBalance = User::select('remaining_balance')->where('id', $id)->first();

        return $userBalance['remaining_balance'];
    }

    private function getItemDetailsById(int $id): object
    {
        return Item::where('id', $id)->first();
    }

    private function addOrder(array $details, string $uuid = null): string
    {
        $order = Order::firstOrCreate(
            ['uuid' => $uuid],
            [
                'uuid' => Str::orderedUuid(),
                'user_id' => $details['user_id'],
                'amount' => $details['total_amount'],
                'is_paid' => 1,
            ]
        );
        $this->addOrderDetails($order, $details['items'], true);

        return (string) $order->uuid;
    }

    private function addOrderDetails(object $order, array $orderDetails, bool $addUserAvatar): void
    {
        $order->details()->createMany(
            $orderDetails
        );
        if (! empty($addUserAvatar)) {
            $this->addUserAvatar($order, $orderDetails);
            $this->deductUserBalance($order->amount, $order->user_id);
        }
    }

    private function addUserAvatar(object $order, array $details): void
    {
        foreach ($details as $key => $avatar) {
            $itemDetails = $this->getItemDetailsById($avatar['item_id']);
            if (! empty($itemDetails)) {
                $userAvatar = UserAvatar::where([
                    'item_id' => $avatar['item_id'],
                    'is_inventory' => $avatar['is_inventory'],
                ])->first();
                if (! empty($userAvatar)) {
                    $userAvatar->quantity += $avatar['quantity'];
                } else {
                    $userAvatar = new UserAvatar;
                    $userAvatar->uuid = Str::orderedUuid();
                    $userAvatar->user_id = $order->user_id;
                    $userAvatar->item_id = $itemDetails->id;
                    $userAvatar->category_id = $itemDetails->category_id;
                    $userAvatar->name = $itemDetails->name;
                    $userAvatar->description = $itemDetails->description;
                    $userAvatar->quantity = $avatar['quantity'];
                    $userAvatar->image_url = $itemDetails->image_url;
                    $userAvatar->is_inventory = $avatar['is_inventory'];
                }
                $userAvatar->save();
            }
        }
    }

    private function deductUserBalance(float $amount, int $userId): void
    {
        $user = User::where('id', $userId)->first();
        if (! empty($user)) {
            $user->remaining_balance -= $amount;
            $user->save();
        }
    }
}
