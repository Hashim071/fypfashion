<!DOCTYPE html>
<html>
<head>
    <title>Redirecting to PayFast...</title>
</head>
<body onload="document.forms[0].submit();">
    <h2>Redirecting to PayFast...</h2>

    <form method="POST" action="{{ config('services.payfast.base_url') }}/api/Transaction/PostTransaction">
        <input type="hidden" name="CURRENCY_CODE" value="PKR" />
        <input type="hidden" name="MERCHANT_ID" value="{{ $merchantId }}" />
        <input type="hidden" name="MERCHANT_NAME" value="Custom Couture" />
        <input type="hidden" name="TOKEN" value="{{ $token }}" />
        <input type="hidden" name="TXNAMT" value="{{ $amount }}" />
        <input type="hidden" name="BASKET_ID" value="{{ $basketId }}" />
        <input type="hidden" name="ORDER_DATE" value="{{ date('Y-m-d') }}" />
        <input type="hidden" name="TXNDESC" value="Order #{{ $order->id }}" />
        <input type="hidden" name="SUCCESS_URL" value="{{ route('payment.success') }}" />
        <input type="hidden" name="FAILURE_URL" value="{{ route('payment.failure') }}" />
        <button type="submit">Redirecting...</button>
    </form>
</body>
</html>
