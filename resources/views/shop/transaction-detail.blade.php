<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    @php
        $total = 0;
    @endphp
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="ml-7 my-5">
                        <div class="my-6 mx-5">
                            Invoice : {{ $transaction->invoice }}
                        </div>
                        <div class="my-6 mx-5">
                            Date : {{ $transaction->created_at }}
                        </div>
                        <div class="my-6 mx-5">
                            Address : {{ $transaction->address }}
                        </div>
                        @if ($transaction->status != 'Lunas')
                            <form action="{{ route('update.lunas', $transaction) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="my-5 px-5 bg-blue-500 hover:bg-blue-600 text-white">Lunas</button>
                            </form>
                        @endif
                        <a href="{{ route('shop.transaction') }}" class=" bg-green-600 hover:bg-green-500 px-4 py-2 rounded text-white">
                            See more transactions
                        </a>
                    </div>
                    <div>
                        <table class="w-full border-2 border-black text-center">
                            <thead class="w-full border-2 border-black">
                                <th>Product Image</th>
                                <th>Product Name</th>
                                <th>Product Price</th>
                                <th>Quantity</th>
                                <th>Price</th>
                            </thead>
                            <tbody>
                                @foreach ($details as $detail)
                                @php
                                    $total += $detail->product->price * $detail->quantity;
                                @endphp
                                    <tr class="w-full border-2 border-black">
                                        <td><img src="{{ asset('storage/'.$detail->product->thumbnail) }}" class="w-24 h-24 items-center ml-2" alt=""></td>
                                        <td>{{ $detail->product->name }}</td>
                                        <td>Rp.{{ number_format($detail->product->price,2) }}</td>
                                        <td>{{ $detail->quantity }}</td>
                                        <td>Rp.{{ number_format($detail->product->price * $detail->quantity) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div>
                            Courier : {{ $transaction->courier->courier }} <br>
                            Total Price : {{ number_format($total) }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
