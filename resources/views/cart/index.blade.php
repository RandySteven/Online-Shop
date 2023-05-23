<x-app-layout>
    <x-slot name="title">
        Cart
    </x-slot>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Cart') }}
        </h2>
    </x-slot>
    @php
        $total = 0
    @endphp
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="ml-7 mt-5">
                    <a href="{{ route('product.index') }}" class=" bg-green-600 hover:bg-green-500 px-4 py-2 rounded text-white">
                        See more products
                    </a>
                </div>
                <div class="p-6 bg-white border-b border-gray-200">
                    <table class="w-full border-2 border-black">
                        <thead class="border-2 border-black ">
                            <th>Image</th>
                            <th>Name</th>
                            <th>Product Price</th>
                            <th>Qty</th>
                            <th>Price</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            @forelse ($carts as $cart)
                            @php
                                $totalPrice = $cart->product->price * $cart->quantity;
                            @endphp
                                @if (Auth::user()->id==$cart->user->id)
                                    <tr class="text-center">
                                        <td><img src="{{ asset('storage/'.$cart->product->thumbnail) }}" class="w-24 h-24 items-center" alt=""></td>
                                        <td>{{ $cart->product->name }}</td>
                                        <td>Rp.{{ number_format($cart->product->price, 2) }}</td>
                                        <td>{{ $cart->quantity }}</td>
                                        <td>Rp.{{ number_format($totalPrice, 2) }}</td>
                                        <td>
                                            <form action="{{ route('cart.delete', $cart->product_id) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="bg-red-500 px-3 py-2 hover:bg-red-400 text-white rounded">
                                                    DELETE
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @php
                                        $total += $cart->product->price * $cart->quantity;
                                    @endphp
                                @endif
                            @empty
                                    <div class="bg-red-300 w-full text-white py-5 text-l text-center my-2">No Item(s) in Cart</div>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="float-right">
                        <label for=""> Total Price : </label>
                        <b class="text-blue-700 text-lg">
                            {{ number_format($total, 2) }}
                        </b>
                    </div>
                    <div class="my-10">
                        <form action="{{ route('transaction.store') }}" method="POST">
                            @csrf
                            <div class="mt-4">
                                <label for="">Phone</label>
                                <input type="text" name="phone_number" id="" class="w-full inline-block rounded">
                            </div>
                            <div class="mt-4">
                                <label for="courier_id">Courier</label>
                                <select name="courier_id" class="w-full inline-block rounded">
                                    @foreach ($couriers as $courier)
                                        <option value="{{ $courier->id }}">{{ $courier->courier }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mt-4">
                                <label for="payment_id">Payment Method</label>
                                <select name="payment_id" class="w-full inline-block rounded">
                                    @foreach ($payments as $payment)
                                        <option value="{{ $payment->id }}">{{ $payment->payment }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mt-4">
                                <textarea name="address" id="" class="w-full inline-block rounded" rows="10" placeholder="Address"></textarea>
                            </div>
                            <button type="submit" class="bg-blue-500 px-2 py-2 rounded hover:bg-blue-400 text-white">Check Out</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
