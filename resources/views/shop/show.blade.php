<x-app-layout>
    <x-slot name="title">
        {{ $user->name }}
    </x-slot>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $user->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <img src="{{ asset('storage/'.$user->image) }}" class="w-24 h-24" alt="">
                    <h2 class="text-xl font-bold">{{ $user->name }}</h2>
                    <p>{{ $user->address }}</p>

                    @auth
                        @if (Auth::user()->id==$user->id)
                            {{-- @can('add products') --}}
                            <div class="my-5 ml-10">
                                <a href="{{ route('product.create') }}" class="bg-green-600 hover:bg-green-500 py-3 px-3 rounded-full">Add Product</a>
                            </div>
                            {{-- @endcan --}}
                        @endif
                    @endauth

                </div>

                <div class="my-10 mx-5">
                    <div class="grid grid-cols-5 mx-5">
                        @foreach ($products as $product)
                            @if ($product->shop_id==$user->id)
                                <div class="max-w-sm my-5 mx-3 rounded overflow-hidden shadow-lg hover:shadow-2xl">
                                    <img class="w-full h-32" src="{{ asset('storage/'.$product->thumbnail) }}" alt="{{ $product->thumbnail }}">
                                    <div class="px-6 py-4">
                                    <div class="font-bold text-xl mb-2">{{ $product->name }}</div>
                                    <p>
                                        <a href="{{ route('product.show', $product->slug) }}">See detail</a>
                                    </p>
                                    </div>
                                    <div class="px-6 pt-4 pb-2">
                                    <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">
                                        <a href="{{ route('category', $product->category) }}">
                                            {{ $product->category->category }}
                                        </a>
                                    </span>
                                    <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">
                                        <a href="{{ route('shop.show', $product->shop->name) }}">
                                            {{ $product->shop->name }}
                                        </a>
                                    </span>
                                    <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">{{ $product->stock }}</span>
                                    </div>
                                    @auth
                                        @if (Auth::user()->id==$user->id)
                                            <a href=""></a>
                                        @endif
                                    @endauth
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
