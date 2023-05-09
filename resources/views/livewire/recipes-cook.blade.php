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
    <form wire:submit.prevent = "storeRecipe">
        <div class="border-b border-gray-900/10 pb-12 pl-3 pr-3">
            <div class="mt-10 grid grid-cols-6 grid900 gap-x-6 gap-y-8">
                <div class="sm:col-span-3">
                    <label for="recipe_name" class="block text-sm font-medium leading-6 text-gray-900">Име на рецептот</label>
                <div class="mt-2">
                    <input type="text" name="recipe_name" id="recipe_name" autocomplete="given-name" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" wire:model = "recipe_name">
                </div>
                <span class = "text-red-600">@error('recipe_name'){{ $message }}@enderror</span>
                
                <div class = "mt-3">
                    <label for="description" class="block text-sm font-medium leading-6 text-gray-900">Опис</label>
                    <div class="mt-2">
                        <textarea id="description" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Напишете опис за вашиот рецепт..." name = "description" wire:model = "description"></textarea>
                    </div>
                    <span class = "text-red-600">@error('description'){{ $message }}@enderror</span>
                </div>

                <div class = "mt-10">
                    <label for="hastag_name" class="block text-sm font-medium leading-6 text-gray-900">Хаштаг</label>
                    <div class="mt-2">
                        <input type="text" name="hastag_name" id="hastag_name" autocomplete="given-name" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" wire:model = "hastag_name">
                    </div>
                    <span class = "text-red-600">@error('hastag_name'){{ $message }}@enderror</span>
                </div>
                
                <label for="allergens" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white mt-3">Одбери алерген</label>
                <ul class="items-center w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg">
                    @forelse($allAllergens as $allergen)
                        <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                            <div class="flex items-center pl-3">
                                <input id="allergenCheckBox{{ $allergen->id }}" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" wire:model="allergens.{{ $allergen->id }}">
                                <label for="allergenCheckBox{{ $allergen->id }}" class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{ $allergen->allergen_name }}</label>
                            </div>
                        </li>
                    @empty
                        <h1>Не се понајдени алергени!</h1>
                    @endforelse
                </ul>
                <span class = "text-red-600">@error('allergens'){{ $message }}@enderror</span>

                <label for="promotional_price_duration" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white mt-6">Времетраење на промотивна цена</label>
                <div class="relative w-full">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <input type="date" wire:model="promotional_price_duration" class = "bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5">
                </div>
                <span class = "text-red-600">@error('promotional_price_duration'){{ $message }}@enderror</span>

                <label for="portion_size" class="block text-sm font-medium leading-6 text-gray-900 mt-4">Големина на порцијата</label>
                    <div class="mt-2">
                        <input type="text" name="portion_size" id="portion_size" autocomplete="given-name" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" wire:model = "portion_size">
                    </div>
                <span class = "text-red-600">@error('portion_size'){{ $message }}@enderror</span>

                <label for="ingredients" class="block text-sm font-medium leading-6 text-gray-900 mt-4">Состојќи</label>
                    <div class="mt-2">
                        <input type="text" name="ingredients" id="ingredients" autocomplete="given-name" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" wire:model = "ingredients">
                    </div>
                <span class = "text-red-600">@error('ingredients'){{ $message }}@enderror</span>

                <label for="spiciness" class="block text-sm font-medium leading-6 text-gray-900 mt-4">Лутина</label>
                    <div class="mt-2">
                        <input type="text" name="spiciness" id="spiciness" autocomplete="given-name" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" wire:model = "spiciness">
                    </div>
                <span class = "text-red-600">@error('spiciness'){{ $message }}@enderror</span>

            </div>
            <div class="sm:col-span-3">
                <div class="border-b border-gray-900/10 pb-12">
                    <div class="col-span-full">
                        <label for="cover-photo" class="block text-sm font-medium leading-6 text-gray-900">Слика на рецептот</label>
                        <div class="mt-2 flex justify-center rounded-lg border border-dashed border-gray-900/25 px-6 py-10">
                            <div class="text-center">
                                <svg class="mx-auto h-12 w-12 text-gray-300" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M1.5 6a2.25 2.25 0 012.25-2.25h16.5A2.25 2.25 0 0122.5 6v12a2.25 2.25 0 01-2.25 2.25H3.75A2.25 2.25 0 011.5 18V6zM3 16.06V18c0 .414.336.75.75.75h16.5A.75.75 0 0021 18v-1.94l-2.69-2.689a1.5 1.5 0 00-2.12 0l-.88.879.97.97a.75.75 0 11-1.06 1.06l-5.16-5.159a1.5 1.5 0 00-2.12 0L3 16.061zm10.125-7.81a1.125 1.125 0 112.25 0 1.125 1.125 0 01-2.25 0z" clip-rule="evenodd" />
                                </svg>
                                    <div class="mt-4 flex ml-6 text-sm leading-6 text-gray-600">
                                        <label for="recipe_image" class="relative cursor-pointer rounded-md bg-white font-semibold text-indigo-600 focus-within:outline-none focus-within:ring-2 focus-within:ring-indigo-600 focus-within:ring-offset-2 hover:text-indigo-500">
                                            <span>Додади слика</span>
                                            <input id="recipe_image" name="recipe_image" type="file" class="sr-only" wire:model = "recipe_image" onchange="fileValidation(recipe_image)" >
                                        </label>
                                    </div>
                                    <p class="text-xs leading-5 text-gray-600">PNG, JPG, GIF, JPEG до 1MB</p>
                                </div>
                            </div>
                            <span class = "text-red-600">@error('recipe_image'){{ $message }}@enderror</span>
                            <div id = "imageUploadSuccess" class = "my-6"></div>
                        </div>
                        <h3 class="mb-4 font-semibold text-gray-900 dark:text-white">Тип на храна</h3>
                        <ul class="items-center w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg">
                            @forelse($allTypes as $type)
                                <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                    <div class="flex items-center pl-3">
                                        <input id="typeCheckBox{{ $type->id }}" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" wire:model="types.{{ $type->id }}">
                                        <label for="typeCheckBox{{ $type->id }}" class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{ $type->type_name }}</label>
                                    </div>
                                </li>
                            @empty
                                <h1>Не се понајдени типови на храна!</h1>
                            @endforelse
                        </ul>
                        <span class = "text-red-600">@error('types'){{ $message }}@enderror</span>

                        <label for="price_per_meal" class="block text-sm font-medium leading-6 text-gray-900 mt-4">Цена по оброк</label>
                        <div class="mt-2">
                            <input type="number" name="price_per_meal" id="price_per_meal" autocomplete="given-name" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" wire:model = "price_per_meal">
                        </div>
                        <span class = "text-red-600">@error('price_per_meal'){{ $message }}@enderror</span>

                        <label for="price_per_meal" class="block text-sm font-medium leading-6 text-gray-900 mt-3">Промотивна цена по оброк</label>
                        <div class="mt-2">
                            <input type="number" name="promotional_price_per_meal" id="promotional_price_per_meal" autocomplete="given-name" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" wire:model = "promotional_price_per_meal">
                        </div>
                        <span class = "text-red-600">@error('promotional_price_per_meal'){{ $message }}@enderror</span>

                    <label for="warm_up_instructions" class="block text-sm font-medium leading-6 text-gray-900 mt-6">Инструкции за загевање</label>
                    <div class="mt-2">
                        <textarea id="warm_up_instructions" rows="5" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Напишете опис за вашиот рецепт..." name = "warm_up_instructions" wire:model = "warm_up_instructions"></textarea>
                    </div>
                    <span class = "text-red-600">@error('warm_up_instructions'){{ $message }}@enderror</span>

                    <label for="comment" class="block text-sm font-medium leading-6 text-gray-900 mt-6">Коментар</label>
                    <div class="mt-2">
                        <textarea id="comment" rows="5" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Напишете опис за вашиот рецепт..." name = "comment" wire:model = "comment"></textarea>
                    </div>
                    <span class = "text-red-600">@error('comment'){{ $message }}@enderror</span>
                    </div>
                </div>
            </div>

            <div wire:loading wire:target="recipe_image">
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

            @if($recipe_image && !session("success"))
                <script>
                    toastr.options = {
                        "progressBar" : true,
                        "closeButton": true,
                    }
                    toastr.success("Сликата е прикачена!");
                </script>
                @endif

            <div class="mt-6 flex items-center justify-end gap-x-6">
                <a href="{{ route('cooks') }}"><button type="button" class="text-sm font-semibold leading-6 text-gray-900">Назад</button></a>
                <button type="submit" class="rounded-md bg-main-orange px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Додади</button>
            </div>
        </div>
    </form>
</div>

