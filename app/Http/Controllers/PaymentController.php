<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    public function start(Order $order)
    {
        if ($order->status !== 'pending') {
            return redirect()->route('orders.index')->with('error', 'این سفارش قابل پرداخت نیست.');
        }

        try {
            $callbackUrl = config('payment.idpay_callback_url');
            $response = Http::withHeaders([
                'X-API-KEY' => config('payment.idpay_api_key'),
                'X-SANDBOX' => config('payment.idpay_sandbox') ? '1' : '0',
            ])->post(config('payment.idpay_endpoint'), [
                'order_id' => $order->id,
                'amount' => $order->total,
                'name' => $order->first_name . ' ' . $order->last_name,
                'phone' => $order->phone,
                'mail' => $order->email ?? '',
                'desc' => 'پرداخت سفارش شماره ' . $order->id,
                'callback' => $callbackUrl,
            ]);

            if ($response->successful()) {
                $data = $response->json();
                if ($data['status'] == 1 && !empty($data['link'])) {
                    return redirect($data['link']);
                }
                return redirect()->route('orders.index')->with('error', 'خطا در ایجاد پرداخت: ' . ($data['error_message'] ?? 'نامشخص'));
            }

            return redirect()->route('orders.index')->with('error', 'خطا در ارتباط با درگاه پرداخت.');
        } catch (\Exception $e) {
            Log::error('Payment start error: ' . $e->getMessage());
            return redirect()->route('orders.index')->with('error', 'خطا در پردازش درخواست پرداخت.');
        }
    }

    public function callback(Request $request)
    {
        $token = $request->input('token');
        $orderId = $request->input('order_id');
        $status = $request->input('status');

        if (!$token || !$orderId) {
            return redirect()->route('orders.index')->with('error', 'پارامترهای ارسالی ناقص است.');
        }

        $order = Order::find($orderId);

        if (!$order) {
            return redirect()->route('orders.index')->with('error', 'سفارش یافت نشد.');
        }

        if ($status != 10) { // 10 = پرداخت موفق اولیه
            return redirect()->route('orders.index')->with('error', 'پرداخت ناموفق بود.');
        }

        try {
            $response = Http::withHeaders([
                'X-API-KEY' => config('payment.idpay_api_key'),
                'X-SANDBOX' => config('payment.idpay_sandbox') ? '1' : '0',
            ])->post(config('payment.idpay_endpoint') . '/verify', [
                'id' => $token,
                'order_id' => $orderId,
            ]);

            if ($response->successful()) {
                $data = $response->json();
                if ($data['status'] == 100) { // 100 = پرداخت تایید شده
                    $order->update([
                        'status' => 'paid',
                        'gateway' => 'idpay',
                    ]);

                    return redirect()->route('orders.index')->with('success', 'پرداخت با موفقیت انجام شد.');
                }

                return redirect()->route('orders.index')->with('error', 'پرداخت تایید نشد: ' . ($data['error_message'] ?? 'نامشخص'));
            }

            return redirect()->route('orders.index')->with('error', 'خطا در تایید پرداخت.');
        } catch (\Exception $e) {
            Log::error('Payment callback error: ' . $e->getMessage());
            return redirect()->route('orders.index')->with('error', 'خطا در پردازش تایید پرداخت.');
        }
    }
}
