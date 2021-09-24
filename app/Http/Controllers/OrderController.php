<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function create()
    {
        if (Auth::check()) {
            $data = [];
            $data["title"] = "Create order";
            $data['user'] = User::find(Auth::id());
            return view('order.create', ["data" => $data]);
        }else{
            return redirect()->route('home.index');
        }
        
    }

    public function show($id)
    {
        if (Auth::check()) {
            $data = [];
            $user = Auth::user();
            $order = $user->orders()
                ->where('id', $id)
                ->first();
            if ( $order !== null){
                $order = Order::findOrFail($id);
                $data["title"] = 'Order ' . $id;
                $data["order"] = $order;
                return view('order.show', ["data" => $data]);
            }else if ($user->getIsStaff()){
                dd('Es admin! Todo lo puede ver!');
            }
            
        }

        
        return redirect()->route('home.index');
        
    }

    public function save(Request $request)
    {
        if (Auth::check()) {
            Order::validate($request);
            $user = User::find(Auth::id());
            $order = new Order($request -> only(["address","payment_type"]));
            $order->setDate(date("Y/m/d"));
            $user->orders()->save($order);
            return redirect()->route('order.list');
        }else{
            return redirect()->route('home.index');
        }
    }

    public function list()
    {
        $data = Order::orderBy('id')->get();
        dd($data);
    }

    public function delete($id)
    {
        
        $order = Order::find($id);

        $order->delete();

        dd($order);
    }


    public function cancelOrder(Request $request, $id)
    {
        # Muestre mensaje
        # Restablezca valores de movies
    }

    public function hasBeenShipped(Request $request, $id)
    {
        # Cambia estado de is_shipped
        # Solo admin
    }

    public function checkOut(Request $request, $id)
    {
        # redirect a carrito
    }


    public function pay(Request $request, $id)
    {
        # Boton que diga pagar
        # redirect a .show order
    }
}
