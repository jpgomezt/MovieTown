<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
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
}
