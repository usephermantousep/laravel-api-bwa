<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Transaction extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'food_id', 'user_id', 'quantity', 'total', 'status',
        'payment_url'
    ];

    public function food()
    {
        return $this->hasOne(Food::class, 'id','food_id');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id','user_id');
    }

    public function getCreatedAtAtribute($value)
    {
        return Carbon::parse($value)->timestamp;
    }

    public function getUpdatedAtAtribute($value)
    {
        return Carbon::parse($value)->timestamp;
    }
}
