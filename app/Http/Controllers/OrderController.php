<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use PDF;

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
            $data['list'] = Order::with('user')->orderBy('id')->get();
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
            $order->delete();
            return redirect()->route('order.list');
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

        // download pdf file
        return $pdf->download('Orders.pdf');
    }
}
