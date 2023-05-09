<div>
    @if(session('success'))
        <script>
            toastr.options = {
                "progressBar" : true,
                "closeButton": true,
            }
            toastr.success("{{ session('success') }}");
        </script>

    @elseif(session('error'))
        <script>
            toastr.options = {
                "progressBar" : true,
                "closeButton": true,
            }
            toastr.error("{{ session('error') }}");
        </script>
    @endif
    <form wire:submit.prevent = "updateCook">
        <div class="border-b border-gray-900/10 pb-12 pl-3 pr-3">
            <div class="mt-10 grid grid-cols-6 grid900 gap-x-6 gap-y-8">
                <div class="sm:col-span-3">
                    <label for="first-name" class="block text-sm font-medium leading-6 text-gray-900">Име</label>
                <div class="mt-2">
                    <input type="text" name="name" id="name" autocomplete="given-name" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" value="{{old('name')}}" wire:model = "name">
                </div>
                <span class = "text-red-600 mt-3">@error('name'){{ $message }}@enderror</span>


                <label for="lastname" class="block text-sm font-medium leading-6 text-gray-900 mt-3">Презиме</label>
                <div class="mt-2">
                    <input type="text" name="lastname" id="lastname" autocomplete="given-lastname" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" value="{{$user->lastname}}" wire:model = "lastname">
                </div>
                <span class = "text-red-600 mt-3">@error('lastname'){{ $message }}@enderror</span>

                <label for="email" class="block text-sm font-medium leading-6 text-gray-900 mt-3">Е-Маил</label>
                <div class="mt-2">
                    <input type="text" name="email" id="email" autocomplete="given-email" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" value="{{$user->email}}" wire:model = "email">
                </div>
                <span class = "text-red-600 mt-3">@error('email'){{ $message }}@enderror</span>

                <label for="address" class="block text-sm font-medium leading-6 text-gray-900 mt-5">Адреса</label>
                <div class="mt-2">
                    <input type="text" name="address" id="address" autocomplete="given-address" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" value="{{$user->address}}" wire:model="address">
                </div>
                <span class = "text-red-600 mt-3">@error('address'){{ $message }}@enderror</span>

                <div class = "mt-6 flex items-center justify-center max-[1164px]:flex-col">
                    <img src="{{ asset('storage/images/' . $user->profile_image) }}" class="w-28 h-28 p-1 rounded-full ring-2 ring-gray-300 dark:ring-gray-500 mr-3 max-[1105px]:mb-6" alt="Profile Image">
                    <div class="flex items-center justify-center w-full">
                        <label for="profile_image" class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                            <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                <svg aria-hidden="true" class="w-10 h-10 mb-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path></svg>
                                <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Кликнете овде</span> или повлечете ја овде.</p>
                                <p class="text-xs text-gray-500 dark:text-gray-400">ЈPEG, PNG, JPG or GIF (MAX. 1MB)</p>
                            </div>
                            <input id="profile_image" type="file" class="hidden" name = "profile_image" wire:model = "profile_image" onchange="fileValidation(profile_image)" />
                        </label>
                    </div> 
                </div>
                <div id = "imageUploadSuccess" class = "my-6"></div>

                            <label for="instagram_link" class="block text-sm font-medium leading-6 text-gray-900 mt-3">Инстаграм линк</label>
                            <div class="mt-2">
                                <input type="text" name="instagram_link" id="instagram_link" autocomplete="given-name" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" wire:model = "instagram_link">
                            </div>
                            <span class = "text-red-600 mt-3">@error('instagram_link'){{ $message }}@enderror</span>

                            <label for="other_link" class="block text-sm font-medium leading-6 text-gray-900 mt-3">Друг линк</label>
                            <div class="mt-2">
                                <input type="text" name="other_link" id="other_link" autocomplete="given-name" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" wire:model = "other_link">
                            </div>
                            <span class = "text-red-600 mt-3">@error('other_link'){{ $message }}@enderror</span>

                <!-- Loading bar -->

                <div wire:loading wire:target="profile_image">
                    <div class = "spinnerClass">
                        <div class="la-line-scale la-3x">
                            <div></div>
                            <div></div>
                            <div></div>
                            <div></div>
                            <div></div>
                        </div>
                    </div>
                </div>


                <span class = "text-red-600 mt-6">@error('profile_image'){{ $message }}@enderror</span>

                @if($profile_image && !session("success"))
                <script>
                    toastr.options = {
                        "progressBar" : true,
                        "closeButton": true,
                    }
                    toastr.success("Сликата е прикачена!");
                </script>
                @endif

            </div>
            <div class="sm:col-span-3">
                <div class="border-b border-gray-900/10 pb-12">
                    <div class="col-span-full">
                        <label for="mobile" class="block text-sm font-medium leading-6 text-gray-900">Телефон</label>
                        <div class="mt-2">
                            <input type="text" name="mobile" id="mobile" autocomplete="given-name" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" value="{{$user->mobile}}" wire:model = "mobile" oninput="enforcePhoneNumberFormat(this)" onkeyup="addHyphen(this)" maxlength="11">
                        </div>
                        <span class = "text-red-600 mt-3">@error('mobile'){{ $message }}@enderror</span>

                        <div class = "mt-3">
                            <label for="biography" class="block text-sm font-medium leading-6 text-gray-900">Опис</label>
                            <div class="mt-2">
                                <textarea id="biography" name = "biography" rows="5" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Вашата биографија" value="{{$user->biography}}" wire:model = "biography">{{$user->biography}}</textarea>
                            </div>
                            <span class = "text-red-600 mt-3">@error('biography'){{ $message }}@enderror</span>

                            <label for="municipality" class="block text-sm font-medium leading-6 text-gray-900 mt-4">Општина</label>
                            <div class="mt-2">
                                <input type="text" name="municipality" id="municipality" autocomplete="given-municipality" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" value="{{$user->municipality}}" wire:model="municipality">
                            </div>
                            <span class = "text-red-600 mt-3">@error('municipality'){{ $message }}@enderror</span>

                            <label for="pickup_instrucntions" class="block text-sm font-medium leading-6 text-gray-900 mt-4">Инструкции за подигање</label>
                            <div class="mt-2">
                                <textarea id="pickup_instrucntions" name = "pickup_instrucntions" rows="10" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Вашата биографија" wire:model = "pickup_instrucntions"></textarea>
                            </div>
                            <span class = "text-red-600 mt-3">@error('pickup_instrucntions'){{ $message }}@enderror</span>

                            <label for="website_link" class="block text-sm font-medium leading-6 text-gray-900 mt-8">Веб страна</label>
                            <div class="mt-2">
                                <input type="text" name="website_link" id="website_link" autocomplete="given-name" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" wire:model = "website_link">
                            </div>
                            <span class = "text-red-600 mt-3">@error('website_link'){{ $message }}@enderror</span>

                            <label for="facebook_link" class="block text-sm font-medium leading-6 text-gray-900 mt-3">Фејсбук линк</label>
                            <div class="mt-2">
                                <input type="text" name="facebook_link" id="facebook_link" autocomplete="given-name" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" wire:model = "facebook_link">
                            </div>
                            <span class = "text-red-600 mt-3">@error('facebook_link'){{ $message }}@enderror</span>

                        </div>
                    </div>
                </div>
            </div>     
        </div>
        
            <div class="mt-6 flex items-center justify-end gap-x-6">
                <a href="{{ route('cooks') }}"><button type="button" class="text-sm font-semibold leading-6 text-gray-900">Назад</button></a>
                <button type="submit" class="rounded-md bg-main-orange px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Зачувај</button>
            </div>
        </div>
    </form>
</div>