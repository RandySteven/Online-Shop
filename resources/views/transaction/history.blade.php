<x-app-layout>
    <x-slot name="title">
        History
    </x-slot>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('History') }}
        </h2>
    </x-slot>

    @php
        $total = 0;
    @endphp
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <table class="w-full border-2 border-black text-center">
                        <thead class="border-2 border-black">
                            <th class="border-2 border-black">Date</th>
                            <th class="border-2 border-black">Payment</th>
                            <th class="border-2 border-black">Courier</th>
                            <th class="border-2 border-black">Invoice</th>
                            <th class="border-2 border-black">Total</th>
                            <th class="border-2 border-black">See Detail</th>
                        </thead>
                        <tbody>
                            @foreach ($transactions as $transaction)
                                @php
                                    foreach ($transaction->details as $detail) {
                                        $total += ($detail->product->price * $detail->quantity) + $transaction->courier->price;
                                    }
                                @endphp
                                <tr class=" border-2 border-black">
                                    <td class=" border-2 border-black">{{ $transaction->created_at->format('d M, Y') }}</td>
                                    <td class=" border-2 border-black">{{ $transaction->payment->payment }}</td>
                                    <td class=" border-2 border-black">{{ $transaction->courier->courier }}</td>
                                    <td class=" border-2 border-black">{{ $transaction->invoice }}</td>
                                    <td class="border-2 border-black">Rp. {{ number_format($total, 2) }}</td>
                                    <td><a href="{{ route('detail.history', $transaction) }}" class="px-2 rounded bg-blue-500 hover:bg-blue-400">See Detail</a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
