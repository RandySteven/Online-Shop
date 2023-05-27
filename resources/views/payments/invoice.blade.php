<x-app-layout>
    <x-slot name="title">
        Payment
    </x-slot>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Payments') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="my-10 mx-5">
                        <div class="text-center text-xl">
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
                            Nomor Resi :
                            <a href="{{ $link }}" target="_blank" class="text-blue-400 hover:text-blue-500">
                                {{ $invoice }}
                            </a>
                            <br>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
