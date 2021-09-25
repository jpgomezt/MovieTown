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
        } else {
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
            if ($order !== null) {
                $order = Order::findOrFail($id);
                $data["title"] = 'Order ' . $id;
                $data["order"] = $order;
                return view('order.show', ["data" => $data]);
            } elseif ($user->getIsStaff()) {
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
        } else {
            return redirect()->route('home.index');
        }
    }

    public function list()
    {
        $data = [];
        $data['title'] = 'Orders list';
        $user = Auth::user();
        if ($user->getIsStaff()) {
            $data['list'] = Order::orderBy('id')->get();
            dd('Es admin! Todo lo puede ver!');
        } else {
            $data['list'] = Order::orderBy('id')
                    ->where('user_id', $user->getId())
                    ->get();
            
            return view('order.list', ["data" => $data]);
        }
        return redirect()->route('home.index');
    }

    public function delete($id)
    {
        if (Auth::check()) {
            $order = Order::find($id);

            $order->delete();

            return redirect()->route('order.list');
        } else {
            return redirect()->route('home.index');
        }
    }


    public function update($id)
    {
        if (Auth::check()) {
            $data = [];
            $user = Auth::user();
            $order = $user->orders()
                ->where('id', $id)
                ->first();
            if ($order !== null) {
                $data["title"] = "Update order";
                $data['order'] = Order::findOrFail($id);

                return view('order.update', ["data" => $data]);
            } elseif ($user->getIsStaff()) {
                dd('Es admin! Todo lo puede ver!');
            }
        } else {
            return redirect()->route('home.index');
        }
    }

    public function updateProcess(Request $request, $id)
    {
        if (Auth::check()) {
            Order::validate($request);
            $user = User::find(Auth::id());
            $order = Order::findOrFail($id);
            $order->setAddress($request->input('address'));
            $order->setPaymentType($request->input('payment_type'));
            $order->setDate(date("Y/m/d"));
            $user->orders()->save($order);

            return redirect()->route('order.show', ['id' => $id]);
        } else {
            return redirect()->route('home.index');
        }
    }

    public function cancelOrder(Request $request, $id)
    {
        # Muestre mensaje
        # Restablezca valores de movies
    }

    public function hasBeenShipped($id)
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
