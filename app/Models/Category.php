<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        "menu_id",
    ];

    public function menu() {
        return $this->belongsTo(Menu::class);
    }

    public function translations() {
        return $this->hasMany(CategoryTranslation::class);
    } 

    public function items(){
        return $this->belongsToMany(Item::class, 'category_item');
    }
}
