<x-app-layout>
    <x-slot name="title">
        Shop
    </x-slot>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Shop') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="my-10 mx-5">
                        <div class="my-5">
                        </div>
                        <div class="my-5">
                        </div>
                        <div class="scrolling-pagination">
                            <div class="grid xl:grid-cols-5 sm:grid-cols-1 mx-5 my-5">
                            @forelse ($shops as $shop)
                                <div class="max-w-sm rounded my-6 mx-2 overflow-hidden shadow-lg hover:shadow-xl ">
                                    <img class="w-full h-32" src="{{ asset('storage/'.$shop->thumbnail) }}" alt="{{ $product->thumbnail }}">
                                    <div class="px-6 py-4">
                                    <div class="font-bold text-xl mb-2">{{ $shop->name }}</div>
                                    <p class="text-gray-700 text-base">
                                        {{ Str::limit($shop->address, 50, '...') }}
                                    </p>
                                    </div>
                                    <div class="px-6 pt-4 pb-2">
                                    <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">
                                       {{ $shop->products()->count() }}
                                    </span>
                                    </div>
                                </div>
                            @empty
                                <div class="text-center">
                                    No Shop
                                </div>
                            @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
