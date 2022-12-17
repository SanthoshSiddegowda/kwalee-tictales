<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserAvatar extends Model
{
    use HasFactory,SoftDeletes;

    protected $hidden = [
        'item_id',
        'category_id',
        'user_id',
        'deleted_at',
        'created_at',
        'updated_at',
    ];

    public function items(): \Illuminate\Database\Eloquent\Relations\hasMany
    {
        return $this->hasMany(Item::class);
    }
}
