<form wire:submit.prevent="register">
    @csrf

    @if($currentStep == 1)
    <div class="relative">
        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
            </svg>

        </div>
        <input type="text" id="name" name="name" value="{{old('name')}}" required autofocus autocomplete="name" class="bg-gray-50 border-gray-300 text-gray-900 text-sm rounded-lg block w-full pl-10 p-2.5 text-lg" placeholder="Име" wire:model = "name">
    </div>
    
    <span class = "text-red-600">@error('name'){{ $message }}@enderror</span>

    <div class="relative mt-8">
        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
            </svg>
        </div>
        <input type="text" id="lastname" name="lastname" value="{{old('lastname')}}" required autofocus autocomplete="lastname" class="bg-gray-50 border-gray-300 text-gray-900 text-sm rounded-lg block w-full pl-10 p-2.5 text-lg" placeholder="Презиме" wire:model = "lastname">
    </div>
    <span class = "text-red-600">@error('lastname'){{ $message }}@enderror</span>


    <div class="relative mt-8">
        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
            <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"></path><path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"></path></svg>
        </div>
        <input id="email" type="email" name="email" value="{{old('email')}}" class="bg-gray-50 border-gray-300 text-gray-900 text-sm rounded-lg block w-full pl-10 p-2.5 text-lg" placeholder="електронска пошта" required wire:model = "email">
    </div>
    <span class = "text-red-600">@error('email'){{ $message }}@enderror</span>


    <div class="relative mt-8">
        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 1.5H8.25A2.25 2.25 0 006 3.75v16.5a2.25 2.25 0 002.25 2.25h7.5A2.25 2.25 0 0018 20.25V3.75a2.25 2.25 0 00-2.25-2.25H13.5m-3 0V3h3V1.5m-3 0h3m-3 18.75h3" />
            </svg>
        </div>
        <input id="mobile" type="tel" name="mobile" value="{{old('mobile')}}" class="bg-gray-50 border-gray-300 text-gray-900 text-sm rounded-lg block w-full pl-10 p-2.5 text-lg" placeholder="телефонски број" required wire:model = "mobile" oninput="enforcePhoneNumberFormat(this)" onkeyup="addHyphen(this)" maxlength="11">
    </div>
    <span class = "text-red-600">@error('mobile'){{ $message }}@enderror</span>


    <div class="relative mt-8">
        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" />
            </svg> 
        </div>
        <input id="password" type="password" name="password" value="{{old('password')}}" class="bg-gray-50 border-gray-300 text-gray-900 text-sm rounded-lg block w-full pl-10 p-2.5 text-lg" placeholder="лозинка за профилот" required wire:model = "password">
    </div>
    <span class = "text-red-600">@error('password'){{ $message }}@enderror</span>
    @endif


    @if($currentStep == 2)

    <div class = "flex justify-center">
        <div class = "w-44 h-44">
            <img onclick = "openDialog()" id = "imageUpload" src="./images/add-image-icon.png" alt="add-image-logo" class = "object-cover imageHover">
        </div>
    </div>

    
    

    <input id="profile_image" name = "profile_image" type="file" wire:model = "profile_image" onchange="fileValidation(profile_image)" hidden/>
    <div wire:loading wire:target="profile_image">
        <div class = "flex justify-center">
            <span class = "m-auto">Се прикачува...</span>
            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" style="margin: auto; background: none; display: block; shape-rendering: auto;" width="50px" height="50px" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid">
                <circle cx="50" cy="50" r="32" stroke-width="8" stroke="#4169ff" stroke-dasharray="50.26548245743669 50.26548245743669" fill="none" stroke-linecap="round">
                    <animateTransform attributeName="transform" type="rotate" dur="1s" repeatCount="indefinite" keyTimes="0;1" values="0 50 50;360 50 50"/>
                </circle>
                <circle cx="50" cy="50" r="23" stroke-width="8" stroke="#fe724d" stroke-dasharray="36.12831551628262 36.12831551628262" stroke-dashoffset="36.12831551628262" fill="none" stroke-linecap="round">
                    <animateTransform attributeName="transform" type="rotate" dur="1s" repeatCount="indefinite" keyTimes="0;1" values="0 50 50;-360 50 50"/>
                </circle>
                <!-- [ldio] generated by https://loading.io/ --></svg>
        </div>
    </div>

    @if($profile_image)
        <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md" role="alert">
            <div class="flex align-center justify-center">
                <div>
                    <p class="font-bold">Сликата е прикачена.</p>
                </div>
            </div>
        </div>
    @endif
    
    <div id = "imageUploadSuccess">
        
    </div>
    <div id="imagePreview"></div>
    <span class = "text-red-600">@error('profile_image'){{ $message }}@enderror</span>

    <div class="relative mt-8">
        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
            </svg>
        </div>
        <input id="address" type="text" name="address" value="{{old('address')}}" class="bg-gray-50 border-gray-300 text-gray-900 text-sm rounded-lg block w-full pl-10 p-2.5 text-lg" placeholder="адреса" required wire:model = "address">
    </div>
    <span class = "text-red-600">@error('address'){{ $message }}@enderror</span>

    <div class="relative mt-8">
        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
            </svg>
        </div>
        <input id="municipality" type="text" name="municipality" value="{{old('municipality')}}" class="bg-gray-50 border-gray-300 text-gray-900 text-sm rounded-lg block w-full pl-10 p-2.5 text-lg" placeholder="општина" required wire:model = "municipality">
    </div>
    <span class = "text-red-600">@error('municipality'){{ $message }}@enderror</span>

    <div class="relative mt-8">
        <textarea id="biography" name = "biography" rows="4" value="{{old('biography')}}" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Ваша биографија" wire:model = "biography"></textarea>
    </div>
    <span class = "text-red-600">@error('biography'){{ $message }}@enderror</span>
    @endif

    @if($currentStep == 3)
    <div class="relative mt-8">
        <textarea id="pickup_instrucntions" name = "pickup_instrucntions" rows="4" value="{{old('pickup_instrucntions')}}" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Инструкции за подигање" wire:model = "pickup_instrucntions"></textarea>
    </div>
    <span class = "text-red-600">@error('pickup_instrucntions'){{ $message }}@enderror</span>

    <div class="relative mt-8">
        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 21a9.004 9.004 0 008.716-6.747M12 21a9.004 9.004 0 01-8.716-6.747M12 21c2.485 0 4.5-4.03 4.5-9S14.485 3 12 3m0 18c-2.485 0-4.5-4.03-4.5-9S9.515 3 12 3m0 0a8.997 8.997 0 017.843 4.582M12 3a8.997 8.997 0 00-7.843 4.582m15.686 0A11.953 11.953 0 0112 10.5c-2.998 0-5.74-1.1-7.843-2.918m15.686 0A8.959 8.959 0 0121 12c0 .778-.099 1.533-.284 2.253m0 0A17.919 17.919 0 0112 16.5c-3.162 0-6.133-.815-8.716-2.247m0 0A9.015 9.015 0 013 12c0-1.605.42-3.113 1.157-4.418" />
            </svg>
        </div>
        <input id="website_link" type="text" name="website_link" value="{{old('website_link')}}" class="bg-gray-50 border-gray-300 text-gray-900 text-sm rounded-lg block w-full pl-10 p-2.5 text-lg" placeholder="Веб страна (опционално)" required wire:model = "website_link">
    </div>
    <span class = "text-red-600">@error('website_link'){{ $message }}@enderror</span>

    <div class="relative mt-8">
        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
            <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
                class = "w-6 h-6"
                viewBox="0 0 50 50">
                <path d="M 25 3 C 12.861562 3 3 12.861562 3 25 C 3 36.019135 11.127533 45.138355 21.712891 46.728516 L 22.861328 46.902344 L 22.861328 29.566406 L 17.664062 29.566406 L 17.664062 26.046875 L 22.861328 26.046875 L 22.861328 21.373047 C 22.861328 18.494965 23.551973 16.599417 24.695312 15.410156 C 25.838652 14.220896 27.528004 13.621094 29.878906 13.621094 C 31.758714 13.621094 32.490022 13.734993 33.185547 13.820312 L 33.185547 16.701172 L 30.738281 16.701172 C 29.349697 16.701172 28.210449 17.475903 27.619141 18.507812 C 27.027832 19.539724 26.84375 20.771816 26.84375 22.027344 L 26.84375 26.044922 L 32.966797 26.044922 L 32.421875 29.564453 L 26.84375 29.564453 L 26.84375 46.929688 L 27.978516 46.775391 C 38.71434 45.319366 47 36.126845 47 25 C 47 12.861562 37.138438 3 25 3 z M 25 5 C 36.057562 5 45 13.942438 45 25 C 45 34.729791 38.035799 42.731796 28.84375 44.533203 L 28.84375 31.564453 L 34.136719 31.564453 L 35.298828 24.044922 L 28.84375 24.044922 L 28.84375 22.027344 C 28.84375 20.989871 29.033574 20.060293 29.353516 19.501953 C 29.673457 18.943614 29.981865 18.701172 30.738281 18.701172 L 35.185547 18.701172 L 35.185547 12.009766 L 34.318359 11.892578 C 33.718567 11.811418 32.349197 11.621094 29.878906 11.621094 C 27.175808 11.621094 24.855567 12.357448 23.253906 14.023438 C 21.652246 15.689426 20.861328 18.170128 20.861328 21.373047 L 20.861328 24.046875 L 15.664062 24.046875 L 15.664062 31.566406 L 20.861328 31.566406 L 20.861328 44.470703 C 11.816995 42.554813 5 34.624447 5 25 C 5 13.942438 13.942438 5 25 5 z"></path>
            </svg>
        </div>
        <input id="facebook_link" type="text" name="facebook_link" value="{{old('facebook_link')}}" class="bg-gray-50 border-gray-300 text-gray-900 text-sm rounded-lg block w-full pl-10 p-2.5 text-lg" placeholder="Фејсбук линк (опционално)" required wire:model = "facebook_link">
    </div>
    <span class = "text-red-600">@error('facebook_link'){{ $message }}@enderror</span>

    <div class="relative mt-8">
        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
            <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
                class = "w-6 h-6"
                viewBox="0 0 50 50">
                <path d="M 16 3 C 8.8324839 3 3 8.8324839 3 16 L 3 34 C 3 41.167516 8.8324839 47 16 47 L 34 47 C 41.167516 47 47 41.167516 47 34 L 47 16 C 47 8.8324839 41.167516 3 34 3 L 16 3 z M 16 5 L 34 5 C 40.086484 5 45 9.9135161 45 16 L 45 34 C 45 40.086484 40.086484 45 34 45 L 16 45 C 9.9135161 45 5 40.086484 5 34 L 5 16 C 5 9.9135161 9.9135161 5 16 5 z M 37 11 A 2 2 0 0 0 35 13 A 2 2 0 0 0 37 15 A 2 2 0 0 0 39 13 A 2 2 0 0 0 37 11 z M 25 14 C 18.936712 14 14 18.936712 14 25 C 14 31.063288 18.936712 36 25 36 C 31.063288 36 36 31.063288 36 25 C 36 18.936712 31.063288 14 25 14 z M 25 16 C 29.982407 16 34 20.017593 34 25 C 34 29.982407 29.982407 34 25 34 C 20.017593 34 16 29.982407 16 25 C 16 20.017593 20.017593 16 25 16 z"></path>
                </svg>
        </div>
        <input id="instagram_link" type="text" name="instagram_link" value="{{old('instagram_link')}}" class="bg-gray-50 border-gray-300 text-gray-900 text-sm rounded-lg block w-full pl-10 p-2.5 text-lg" placeholder="Инстаграм линк (опционално)" required wire:model = "instagram_link">
    </div>
    <span class = "text-red-600">@error('instagram_link'){{ $message }}@enderror</span>

    <div class="relative mt-8">
        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M13.19 8.688a4.5 4.5 0 011.242 7.244l-4.5 4.5a4.5 4.5 0 01-6.364-6.364l1.757-1.757m13.35-.622l1.757-1.757a4.5 4.5 0 00-6.364-6.364l-4.5 4.5a4.5 4.5 0 001.242 7.244" />
            </svg>
        </div>
        <input id="other_link" type="text" name="other_link" value="{{old('other_link')}}" class="bg-gray-50 border-gray-300 text-gray-900 text-sm rounded-lg block w-full pl-10 p-2.5 text-lg" placeholder="Друг линк (опционално)" required wire:model = "other_link">
    </div>
    <span class = "text-red-600">@error('other_link'){{ $message }}@enderror</span>
    @endif


    @if($currentStep == 1 || $currentStep == 2 || $currentStep == 3)
        <div class="flex items-center justify-center mt-4">
            <button type="button" class="text-white bg-main-orange focus:outline-none font-medium rounded-full text-sm px-5 py-2.5 text-center mr-2 mb-2 px-8" wire:click = "increaseStep()">Следен чекор</button>
        </div>
    @endif

    @if($currentStep == 4)

        <div class="flex items-center justify-center flex-col mt-4 text-center">
            <h1 class = "text-3xl mb-12">Добредојде во нашата кулинарска заедница!</h1>

            <div class = "mb-8">
                <img class="object-cover" src="./images/cook.png">
            </div>

            <button type="submit" class="text-white bg-main-orange focus:outline-none font-medium rounded-full text-sm px-5 py-2.5 text-center mr-2 mb-2 px-8 btnSpin" onclick="btnSpin()">Заврши регистрација</button>
        </div>
        
    @endif
</form>