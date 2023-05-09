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


    @if($currentStep == 1 || $currentStep == 2)
        <div class="flex items-center justify-center mt-4">
            <button type="button" class="text-white bg-main-orange focus:outline-none font-medium rounded-full text-sm px-5 py-2.5 text-center mr-2 mb-2 px-8" wire:click = "increaseStep()">Следен чекор</button>
        </div>
    @endif

    @if($currentStep == 3)

        <div class="flex items-center justify-center flex-col mt-4 text-center">
            <h1 class = "text-3xl mb-12">Добредојде во нашата кулинарска заедница!</h1>

            <div class = "mb-8">
                <img class="object-cover" src="./images/cook.png">
            </div>

            <button type="submit" class="text-white bg-main-orange focus:outline-none font-medium rounded-full text-sm px-5 py-2.5 text-center mr-2 mb-2 px-8 btnSpin" onclick="btnSpin()">Заврши регистрација</button>
        </div>
        
    @endif
</form>