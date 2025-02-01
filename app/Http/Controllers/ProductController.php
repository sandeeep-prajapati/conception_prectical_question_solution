<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\Subcategorie;
use Illuminate\Support\Facades\Validator;

use function PHPUnit\Framework\isEmpty;

class ProductController extends Controller
{
    public function updateProduct($id){
        $data = Product::with(['categorie', 'subcategorie'])->get();
        return view('user.editProduct')->with('product',$data);
    }
    
    public function addProduct(Request $request){
        $validation = Validator::make($request->all(),[
            'title' => 'required|string',
            'discription' => 'required|string',
            'amount' => 'required|numeric',
            'discount-type' => 'required|string',
            'discount' => 'required|numeric',
            'cataegory' => 'required',
            'subcataegory' => 'required',
        ]);
        if($validation->failed()){
            return back()->with('error', 'validation Failed');
        }
        else{
            $product = new Product();
            $product->title = $request->input('title');
            $product->description = $request->input('discription');
            $product->amount = $request->input('amount');
            $product->discount_type = $request->input('discount_type');
            $product->category_id = $request->input('cataegory');
            $product->subcategory_id = $request->input('subcataegory');
            $product->discount_amount = $request->input('discount');
            
            if($request->input('discount_type') == "Percentage"){
                $product->payable_amount = ((100-($request->input('discount')))/100) * ($request->input('amount'));
            }
            else{
                $product->payable_amount = $request->input('amount')-$request->input('discount');
            }
            if($product->save()){
                return redirect('user/home')->with('success',true);
            }
            else{
                return back()->with('success', false);
            }

        }
    }
    public function addOrUpdateSubcatgory(Request $request){
        $data['loadOnForm'] = Subcategorie::find($request->input('id'));
        $data['Categorie'] = Categorie::Pluck('name','id');
        return view('user.addOrUpdateSubcatgory')->with('data',$data);
    } 

    public function addOrUpdateCatgory(Request $request){
        $data['loadOnForm'] = Categorie::find($request->input('id'));
        return view('user.addOrUpdateCatgory')->with('data', $data);
    }

    public function storeSubategory(Request $request){
        $validation = Validator::make($request->all(),[
            'name'=>'required',
            'cat_id'=>'required|exists:categories, id'
        ]);
        if($validation->failed()){
            return back()->with('success',false);
        }
        $id = $request->input('id');
        $newSubCat = null;
        if($id){
            $newSubCat = Subcategorie::find($id);
        }
        else{
            $newSubCat = new Subcategorie();
        }
        $newSubCat->name = $request->input('name');
        $newSubCat->category_id = $request->input('cat_id');
        if($newSubCat->save()){
            return redirect('user/home')->with('success',true);
        }
        else{
            return back()->with('success', false);
        }
    }

    public function storeCategory(Request $request){
        $newCat = null;
        $id = $request->input('id');
        if(isset($id)){
            $newCat = Categorie::find($request->input('id'));
        }
        else{
            $newCat = new Categorie();
        }
        $newCat->name = $request->input('name');
        if($newCat->save()){
            return redirect('user/home')->with('success',true);
        }
        else{
            return back()->with('success', false);
        }
    }

    public function cat_delete($id = null) {
        $data = Categorie::find($id);
        $product = Product::where('category_id', $id)->get();
    
        if ($product->isEmpty()) { 
            if ($data && $data->delete()) {
                return response()->json(['success' => true]);
            } else {
                return response()->json(['success' => false, 'error' => 'Failed to delete category']);
            }
        } else {
            return response()->json(['success' => false, 'error' => 'Category has associated products']);
        }
    }
    public function delete($id){
        $data = Product::find($id);
        $order = Order::where('product_id')->get();
        if($order->isEmpty()){
            if($data->delete()){
                return response()->json(
                    ['success'=>'true']
                );
            }
            else{
                return response()->json(['success' => false, 'error' => 'Failed to delete category']);
            }
        }
        else{
            return response()->json(['success' => false, 'error' => 'Failed to delete category']);
        }
    }
    public function sub_delete($id = null) {
        $data = Subcategorie::find($id);
        $product = Product::where('subcategory_id', $id)->get();
    
        if ($product->isEmpty()) { 
            if ($data && $data->delete()) {
                return response()->json(['success' => true]);
            } else {
                return response()->json(['success' => false, 'error' => 'Failed to delete category']);
            }
        } else {
            return response()->json(['success' => false, 'error' => 'Category has associated products']);
        }
    } 
    public function orderStore($id = null){
        $newOrder = new Order();
        $newOrder->product_id  = $id;
        $newOrder->status = "pending";
        if($newOrder->save()){
            return redirect('user/home')->with('success',true);
        }
        else{
            return back()->with('success',false);
        }
    }
    public function updateOrder(Request $request)
    {
        $sortedIDs = $request->sortedIDs;

        foreach ($sortedIDs as $index => $id) {
            Product::where('id', $id)->update(['order_column' => $index + 1]);
        }

        return response()->json(['message' => 'Product order updated successfully']);
    }
}
