<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function category()
    {
        return $this->belongsTo(Category::class,);
    }

    public function foods()
    {
        return $this->hasMany(Food::class);
    }

    public function drinks()
    {
        return $this->hasMany(Drink::class);
    }
}
