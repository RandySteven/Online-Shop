<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('store.shop') }}" enctype="multipart/form-data">
            @csrf
            <!-- Phone -->
            <div class="mt-4">
                <x-label for="phone" :value="__('Phone')" />

                <x-input id="phone" class="block mt-1 w-full" type="text" name="phone_number" :value="old('phone')" required autofocus />
            </div>

            <div class="mt-4">
                <x-label for="image" :value="__('Image')" />

                <x-input id="image" class="block mt-1 w-full" type="file" name="image" :value="old('image')" required autofocus />
            </div>

            <div class="mt-4">
                <x-label for="address" :value="__('Address')" />

                <textarea name="address" class="block mt-1 w-full" rows="10"></textarea>
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-button class="ml-4">
                    {{ __('Register Shop') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
