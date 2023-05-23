<x-app-layout>
    <x-slot name="title">
        History Detail
    </x-slot>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('History Detail') }}
        </h2>
    </x-slot>

    @php
        $total = 0;
    @endphp
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="ml-7 mt-5">
                        Invoice : {{ $transaction->invoice }}
                        <a href="{{ route('transaction.history') }}" class=" bg-green-600 hover:bg-green-500 px-4 py-2 rounded text-white">
                            See more transactions
                        </a>
                    </div>
                    <div class="mt-5">
                        <table class="w-full border-2 border-black text-center">
                            <thead class="border-2 border-black">
                                <th>Image</th>
                                <th>Name</th>
                                <th>Shop Name</th>
                                <th>Product Price</th>
                                <th>Qty</th>
                                <th>Price</th>
                            </thead>
                            <tbody>
                                @foreach ($details as $detail)
                                    <tr>
                                        <td><img src="{{ asset('storage/'.$detail->product->thumbnail) }}" class="w-24 h-24 items-center" alt="{{ Str::limit($detail->product->thumbnail, 10, '...') }}"></td>
                                        <td>{{ $detail->product->name }}</td>
                                        <td>{{ $detail->product->shop->name }}</td>
                                        <td>{{ $detail->product->price }}</td>
                                        <td>{{ $detail->quantity }}</td>
                                        <td>{{ number_format($detail->product->price*$detail->quantity,2) }}</td>
                                    </tr>
                                    @php
                                        $total += ($detail->product->price*$detail->quantity) + $transaction->courier->price
                                    @endphp
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div>
                        Courier : <b>{{ $transaction->courier->courier }}</b> <br>
                        Price   : Rp. {{ number_format($transaction->courier->price, 2) }}
                    </div>
                    <div class="text-right text-xl my-2">
                        Rp.{{ number_format($total) }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
