<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class = "mb-6">
        <div class = "flex gap-6">
            <a href="{{ route('login') }}" class = "text-orange-600">Најави Се</a>
            <a href="{{ route('register') }}">Регистрирај Се</a>
        </div>
        <hr class = "mt-3 myHr">
    </div>
    <form method="POST" action="{{ route('login') }}">
        @csrf
    
        @if($errors->get('email') && !Session::has('active'))
        <div class="bg-red-100 border-t-4 border-red-500 rounded-b text-teal-900 px-4 py-3 shadow-md mb-6" role="alert">
            <div class="flex align-center justify-center">
                <div>
                    <p class="font-bold">Внесовте погрешни информации.</p>
                </div>
            </div>
        </div>
        @endif

        <div class="relative">
            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"></path><path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"></path></svg>
            </div>
            <input type="text" id="email" type="email" name="email" :value="old('email')" class="bg-gray-50 border-gray-300 text-gray-900 text-sm rounded-lg block w-full pl-10 p-2.5 text-lg" placeholder="електронска пошта" required>
        </div>

        <div class="relative mt-3">
            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" />
                </svg>        
            </div>
            <input type="password" id="password" name="password" :value="old('password')" class="bg-gray-50 border border-gray-300 focus:outline-0 text-gray-900 rounded-lg block w-full pl-10 p-2.5 text-lg" placeholder="лозинка" required>
        </div>
        
        <div class="flex justify-between mt-4">

            <div class="flex items-center mr-4">
                <input checked id="remember_me" type="checkbox" name="remember" value="" class="w-4 h-4 text-orange-500 bg-gray-100 border-gray-300 rounded focus:ring-orange-500 dark:focus:ring-orange-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600 checkboxSize">
                <label for="remember_me" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300 text-lg">Запомни ме</label>
            </div>

            <div class="flex items-center justify-end">
                @if (Route::has('password.request'))
                    <a class="text-lg main-orange rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                        {{ __('Ја заборави лозинката?') }}
                    </a>
                @endif
            </div>
        </div>

        <div class = "flex justify-center mt-10">
            <button type="submit" class="text-white bg-main-orange focus:outline-none font-medium rounded-full text-sm px-5 py-2.5 text-center mr-2 mb-2">Најави се</button>
        </div>

    </form>

</x-guest-layout>
