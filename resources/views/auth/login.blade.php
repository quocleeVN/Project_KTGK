<x-guest-layout>
    <div class="flex justify-center mb-6">
        <a href="/">
      
            <img src="{{ asset('images/logo-qnhu.jpg') }}" alt="Logo" style="width: 150px; height: auto;">
        </a>
    </div>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div>
            <x-input-label for="email" value="Địa chỉ Email" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
        </div>

        <div class="mt-4">
            <x-input-label for="password" value="Mật khẩu" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required />
        </div>

        <div class="block mt-4">
            <label class="inline-flex items-center">
                <input type="checkbox" name="remember" class="rounded border-gray-300 text-indigo-600">
                <span class="ms-2 text-sm text-gray-600">Ghi nhớ đăng nhập</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="ms-3">
                Đăng nhập
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>