<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $fillable = [
        'path',
        'description',
        'o_id',
        'o_type'
    ];

    public function product()
    {
        return $this->hasOne(Product::class);
    }

    public function user()
    {
        return $this->hasOne(User::class);
    }
}
