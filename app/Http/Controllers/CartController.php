<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Movie;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function add(Request $request)
    {
        if (Auth::check()) {
            $movie = Movie::find($request->input('movie_id'));
            $products = $request->session()->get("products");
            if ($products && array_key_exists($movie->getId(), $products)) {
                $message = 'cart_item_exist';
            } else {
                $rent = false;
                $itemTotalIndex = 1;
                if ($request->input('rent') == 'on') {
                    $rent = true;
                    $itemTotalIndex = 0.2;
                }

                if ($rent) {
                    if ($movie->getRentQuantity() < $request->input('quantity')) {
                        $message = 'cart_item_quantity_error';
                        return back()->with('message', $message);
                    }
                } else {
                    if ($movie->getSellQuantity() < $request->input('quantity')) {
                        $message = 'cart_item_quantity_error';
                        return back()->with('message', $message);
                    }
                }

                $products[$movie->getId()] = array(
                    'quantity' => $request->input('quantity'),
                    'rent' => $rent,
                    'itemTotal' => $movie->getPrice() * $itemTotalIndex * $request->input('quantity'),
                );
                $request->session()->put('products', $products);
                $message = 'cart_item_added';
            }
        }
        return back()->with('message', $message);
    }

    public function show(Request $request)
    {
        if (Auth::check()) {
            $data = [];
            $data["title"] = "Your Cart";

            $products = $request->session()->get("products");
            if ($products) {
                $movies = Movie::find(array_keys($products));
                $data["empty"] = false;
            } else {
                $data["empty"] = true;
                return view('cart.show', ['data' => $data]);
            }
            $data["products"] = $products;

            foreach ($movies as $key => $movie) {
                if ($products[$movie->getId()]['rent']) {
                    if ($products[$movie->getId()]['quantity'] > $movie->getRentQuantity()) {
                        unset($movies[$key]);
                        unset($products[$movie->getId()]);
                    }
                } else {
                    if ($products[$movie->getId()]['quantity'] > $movie->getSellQuantity()) {
                        unset($movies[$key]);
                        unset($products[$movie->getId()]);
                    }
                }
            }

            session()->put('products', $products);
            if (! $products) {
                $data["empty"] = true;
                return view('cart.show', ['data' => $data]);
            }

            $data["movies"] = $movies;
            $subtotal = 0;
            foreach ($products as $product) {
                $subtotal += $product['itemTotal'];
            }
            $data["subtotal"] = $subtotal;

            return view('cart.show', ['data' => $data]);
        }
        return back();
    }

    public function empty(Request $request)
    {
        if (Auth::check()) {
            $request->session()->forget('products');
            return back();
        }
        return back();
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
                    if ($product['rent']) {
                        $movie->setRentQuantity($movie->getRentQuantity() - $product['quantity']);
                    } else {
                        $movie->setSellQuantity($movie->getSellQuantity() - $product['quantity']);
                    }
                    $item->setReturnDate(Carbon::now()->addWeek());
                    $item->setQuantity($product['quantity']);
                    $item->setSubtotal($product['itemTotal']);
                    $total += $product['itemTotal'];
                    $movie->save();
                    $item->save();
                }
                $order->setTotal($total);
                $order->save();
                $request->session()->forget('products');
                return redirect()->route('order.show', ['id' => $order->getId()]);
            }
        }
        return back();
    }
}
