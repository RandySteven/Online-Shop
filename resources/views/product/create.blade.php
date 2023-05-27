<x-app-layout>
    <x-slot name="title">
        Create
    </x-slot>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Product') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if (Auth::user()->hasRole('admin'))
                    <form action="{{ route('product.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="mt-4">
                            <x-label for="name" :value="__('Name')" />
                            <x-input id="name" class="block mt-1 w-full" placeholder="Product name must between 8-50" type="text" name="name" :value="old('name')"  autofocus />
                        </div>
                            @error('name')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        <div class="mt-4">
                            <x-label for="price" :value="__('Price')" />
                            <x-input id="price" class="block mt-1 w-full" type="number" placeholder="Product price" name="price" :value="old('price')"  autofocus />
                        </div>
                        @error('price')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror

                        <div class="mt-4">
                            <x-label for="stock" :value="__('Stock')" />
                            <x-input id="stock" class="block mt-1 w-full " type="number" name="stock" placeholder="Product stock" :value="old('stock')"  autofocus />
                        </div>
                        @error('stock')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror

                        <div class="mt-4">
                            <x-label for="thumbnail" :value="__('Thumbnail')" />
                            <x-input id="thumbnail" class="block mt-1 w-full" type="file" name="thumbnail" :value="old('thumbnail')"  autofocus />
                        </div>
                        @error('thumbnail')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror

                        <div class="mt-4">
                            <x-label for="desc" :value="__('Product Description')" />
                            <textarea name="desc" id="desc" class="block mt-1 w-full" rows="10" placeholder="Product max 5000 characters"></textarea>
                        </div>
                        @error('desc')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror

                        <div class="mt-4">
                            <x-label for="category_id" :value="__('Product Category')" />
                            <select name="category_id" id="category_id" class="block mt-1 w-full">
                                <option selected disabled>Choose one</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->category }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mt-4">
                            <x-button>
                                {{ __('Add Product') }}
                            </x-button>
                        </div>
                    </form>
                    @else
                        Hanya admin yang bisa menambahkan proudct
                    @endif

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
