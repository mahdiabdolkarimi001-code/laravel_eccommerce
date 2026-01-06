<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>سفارشات شما - نمای جدید</title>
    <!-- Include Tailwind CSS via CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        // Tailwind config باید داخل <script> باشه، نه <style>
        tailwind.config = {
            darkMode: 'class', // Enable manual dark mode switching
            theme: {
                extend: {
                    colors: {
                        'primary': '#0d9488',
                        'primary-dark': '#134e4a',
                        'surface-dark': '#1f2937',
                    },
                    boxShadow: {
                        'premium': '0 20px 25px -5px rgba(13, 148, 136, 0.2), 0 10px 10px -5px rgba(13, 148, 136, 0.08)',
                        'subtle-dark': '0 4px 6px -1px rgba(0,0,0,0.2), 0 2px 4px -2px rgba(0,0,0,0.1)',
                    },
                    animation: {
                        'pulse-slow': 'pulse 3s cubic-bezier(0.4, 0, 0.6, 1) infinite',
                    }
                }
            }
        };
    </script>
    <style>
        body {
            font-family: Tahoma, sans-serif;
        }
    </style>
</head>
<body class="bg-gray-100 dark:bg-gray-900 text-gray-800 dark:text-gray-100 transition-colors duration-500">

<div class="container mx-auto px-4 py-10 lg:py-16">
    
    <header class="text-center mb-12">
        <h1 class="text-5xl lg:text-6xl font-black text-teal-600 dark:text-teal-400">سفارشات</h1>
        <p class="text-lg text-gray-600 dark:text-gray-400 mt-2 shadow-sm">نمای جامع و سریع به خریدهای شما در فروشگاه</p>
    </header>

    {{-- Notification Area --}}
    @if(session('success'))
        <div id="success-alert" class="bg-green-500/20 border-r-8 border-green-500 text-green-200 p-4 mb-6 rounded-lg shadow-lg backdrop-blur-sm" role="alert">
            <p class="font-bold text-lg">✅ پیام موفقیت</p>
            <p>{{ session('success') }}</p>
        </div>
    @endif

    @if(session('error'))
        <div id="error-alert" class="bg-red-500/20 border-r-8 border-red-500 text-red-200 p-4 mb-6 rounded-lg shadow-lg backdrop-blur-sm" role="alert">
            <p class="font-bold text-lg">❌ خطا</p>
            <p>{{ session('error') }}</p>
        </div>
    @endif

    @if ($orders->isEmpty())
        <div class="max-w-xl mx-auto bg-white dark:bg-gray-800 p-12 rounded-2xl shadow-2xl text-center border-t-8 border-teal-500 transform hover:scale-[1.01] transition duration-300">
            <svg class="w-20 h-20 mx-auto text-teal-400 mb-6 animate-pulse-slow" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path></svg>
            <p class="text-2xl font-extrabold text-gray-800 dark:text-gray-100">صندوق سفارشات خالی است</p>
            <p class="text-gray-500 dark:text-gray-400 mt-3 text-lg">منتظر اولین ماجراجویی خرید شما هستیم. اولین سفارش را ثبت کنید!</p>
        </div>
    @else
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            @foreach ($orders as $order)
                <div class="card bg-white dark:bg-surface-dark shadow-premium rounded-xl overflow-hidden transition duration-500 hover:shadow-2xl transform hover:-translate-y-1 border-b-4 border-teal-500 dark:border-teal-600">
                    <div class="p-5 flex justify-between items-center bg-gray-50 dark:bg-gray-700/50 border-b dark:border-gray-700">
                        <span class="text-2xl font-bold text-gray-900 dark:text-gray-50">
                            سفارش #{{ $order->id }}
                        </span>
                        <span class="inline-flex items-center px-4 py-1 rounded-full text-sm font-bold tracking-wider
                            @switch($order->status)
                                @case('Pending') bg-yellow-500/20 text-yellow-300 border border-yellow-500 @break
                                @case('Processing') bg-blue-500/20 text-blue-300 border border-blue-500 @break
                                @case('Shipped') bg-indigo-500/20 text-indigo-300 border border-indigo-500 @break
                                @case('Delivered') bg-green-500/20 text-green-300 border border-green-500 @break
                                @default bg-gray-500/20 text-gray-300 border border-gray-500 @break
                            @endswitch
                        ">
                            {{ $order->status }}
                        </span>
                    </div>

                    <div class="p-6 space-y-5">
                        <div class="border-b pb-4 border-gray-200 dark:border-gray-700">
                            <h4 class="text-lg font-bold mb-3 text-teal-500 dark:text-teal-400">جزئیات دریافت</h4>
                            <div class="text-base space-y-1.5">
                                <p><strong class="font-semibold text-gray-700 dark:text-gray-300">گیرنده:</strong> {{ $order->first_name }} {{ $order->last_name }}</p>
                                <p><strong class="font-semibold text-gray-700 dark:text-gray-300">تلفن:</strong> <span class="font-mono">{{ $order->phone }}</span></p>
                                <p class="flex items-start"><strong class="font-semibold text-gray-700 dark:text-gray-300 flex-shrink-0 mr-1">آدرس:</strong> <span class="text-gray-600 dark:text-gray-400 leading-relaxed">{{ $order->address }}</span></p>
                            </div>
                        </div>

                        <div>
                            <h4 class="text-lg font-bold mb-3 text-teal-500 dark:text-teal-400">اقلام سفارش ({{ $order->items->count() }} مورد)</h4>
                            <ul class="space-y-3">
                                @foreach ($order->items as $item)
                                    <li class="flex justify-between items-center p-3 bg-gray-100 dark:bg-gray-700 rounded-lg shadow-inner">
                                        <span class="text-sm truncate flex-grow font-medium text-gray-800 dark:text-gray-200">{{ $item->product->title }}</span>
                                        <div class="text-right flex-shrink-0 ml-3">
                                            <span class="block text-xs text-gray-500 dark:text-gray-400">{{ $item->quantity }} ×</span>
                                            <span class="block text-base font-extrabold text-primary">{{ number_format($item->price) }} ت</span>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        
                        <div class="pt-5 border-t-2 border-teal-300 dark:border-teal-700 flex justify-between items-center mt-4 bg-gray-50 dark:bg-gray-800 p-4 rounded-lg shadow-md">
                            <span class="text-xl font-extrabold text-gray-800 dark:text-gray-200">جمع نهایی:</span>
                            <span class="text-3xl font-black text-red-500 dark:text-red-400">
                                {{ number_format($order->total) }} <span class="text-lg font-medium ml-1">تومان</span>
                            </span>
                        </div>
                        
                        <div class="text-sm text-gray-500 dark:text-gray-500 pt-2 border-t dark:border-gray-700 text-center">
                            روش پرداخت: <span class="font-bold text-teal-500">{{ strtoupper($order->gateway) }}</span>
                        </div>

                    </div>
                </div>
            @endforeach
        </div>
    @endif

</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const successAlert = document.getElementById('success-alert');
        const errorAlert = document.getElementById('error-alert');

        function hideAlert(alertElement) {
            if (alertElement) {
                setTimeout(function() {
                    alertElement.style.transition = 'opacity 0.7s, transform 0.7s';
                    alertElement.style.opacity = '0';
                    alertElement.style.transform = 'translateX(50px)';
                    setTimeout(() => {
                        alertElement.style.display = 'none';
                    }, 700); 
                }, 8000);
            }
        }
        
        hideAlert(successAlert);
        hideAlert(errorAlert);
    });
</script>

</body>
</html>
