<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    public function categorie(){
        return $this->belongsTo(Categorie::class, 'category_id');
    }
    public function subcategorie(){
        return $this->belongsTo(Subcategorie::class, 'subcategory_id');
    }
}
