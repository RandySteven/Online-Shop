<x-app-layout>
    <x-slot name="title">
        Edit
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
                    <ul>
                        @foreach ($errors->all() as $error)
                            <div class="bg-red-200 py-2 px-2">
                                <li class="text-red-800">
                                    {{ $error }}
                                </li>
                            </div>
                        @endforeach
                        </ul>
                    <form action="{{ route('product.update', $product) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <div class="mt-4">
                            <x-label for="name" :value="__('Name')" />

                            <input id="name" class="block mt-1 w-full" value="{{ $product->name }}" placeholder="Product name must between 8-50" type="text" name="name" required autofocus
                                {{ Auth::user()->hasRole('gudang') ? 'readonly' : '' }}
                                />
                        </div>

                        <div class="mt-4">
                            <x-label for="price" :value="__('Price')" />
                            <input id="price" class="block mt-1 w-full" type="number" value="{{ $product->price }}" placeholder="Product price" name="price"  required autofocus
                                {{ Auth::user()->hasRole('gudang') ? 'readonly' : '' }}/>
                        </div>

                        <div class="mt-4">
                            <x-label for="stock" :value="__('Stock')" />
                            <input id="stock" class="block mt-1 w-full " type="number" name="stock" value="{{ $product->stock }}" placeholder="Product stock" required autofocus />
                        </div>

                        <div class="mt-4">
                            <x-label for="thumbnail" :value="__('Thumbnail')" />
                            <input id="thumbnail" class="block mt-1 w-full" type="file" name="thumbnail" :value="old('thumbnail')" autofocus
                            {{ Auth::user()->hasRole('gudang') ? 'readonly' : '' }}/>
                        </div>

                        <div class="mt-4">
                            <x-label for="desc" :value="__('Product Description')" />
                            <textarea name="desc" id="desc" class="block mt-1 w-full" rows="10" placeholder="Product max 5000 characters"
                                {{ Auth::user()->hasRole('gudang') ? 'readonly' : '' }}>
                                {{ $product->desc }}
                            </textarea>
                        </div>

                        <div class="mt-4">
                            <x-label for="category_id" :value="__('Product Category')" />
                            <select name="category_id" id="category_id" class="block mt-1 w-full">
                                <option selected disabled>Choose one</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" {{ $product->category->id==$category->id ? 'selected' : '' }} {{ Auth::user()->hasRole('gudang') ? 'disabled' : '' }}>
                                        {{ $category->category }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mt-4">
                            <x-button>
                                {{ __('Edit Product') }}
                            </x-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
