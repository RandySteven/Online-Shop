@component('mail::message')
# Introduction

The body of your message.

@component('mail::button', ['url' => ''])
<div class="my-2">
    Transaction Date : {{ $transaction->created_at->format('d M, Y') }}
</div>
<h3>{{ $transaction->invoice }}</h3>
<div class="my-2">
    @php
        $total = 0;
    @endphp
    <table class="w-full border-2 border-black">
        <thead class="border-2 border-black ">
            <th>Image</th>
            <th>Name</th>
            <th>Product Price</th>
            <th>Qty</th>
            <th>Price</th>
        </thead>
        <tbody>
            @foreach ($carts as $cart)
            <tr>
                <td><img src="{{ asset('storage/'.$cart->product->thumbnail) }}" alt=""></td>
                <td>{{ $cart->product->name }}</td>
                <td>Rp. {{ number_format($cart->product->price) }}</td>
                <td>{{ $cart->quantity }}</td>
                <td>Rp. {{ number_format($cart->product->price * $cart->quantity) }}</td>
            </tr>
            @php
                $total += $cart->product->price * $cart->quantity;
            @endphp
            @endforeach
        </tbody>
    </table>
    <div>
        Rp.{{ number_format($total) }}
    </div>
</div>
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
