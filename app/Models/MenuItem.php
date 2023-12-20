<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'description',
        'extra_description',
        'image',
        'available',
    ];

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function menus()
    {
        return $this->belongsToMany(Menu::class);
    }
}
