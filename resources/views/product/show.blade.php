<x-app-layout>
    <x-slot name="title">
        {{ $product->name }}
    </x-slot>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $product->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="grid xl:grid-cols-2 sm:grid-cols-1">
                        <div class="mr-2">
                            <img src="{{ asset('storage/'.$product->thumbnail) }}" alt="">
                            <div class="my-5">
                                @auth
                                    <form action="{{ route('cart.store') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                        <input type="text" name="quantity">
                                        <button type="submit" class="rounded text-white bg-green-600 hover:bg-green-500 px-5 py-2">Add to Cart</button>
                                    </form>
                                    <div class="mt-5">
                                        @if (Auth::user()->id==$product->shop->id)
                                            <a href="{{ route('product.edit', $product->slug) }}" class="rounded text-white bg-green-600 hover:bg-green-500 px-5 py-2">Edit</a>
                                            <div class="mt-5">
                                                <form action="{{ route('product.delete',$product) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="bg-red-400 hover:bg-red-300 px-5 py-2 rounded">Delete</button>
                                                </form>
                                            </div>
                                        @endif
                                    </div>
                                @endauth
                            </div>
                        </div>
                        <div>
                            <table class="border-2 border-black w-full">
                                <tr class="border border-black">
                                    <td class="border-r-2 border-black">
                                        Name
                                    </td>
                                    <td class="border-r-2 border-black">
                                        <h2 class="text-xl font-bold">{{ $product->name }}</h2>
                                    </td>
                                </tr>
                                <tr class="border border-black">
                                    <td class="border-r-2 border-black">
                                        Price
                                    </td>
                                    <td>
                                        <h2 class="text-xl font-bold">Rp.{{ number_format($product->price, 2) }},00</h2>
                                    </td>
                                </tr>
                                <tr class="border border-black">
                                    <td class="border-r-2 border-black">
                                        Stock
                                    </td>
                                    <td>
                                        <h2 class="text-xl font-bold">{{ $product->stock }}</h2>
                                    </td>
                                </tr>
                                <tr class="border border-black">
                                    <td class="border-r-2 border-black">
                                        Category
                                    </td>
                                    <td>
                                        <h2 class="text-xl font-bold">
                                            <a href="{{ route('category', $product->category->slug) }}"
                                                class="px-2 bg-yellow-400 hover:bg-yellow-300 rounded">
                                                {{ $product->category->category }}
                                            </a>
                                        </h2>
                                    </td>
                                </tr>
                                <tr class="border border-black">
                                    <td class="border-r-2 border-black">
                                        Shop
                                    </td>
                                    <td>
                                        <h2 class="text-xl font-bold">
                                            <a href="{{ route('shop.show', $product->shop->name) }}"
                                                class="px-2 bg-green-600 hover:bg-green-500 rounded text-white">
                                                {{ $product->shop->name }}
                                            </a>
                                        </h2>
                                    </td>
                                </tr>
                            </table>
                            <p>
                                {!! nl2br($product->desc) !!}
                            </p>
                        </div>

                    </div>
                    <div>
                        @auth
                        <form action="{{ route('comment.store') }}" method="POST">
                            @csrf
                            <div class="flex">
                                <img src="{{ Auth::user()->image != null ? asset('storage/'.Auth::user()->image) : Auth::user()->gravatar() }}" class="rounded-full w-5 h-5 mr-2 mb-1" alt="">
                                <x-label>{{ Auth::user()->name }}</x-label>
                            </div>
                            <x-input type="hidden" name="product_id" value="{{ $product->id }}" />
                            <textarea name="comment" id="" class="w-full" rows="5"></textarea>
                            <button type="submit">Submit</button>
                        </form>
                        @endauth
                    </div>
                    <div>
                        @include('product.comment.comment', ['comments'=>$product->comments, 'product_id'=>$product->id])
                    </div>

                    <div class="grid xl:grid-cols-3 sm:grid-cols-1 mx-5">
                        @foreach ($products as $product)
                        <div class="max-w-sm rounded my-6 mx-2 overflow-hidden shadow-lg hover:shadow-xl ">
                            <img class="w-full h-32" src="{{ asset('storage/'.$product->thumbnail) }}" alt="{{ $product->thumbnail }}">
                            <div class="px-6 py-4">
                            <div class="font-bold text-xl mb-2">{{ $product->name }}</div>
                            <p class="text-gray-700 text-base">
                                {{ Str::limit($product->desc, 50, '...') }}
                                <a href="{{ route('product.show', $product->slug) }}">Read More</a>
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
