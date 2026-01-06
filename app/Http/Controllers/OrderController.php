<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with(['items.product'])
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('orders.index', compact('orders'));
    }

    public function create()
    {
        $cartItems = Cart::with('product')->where('user_id', Auth::id())->get();
        return view('orders.create', compact('cartItems'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'postal_code' => 'required|string|max:20',
            'address' => 'required|string',
            'gateway' => 'required|in:idpay',
        ]);

        $cartItems = Cart::with('product')->where('user_id', Auth::id())->get();

        if ($cartItems->isEmpty()) {
            return redirect()->back()->with('error', 'سبد خرید شما خالی است.');
        }

        try {
            $order = DB::transaction(function () use ($request, $cartItems) {
                $total = $cartItems->sum(fn($item) => $item->quantity * $item->product->price);

                $order = Order::create([
                    'user_id' => Auth::id(),
                    'first_name' => $request->first_name,
                    'last_name' => $request->last_name,
                    'phone' => $request->phone,
                    'postal_code' => $request->postal_code,
                    'address' => $request->address,
                    'gateway' => $request->gateway,
                    'status' => 'pending',
                    'total' => $total,
                    'is_paid' => false,
                ]);

                foreach ($cartItems as $item) {
                    OrderItem::create([
                        'order_id' => $order->id,
                        'product_id' => $item->product->id,
                        'quantity' => $item->quantity,
                        'price' => $item->product->price,
                    ]);
                }

                Cart::where('user_id', Auth::id())->delete();

                return $order;
            });

            // شروع فرآیند پرداخت
            $paymentUrl = $this->startIdPayPayment($order);
            if ($paymentUrl) {
                return redirect($paymentUrl);
            } else {
                return redirect()->back()->with('error', 'خطا در اتصال به درگاه پرداخت.');
            }

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'خطا در ثبت سفارش: ' . $e->getMessage());
        }
    }

    protected function startIdPayPayment(Order $order)
    {
        $api_key = config('services.idpay.api_key');
        // اصلاح نام روت callback بر اساس تعریف روت‌ها
        $callback_url = route('payment.idpay.callback');

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, "https://api.idpay.ir/v1.1/payment");
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode([
            'order_id' => $order->id,
            'amount' => $order->total,
            'name' => $order->first_name . ' ' . $order->last_name,
            'phone' => $order->phone,
            'mail' => '',  // اگر ایمیل دارید اینجا وارد کنید
            'desc' => 'پرداخت سفارش شماره ' . $order->id,
            'callback' => $callback_url,
        ]));
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            "Content-Type: application/json",
            "X-API-KEY: {$api_key}",
            "X-SANDBOX: 1", // 0 برای حالت واقعی
        ]);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $result = curl_exec($ch);

        if (curl_errno($ch)) {
            curl_close($ch);
            return false;
        }

        curl_close($ch);

        $response = json_decode($result, true);

        if (isset($response['link'])) {
            return $response['link']; // آدرس پرداخت
        }

        return false;
    }

}
