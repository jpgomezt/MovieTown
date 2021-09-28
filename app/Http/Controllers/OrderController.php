<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use PDF;

class OrderController extends Controller
{
    public function show($id)
    {
        if (Auth::check()) {
            $data = [];
            $user = Auth::user();
            if ($user->getIsStaff()) {
                $order = Order::findOrFail($id);
                $data["order"] = $order;
                $data["title"] = 'Order ' . $id;
                $data["time"] = false;
                return view('admin.order.show', ["data" => $data]);
            } else {
                $order = $user->orders
                    ->where('id', $id)
                    ->first();
                if ($order !== null) {
                    $order = Order::findOrFail($id);
                    $data["title"] = 'Order ' . $id;
                    $data["order"] = $order;
                    $now = strtotime(date("Y-m-d"));
                    $shipping_date = strtotime($order->getShippingDate());
                    $data['time'] = (($now - $shipping_date)/60/60/24) < 0;
                    return view('order.show', ["data" => $data]);
                }
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
            $data['list'] = Order::with('user')->with('items')->orderBy('id')->get();
            $total = 0;
            $movie_count = 0;
            foreach ($data['list'] as $order) {
                $total = $total + $order->getTotal() + $order->getShippingCost();
                foreach ($order->items as $item) {
                    $movie_count++;
                }
            }
            $data['total_movies'] = $movie_count;
            $data['total_money'] = $total;
            return view('admin.order.list', ["data" => $data]);
        } else {
            $data['list'] = Order::with('user')
                ->orderBy('id')
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
            $items = $order->items;
            foreach ($items as $item) {
                $item->delete();
            }
            $order->delete();
            if (Auth::user()->getIsStaff()) {
                return redirect()->route('admin.order.list');
            } else {
                return redirect()->route('order.list');
            }
        }
        return redirect()->route('home.index');
    }

    public function ordersPdf()
    {

        $data = [];
        $data['title'] = 'Orders list';
        $user = Auth::user();
        if ($user->getIsStaff()) {
            $data['list'] = Order::with('user')->orderBy('id')->get();
        } else {
            $data['list'] = Order::with('user')
                ->orderBy('id')
                ->where('user_id', $user->getId())
                ->get();
        }

        $pdf = PDF::loadView('order.downloadPdf', ["data" => $data]);

        return $pdf->download('Orders.pdf');
    }
}
