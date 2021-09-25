<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Item;
use App\Models\Movie;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function add(Request $request)
    {
        if (Auth::check()) {
            $movie = Movie::find($request->input('movie_id'));

            $rent = false;
            $itemTotalIndex = 1;
            if ($request->input('rent') == 'on') {
                $rent = true;
                $itemTotalIndex = 0.2;
            }

            if ($rent) {
                if ($movie->getRentQuantity() < $request->input('quantity')) {
                    return back();
                }
            } else {
                if ($movie->getSellQuantity() < $request->input('quantity')) {
                    return back();
                }
            }

            $products = $request->session()->get("products");
            $products[$movie->getId()] = array(
                'quantity' => $request->input('quantity'),
                'rent' => $rent,
                'itemTotal' => $movie->getPrice() * $itemTotalIndex * $request->input('quantity'),
            );
            $request->session()->put('products', $products);
        }
        return back();
        return redirect()->route('home.index');
    }

    public function show(Request $request)
    {
        if (Auth::check()) {
            $data = [];
            $data["title"] = "Your Cart";

            $products = $request->session()->get("products");
            if ($products) {
                $data["movies"] = Movie::find(array_keys($products));
                $data["empty"] = false;
            } else {
                $data["empty"] = true;
                return view('cart.show', ['data' => $data]);
            }
            $data["products"] = $products;

            $subtotal = 0;
            foreach ($products as $product) {
                $subtotal += $product['itemTotal'];
            }
            $data["subtotal"] = $subtotal;

            return view('cart.show', ['data' => $data]);
        }
        return redirect()->route('home.index');
    }

    public function empty(Request $request)
    {
        if (Auth::check()) {
            $request->session()->forget('products');
            return back();
        }
        return redirect()->route('home.index');
    }

    public function checkout(Request $request)
    {
        if (Auth::check()) {
            Order::validate($request);
            $products = $request->session()->get("products");
            if ($products) {
                $user = Auth::user();
                $total = 0;
                $order = new Order();
                $order->setAddress($request->input('address'));
                $order->setDate(Carbon::now());
                $order->setPaymentType($request->input('payment_type'));
                $order->setShippingDate(Carbon::now()->addDay(2));
                $order->setUserId($user->getId());
                $order->setTotal($total);
                $order->save();
                foreach ($products as $key => $product) {
                    $movie = Movie::find($key);
                    $item = new Item();
                    $item->setOrderId($order->getId());
                    $item->setMovieId($movie->getId());
                    $item->setIsRented($product['rent']);
                    $item->setReturnDate(Carbon::now()->addWeek());
                    $item->setQuantity($product['quantity']);
                    $item->setSubtotal($product['itemTotal']);
                    $total += $product['itemTotal'];
                    $item->save();
                }
                $order->setTotal($total);
                $order->save();
                $request->session()->forget('products');
                return redirect()->route("home.index");
            } else {
                return back();
            }
        }
        return redirect()->route('home.index');
    }
}
