<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تکمیل سفارش</title>
    <!-- Include Tailwind CSS via CDN for this example -->
    <!-- In a real Laravel project, you would compile your main CSS file including Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Custom font setup for Vazir if not included in your main asset pipeline */
        @font-face {
            font-family: 'Vazirmatn'; /* Assuming Vazirmatn or similar modern Vazir font */
            src: url('path/to/your/vazirmatn.woff2') format('woff2'); /* Replace with actual path if you have local assets */
            font-weight: 400;
            font-style: normal;
        }
        body {
            font-family: 'Vazirmatn', Tahoma, sans-serif; /* Fallback to standard sans-serif */
        }
    </style>
</head>
<body class="bg-gray-50 dark:bg-gray-900 text-gray-800 dark:text-gray-100 transition-colors duration-300">

<div class="container mx-auto px-4 py-8 lg:py-12">
    <header class="text-center mb-10">
        <h1 class="text-4xl lg:text-5xl font-extrabold text-indigo-600 dark:text-indigo-400">نهایی سازی سفارش</h1>
        <p class="text-gray-500 dark:text-gray-400 mt-2">لطفاً اطلاعات خود را جهت ارسال دقیق محصول تکمیل فرمایید.</p>
    </header>

    {{-- Notification Area --}}
    @if(session('success'))
        <div id="success-alert" class="bg-green-100 border-r-4 border-green-500 text-green-700 p-4 mb-6 rounded-lg shadow-md" role="alert">
            <p class="font-bold">عملیات موفق</p>
            <p>{{ session('success') }}</p>
        </div>
    @endif

    @if(session('error'))
        <div id="error-alert" class="bg-red-100 border-r-4 border-red-500 text-red-700 p-4 mb-6 rounded-lg shadow-md" role="alert">
            <p class="font-bold">خطا در ثبت سفارش</p>
            <p>{{ session('error') }}</p>
        </div>
    @endif

    {{-- Main Form Layout: Two columns on large screens, stacked on small screens --}}
    <form action="{{ route('orders.store') }}" method="POST" class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        @csrf

        {{-- COLUMN 1 & 2: Form Inputs (Takes 2/3 width on large screens) --}}
        <div class="lg:col-span-2 space-y-6">
            
            {{-- 1. Personal & Address Information Section --}}
            <div class="section bg-white dark:bg-gray-800 p-6 lg:p-8 rounded-xl shadow-2xl border border-indigo-100 dark:border-gray-700">
                <h2 class="text-2xl font-bold mb-6 border-b pb-3 border-indigo-200 dark:border-indigo-700 text-indigo-600 dark:text-indigo-400">
                    اطلاعات دریافت کننده
                </h2>

                {{-- Two-column layout for fields on medium/large screens --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    
                    {{-- Name --}}
                    <div>
                        <label for="first_name" class="block text-sm font-medium mb-2 text-gray-700 dark:text-gray-300">نام:</label>
                        <input type="text" id="first_name" name="first_name" 
                               class="w-full p-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-indigo-500 focus:border-indigo-500 bg-gray-50 dark:bg-gray-700 dark:text-white transition duration-150" 
                               required value="{{ old('first_name') }}">
                        @error('first_name')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Last Name --}}
                    <div>
                        <label for="last_name" class="block text-sm font-medium mb-2 text-gray-700 dark:text-gray-300">نام خانوادگی:</label>
                        <input type="text" id="last_name" name="last_name" 
                               class="w-full p-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-indigo-500 focus:border-indigo-500 bg-gray-50 dark:bg-gray-700 dark:text-white transition duration-150" 
                               required value="{{ old('last_name') }}">
                        @error('last_name')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Phone --}}
                    <div>
                        <label for="phone" class="block text-sm font-medium mb-2 text-gray-700 dark:text-gray-300">شماره تماس:</label>
                        <input type="tel" id="phone" name="phone" 
                               class="w-full p-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-indigo-500 focus:border-indigo-500 bg-gray-50 dark:bg-gray-700 dark:text-white transition duration-150" 
                               required value="{{ old('phone') }}">
                        @error('phone')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Postal Code --}}
                    <div>
                        <label for="postal_code" class="block text-sm font-medium mb-2 text-gray-700 dark:text-gray-300">کد پستی:</label>
                        <input type="text" id="postal_code" name="postal_code" 
                               class="w-full p-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-indigo-500 focus:border-indigo-500 bg-gray-50 dark:bg-gray-700 dark:text-white transition duration-150" 
                               required value="{{ old('postal_code') }}">
                        @error('postal_code')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                {{-- Full Address (takes full width below the grid) --}}
                <div class="mt-6">
                    <label for="address" class="block text-sm font-medium mb-2 text-gray-700 dark:text-gray-300">آدرس کامل:</label>
                    <input type="text" id="address" name="address" 
                           class="w-full p-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-indigo-500 focus:border-indigo-500 bg-gray-50 dark:bg-gray-700 dark:text-white transition duration-150" 
                           required value="{{ old('address') }}">
                    @error('address')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

            </div>
        </div>

        {{-- COLUMN 3: Order Summary & Submission (Takes 1/3 width on large screens) --}}
        <div class="lg:col-span-1">
            <div class="section bg-white dark:bg-gray-800 p-6 rounded-xl shadow-2xl sticky top-4 border border-indigo-100 dark:border-gray-700">
                <h2 class="text-2xl font-bold mb-6 border-b pb-3 border-gray-200 dark:border-gray-700 text-gray-800 dark:text-white">
                    خلاصه سفارش
                </h2>

                {{-- Product List --}}
                <div class="space-y-4 max-h-80 overflow-y-auto pr-2 mb-6 border-b pb-4 border-gray-200 dark:border-gray-700">
                    @php $total = 0; @endphp
                    @forelse($cartItems as $item)
                        @php
                            $product = $item->product;
                            $unitPrice = $item->price;
                            $quantity = $item->quantity;
                            $itemTotal = $unitPrice * $quantity;
                            $total += $itemTotal;
                        @endphp

                        <div class="flex items-start space-x-3 rtl:space-x-reverse">
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->title }}" 
                                 class="w-16 h-16 object-cover rounded-lg flex-shrink-0 border border-gray-200 dark:border-gray-600">
                            <div class="flex-grow">
                                <p class="font-semibold text-sm truncate">{{ $product->title }}</p>
                                <p class="text-xs text-gray-500 dark:text-gray-400">تعداد: {{ $quantity }} × {{ number_format($unitPrice) }} تومان</p>
                                <p class="text-sm font-bold text-indigo-600 dark:text-indigo-400 mt-1">جمع: {{ number_format($itemTotal) }} تومان</p>
                            </div>
                        </div>
                    @empty
                        <p class="text-center text-gray-500 dark:text-gray-400 py-4">سبد خرید شما خالی است.</p>
                    @endforelse
                </div>

                {{-- Totals --}}
                <div class="space-y-3 mb-6">
                    <div class="flex justify-between items-center text-lg font-medium">
                        <span>مبلغ کل محصولات:</span>
                        <span class="font-bold text-gray-700 dark:text-gray-200">{{ number_format($total) }} تومان</span>
                    </div>

                    <div class="flex justify-between items-center pt-3 border-t border-indigo-200 dark:border-indigo-700">
                        <span class="text-xl font-extrabold text-indigo-700 dark:text-indigo-300">مبلغ نهایی قابل پرداخت:</span>
                        <span class="text-2xl font-extrabold text-red-600 dark:text-red-400">{{ number_format($total) }} تومان</span>
                    </div>
                </div>
                
                {{-- Hidden Inputs --}}
                <input type="hidden" name="total_amount" value="{{ $total }}">
                <input type="hidden" name="gateway" value="idpay">

                {{-- Submit Button --}}
                <button type="submit" 
                        class="w-full py-4 mt-4 text-lg font-bold rounded-xl 
                               bg-green-500 hover:bg-green-600 text-white 
                               shadow-lg hover:shadow-xl transition duration-300 ease-in-out 
                               transform hover:scale-[1.01] focus:outline-none focus:ring-4 focus:ring-green-300 dark:focus:ring-green-700">
                    پرداخت و ثبت نهایی سفارش
                </button>
            </div>
        </div>
    </form>
</div>

{{-- Simple JavaScript for better UX (e.g., auto-hiding alerts) --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const successAlert = document.getElementById('success-alert');
        const errorAlert = document.getElementById('error-alert');

        // Hide success alert after 7 seconds
        if (successAlert) {
            setTimeout(function() {
                successAlert.style.transition = 'opacity 0.5s';
                successAlert.style.opacity = '0';
                setTimeout(() => successAlert.style.display = 'none', 500);
            }, 7000);
        }
        
        // Hide error alert after 10 seconds
        if (errorAlert) {
            setTimeout(function() {
                errorAlert.style.transition = 'opacity 0.5s';
                errorAlert.style.opacity = '0';
                setTimeout(() => errorAlert.style.display = 'none', 500);
            }, 10000);
        }
    });
</script>

</body>
</html>
