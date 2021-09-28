<?php

/**
 * @author Juan Pablo Gómez
 */

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class ItemController extends Controller
{
    public function list($id)
    {
        if (Auth::check()) {
            $data = [];
            $data["title"] = "List of items";
            $data["order"] = Order::with('items.movie')->find($id);
            if (Auth::user()->getIsStaff()) {
                return view('admin.item.list', ['data' => $data]);
            } else {
                return view('item.list', ['data' => $data]);
            }
        }
        return back();
    }
}
