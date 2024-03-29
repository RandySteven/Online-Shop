<x-app-layout>
    <div class="w-full px-5 bg-white">
        <form action="{{ route('search.product') }}" method="GET">
            @csrf
            <input type="text" name="name" id="" class="w-4/5">
            <button type="submit" class="bg-blue-500 w-1/6 hover:bg-blue-400 rounded text-white px-4 py-2">Search</button>
        </form>
    </div>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('All Products and Categories') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="text-center text-3xl">
                        Categories
                    </div>
                    <div class="grid xl:grid-cols-5 sm:grid-cols-2 mx-5 my-5">
                        @foreach ($categories as $category)
                            <a href="{{ route('category', $category) }}">
                                <div class="max-w-sm my-5 text-center py-12 mx-3 rounded overflow-hidden shadow-lg hover:shadow-2xl">
                                    {{ $category->category }}
                                </div>
                            </a>
                        @endforeach
                    </div>

                    <div class="text-center text-3xl">
                        Products
                    </div>
                    <div class="grid xl:grid-cols-5 sm:grid-cols-1 mx-5 my-5">
                        @foreach ($products as $product)
                            <div class="max-w-sm my-5 text-center py-12 mx-3 rounded overflow-hidden shadow-lg hover:shadow-2xl">
                                <img class="w-full h-32" src="{{ asset('storage/'.$product->thumbnail) }}" alt="{{ $product->thumbnail }}">
                                <div class="px-6 py-4">
                                <div class="font-bold text-xl mb-2">{{ $product->name }}</div>
                                <p class="text-gray-700 text-base">
                                    {{ Str::limit($product->desc, 50, '...') }}
                                    <a href="{{ route('product.show', $product->slug) }}" class="text-blue-500 hover:text-blue-400">Read More</a>
                                </p>
                                </div>
                                <div class="px-6 pt-4 pb-2">
                                <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">
                                    <a href="{{ route('category', $product->category->slug) }}">
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
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
