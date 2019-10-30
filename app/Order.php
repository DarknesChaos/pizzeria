<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    /**
     * The database table used by the model
     *
     * @var string
     */
    protected $table = 'orders';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'date', 'total', 'employee_id'
    ];

    public function products()
    {
        return $this->belongsToMany('App\Pizza', 'items', 'order_id', 'pizza_id')->withPivot('quantity');
    }
}
