<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categorie;
use App\Models\Subcategorie;
use App\Models\Product;
class helperFunctions extends Controller
{
    public function getAllCat(){
        $data['category'] = Categorie::Pluck('name','id');
        return response()->json(['category' => $data['category']]);
    }
    public function getAllSubcat($cat_id = null){
        if($cat_id == null){
            $data['category'] = Subcategorie::Pluck('name','id');
            return response()->json(['category' => $data['category']]);
        }
        else{
            $data['category'] = Subcategorie::where('category_id', $cat_id)->Pluck('name','id');
            return response()->json(['category' => $data['category']]);
        }
    }
    public function productdetails($cat_id = null, $sub_id = null) {
        $product = Product::with(['categorie', 'subcategorie'])
            ->when($cat_id, function ($query) use ($cat_id) {
                return $query->where('category_id', $cat_id);
            })
            ->when($sub_id, function ($query) use ($sub_id) {
                return $query->where('subcategory_id', $sub_id);
            })
            ->get();
        return response()->json(['product' => $product]);
    }
    
}
