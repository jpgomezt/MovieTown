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
        $data = [];
        $data["title"] = "Create order";

        dd($data);
    }

    public function show($id)
    {
        $data = [];
        $order = Order::findOrFail($id);

        $data["title"] = 'Orden' . $id;
        $data["order"] = $order;
        dd($data);
    }

    public function save(Request $request)
    {
        Order::validate($request);
        $user = User::find(Auth::id());
        $order = new Order($request -> only(["address","date","payment_type","shipping_date","shipping_cost","total","is_shipped"]));
        $user->orders()->save($order);
        return back()->with('success', 'Elemento Creado Satisfactoriamente');
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
