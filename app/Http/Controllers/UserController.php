<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Carbon\Carbon;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Subcategorie;
use App\Models\Categorie;
use App\Models\Order;

class UserController extends Controller
{
    public function registration(){
        return view('user.registration');
    }
    public function registrationDB(Request $request){
        $validation = Validator::make($request->all(),[
            'name'=>'required',
            'email'=>'required',
            'password'=>'required'
        ]);
        if($validation->failed()){
            return back()->with('error', $validation->errors());
        }
        else{
            $newUser = new User();
            $newUser->name = $request->input('name');
            $newUser->email = $request->input('email');
            $newUser->password = Hash::make($request->input('password'));
            if($newUser->save()){
                $user = User::where('email', $request->input('email'))->first();
                Session::put('user_id', $user->id);
                return redirect('user/home')->with('success', true);
            }else{
                return back()->with('error','something bad happend');
            }
        }
    }
    public function userHome(Request $request) {
        $id = $request->input('id'); 
        $data['loLoadOnForm'] = Product::find($id);
        $data['category'] = Categorie::pluck('name', 'id');
        $data['subcategory'] = Subcategorie::pluck('name', 'id');
        $data['order'] = Order::get();
        $data['product'] = Product::with(['categorie', 'subcategorie'])
            ->paginate(5);
        if ($request->ajax()) {
            return view('user.products_list', ['data' => $data])->render();
        }
    
        return view('user.home')->with('data', $data);
    }
    
    public function loginPage(){
        return view('user.loginPage');
    }
    public function login(Request $request){
        $validation = Validator::make($request->all(),[
            'email'=>'required',
            'password'=>'required'
        ]);
        if($validation->failed()){
            return back()->with('error','validataion failed');
        }
        else{
            $user = User::where('email', $request->input('email'))->first();
            if ($user) {
                if ($user->locked_until && Carbon::parse($user->locked_until)->isFuture()) {
                    return back()->with('error','Try later');
                }
                if (Hash::check($request->password, $user->password)) {
                    $user->failed_attempts = 0;
                    $user->locked_until = null;
                    $user->save();
                    Session::put('user_id',$user->id);
                    return redirect('user/home')->with('success','true');
                } 
                else {
                    $user->failed_attempts++;
                    if ($user->failed_attempts >= 5) {
                        $user->locked_until = Carbon::now()->addMinutes(10);
                    }
                    $user->save();
                    return back()->with('error', 'Login failed');
                }
            }
            else{
                return back()->with('error','enter valid email');
            }
        }
    }
    public function redirectToUser(){
        return redirect('user/home');
    }
}
