<?php

namespace Wj\CarShopBundle\Model;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    public function reviews()
    {
        return $this->hasMany('Wj\DealerBundle\Model\Review');
    }
}
