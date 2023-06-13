<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <table class="w-full border-2 border-black text-center">
                        <thead class="w-full border-2 border-black">
                            <th>Transaction Date</th>
                            <th>Courier</th>
                            <th>Payment</th>
                            <th>Invoice</th>
                            <th>Phone</th>
                            <th>Status</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            @foreach ($transactions as $transaction)
                                <tr class="w-full border-2 border-black">
                                    <td>{{ $transaction->created_at->diffForHumans() }}</td>
                                    <td>{{ $transaction->courier->courier }}</td>
                                    <td>{{ $transaction->payment->payment }}</td>
                                    @php
                                        $link = '';
                                        if($transaction->courier->id == 1){
                                            $link = 'https://www.jne.co.id/id/beranda';
                                        }else if($transaction->courier->id == 2){
                                            $link = 'https://www.tiki.id/id/beranda';
                                        }else if($transaction->courier->id == 3){
                                            $link = 'https://www.jet.co.id';
                                        }
                                    @endphp
                                    <td><a href="{{ $link }}" class="text-blue-500">{{ $transaction->invoice }}</a></td>
                                    <td>{{ $transaction->phone_number }}</td>
                                    <td>{{ $transaction->status }}</td>
                                    <td>
                                        <div class="flex">
                                            <a href="{{ route('shop.detail.transaction', $transaction) }}" class="bg-blue-500 hover:bg-blue-400 px-2 py-1">See Detail</a>
                                            <form action="{{ route('transaction.delete', $transaction) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="bg-red-500 ml-2 hover:bg-red-400 px-2 py-1">Delete</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
