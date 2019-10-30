<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pizza extends Model
{
    /**
     * The database table used by the model
     *
     * @var string
     */
    protected $table = 'pizzas';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'size', 'price'
    ];

    public function orders()
    {
        return $this->belongsToMany('App\Order', 'items', 'pizza_id', 'order_id')->withPivot('quantity');
    }
}
