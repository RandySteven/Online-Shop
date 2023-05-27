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
                            @if($paymentPath == 'bcaPath')
                                Silahkan masukkan nomor dibawah ini ke aplikasi bank mobile <br>
                                VANumber : 1234567890
                            @else
                                Silahkan Scan QRIS di bawah
                                <img src="{{ asset('images/sample-qr.png') }}" alt="{{ $paymentPath }}" class="img-center">
                            @endif
                            <br>
                            <a href="{{ route('getInvoice', $transaction) }}"
                                class="bg-blue-500 hover:bg-blue-600 px-2 py-1 text-white">Transaksi Selesai
                            </a>
                            <br>
                            <div class="text-bold">Silahkan hubungi
                            <a href="https://wa.me/6282191943358?text=Saya%20sudah%20membeli%20produk%20dengan%20transaksi_id={{ $transaction->id }}"
                                class="text-blue-500 hover:text-blue-600">
                                nomor
                            </a>
                            berikut untuk mengirimkan bukti pembayaran</div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
