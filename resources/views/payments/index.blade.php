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
                            Silahkan Scan QRIS di bawah
                            <img src="{{ asset('images/sample-qr.png') }}" alt="{{ $paymentPath }}" class="img-center">
                            <a href="{{ route('product.index') }}"
                                class="bg-blue-500 hover:bg-blue-600 px-2 py-1">Back To Home
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
