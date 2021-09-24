<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Movie;
use App\Models\Order;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function create(Request $request)
    {
        $products = $request->session()->get("products");
        $order = new Order();
        foreach ($products as $product) {
            $movie = Movie::find($product['movie_id']);
            $item = new Item();
            $item->setOrderId($order->getId());
            $item->setMovieId($movie->getId());
            $item->setIsRented($product['is_rented']);
            $item->setReturnDate($product['return_date']);
            $item->setQuantity($product['quantity']);
            $item->setSubtotal($product['quantity'] * $movie->getPrice());
            $item->save();
        }
    }
}
