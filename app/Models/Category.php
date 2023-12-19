<?php

// app/Models/Category.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Category extends Model
{
    /**
     * Get the menu items associated with the category.
     */
    use HasFactory;

    protected $fillable = [
        'name',
    ];
    public function menuItems()
    {
        return $this->belongsToMany(MenuItem::class);
    }
}
