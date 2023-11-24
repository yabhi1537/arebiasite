<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use DB;
use Illuminate\Support\Facades\Cookie;
class CartController extends Controller
{

    public function index()
    {
		$alldata='';
		if(Cookie::get('reeeee'))
		{
		  $allcokketdata = decrypt(Cookie::get('reeeee'));
		  $alldata = explode('|',$allcokketdata);
		}
		$loginuser = Auth::user();
		if(app()->getLocale() == 'en'){

        return View::make('en.pages.cart', compact('loginuser','alldata'));
        }else {
			
        return View::make('ar.pages.cart', compact('loginuser','alldata'));    
	    }
    }
    public function addProjecttoCart(Request $request,$local,$ID)
    {
		$id = decrypt($ID);
		
		if($request->type != 'sponser')
		{
			$project = DB::table('tbl_projects')->where('project_id','=',$id)->get()->first();
			$session = \Session::getId();
			
			/*for zakat project allredy added*/
			if($project->project_type == 9  )
			{
				  $cart = session()->get('cart');
				if(isset($cart[$id])) {
					unset($cart[$id]);
					session()->put('cart', $cart);
				}
			}
		
				$cart = session()->get('cart', []);
				if(isset($cart[$id])) {
					$cart[$id]['quantity']++;
					$cart[$id]['price'] = $cart[$id]['price'] + $request->project_price ;
				   
				} else {
					$cart[$id] = [
						"session_id"   =>  $session,
						"name" => $project->project_name,
						"quantity" => 1,
						"price" => $request->project_price,
						"country"=> $project->project_country,
						"image" => $project->image
					];
				}
		}
        else{
		    $project = DB::table('sponsorship')->where('id','=',$id)->get()->first();
			$session = \Session::getId();
			
			  $id = 'S_'.$id;
			   
			   $cart = session()->get('cart');
				if(isset($cart[$id])) {
					unset($cart[$id]);
					session()->put('cart', $cart);
				}

			   $cart = session()->get('cart', []);
				if(isset($cart[$id])) {
					$cart[$id]['quantity']++;
					$cart[$id]['price'] = $cart[$id]['price'] + $request->project_price ;
				   
				} else {
					$cart[$id] = [
						"session_id"   =>  $session,
						"name" => $project->name,
						"quantity" => 1,
						"price" => $request->project_price,
						"country"=> $project->country,
						"image" => ''
					];
				}
		 }
        session()->put('cart', $cart);
        
        session()->flash('success', 'Product has been added to cart!');
    }
    
    public function updateCart(Request $request)
    {
        if($request->id && $request->quantity){
            $cart = session()->get('cart');
            $cart[$request->id]["quantity"] = $request->quantity;
            session()->put('cart', $cart);
            session()->flash('success', 'Book added to cart.');
        }
    }
  
    public function deleteProject(Request $request)
    {
        if($request->id) {
            $cart = session()->get('cart');
            if(isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            session()->flash('success', 'Cart item successfully deleted.');
        }
    }
    public function clearcartProject(Request $request)
    {
            $cart = session()->get('cart');
            
            if(isset($cart)) {
                unset($cart);
                session()->forget('cart');
                //$request->session()->flush();
            }
            session()->flash('success', 'Cart Clear successfully.');
       
    }
}
