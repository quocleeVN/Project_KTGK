<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderConfirmation;

class TreeController_VA extends Controller
{
    public function detail($id)
    {
        $caycanh = DB::table('san_pham')
            ->where('id', $id)
            ->first();

        if (!$caycanh) {
            abort(404);
        }

        return view('caycanh.detail', compact('caycanh'));
    }

    public function addToCart(Request $request)
    {
        $id = $request->id;
        $name = $request->name;
        $price = $request->price;
        $qty = max(1, (int)$request->qty);

        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['qty'] += $qty;
        } else {
            $cart[$id] = [
                'name' => $name,
                'price' => $price,
                'qty' => $qty
            ];
        }

        session()->put('cart', $cart);

        return redirect()->back();
    }

    public function cart()
    {
        $cart = session()->get('cart', []);
        return view('caycanh.cart', compact('cart'));
    }

    public function remove($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
        }

        session()->put('cart', $cart);

        return redirect()->back();
    }

    public function checkout()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->back()->with('error', 'Giỏ hàng trống!');
        }

        $user = Auth::user();
        $total = 0;
        foreach ($cart as $item) {
            $total += ($item['price'] * $item['qty']);
        }

        try {
            Mail::to($user->email)->send(new OrderConfirmation($user, $cart, $total));
        } catch (\Exception $e) {
            Log::error('Order email failed', [
                'message' => $e->getMessage(),
                'user_id' => $user->id,
                'email' => $user->email,
                'cart' => $cart,
            ]);

            return redirect()->route('giohang')->with('error', 'Gửi email đơn hàng thất bại. Vui lòng kiểm tra cấu hình mail và xem log.');
        }

        session()->forget('cart');

        return redirect()->route('giohang')->with('success', 'Đặt hàng thành công! Email xác nhận đã được gửi.');
    }
}
