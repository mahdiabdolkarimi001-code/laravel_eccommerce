<form action="{{ route('payment.start', $order->id) }}" method="GET">
    <div class="form-group">
        <label for="payment_gateway">درگاه پرداخت</label>
        <select name="payment_gateway" id="payment_gateway" class="form-control">
            <option value="zarinpal">زرین‌پال</option>
            <!-- اگر درگاه‌های دیگه اضافه کنی اینجا میتونی انتخاب کنی -->
        </select>
    </div>

    <button type="submit" class="btn btn-primary">پرداخت</button>
</form>
