<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{ 
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    // protected $hidden = [ 
    //     'total_quantity_by_unit_id' 
    // ];

    protected $appends = [
        'total_quantity',
        'image_path',
        // 'total_quantity_by_unit_id'
    ];

    public function units()
    {
        return $this->belongsToMany(Unit::class)->withPivot("amount");
    }

    public function getTotalQuantityAttribute()
    {        
        foreach ($this->units()->get() as $unit) {
            $items[] =  $unit->modifier * $unit->pivot->amount;
         }
         //total_quantity
        return array_sum ($items);
    }

    public function getTotalQuantityByUnitAttribute($unit_id)
    {
        // $this->setAttributeVisibility();
        foreach ($this->units()->get() as $unit) {
            $items[] = $unit->modifier * $unit->pivot->amount;
        }
        Unit::where('id', "=", $unit_id)->get()->map(function ($required_unit) use ($items) {
          return $this->total_quantity_by_unit_id =  array_sum($items) / $required_unit->modifier;
        });
    }

    // public function setAttributeVisibility()
    // {
    //     $this->makeVisible(array_merge($this->fillable, $this->appends, ['total_quantity_by_unit_id']));
    // }

    public function getImagePathAttribute()
    {
        return $this->imagePath();
    }

    public function imagePath()
    {
        return $this->hasOne(Image::class, 'o_id')->where('o_type','product');
    }
}
