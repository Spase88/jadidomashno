<x-guest-layout>
    
    <div class = "flex justify-center items-center flex-col">

        <div class = "w-24 mb-8">
            <img class="object-cover" src="./images/logo.png">
        </div>

        <h1 class = "text-3xl">E-mail верификација!</h1>

        <p class = "text-center mt-7">Проверете ја вашата електронска пошта за да ја комплетирате вашата регистрација.</p>
        <p class = "text-center mt-7">Ви благодариме!</p>
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-4 mt-4 font-medium text-sm text-green-600">
            {{ __('Испратена ви е нова пошта за верифкација!') }}
        </div>
    @endif

    <div class="mt-8 flex items-center justify-between">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf

            <div>

                <button class="bg-main-orange text-white font-bold py-2 px-8 rounded-full btnSpin" onclick="btnSpin()">
                    {{ __('Повторно испратете') }}
                </button>
            </div>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <button type="submit" class="bg-transparent main-orange font-semibold py-2 px-8 border border-gray-300 rounded-full">
                {{ __('Одјава') }}
            </button>
            
        </form>
    </div>
</x-guest-layout>
