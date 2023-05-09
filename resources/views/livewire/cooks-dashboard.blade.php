<div>
    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400 text-center">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    #
                </th>
                <th scope="col" class="px-6 py-3">
                    Име на Рецепт
                </th>
                <th scope="col" class="px-6 py-3">
                    Опис
                </th>
                <th scope="col" class="px-6 py-3">
                    Достапност
                </th>
                <th scope="col" class="px-6 py-3">
                    Акција
                </th>
            </tr>
        </thead>
        <tbody>
            
            @forelse ($recipes as $recipe)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $recipe->id }}
                    </th>
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $recipe->recipe_name }}
                    </th>
                    <td class="px-6 py-4">
                        {{ Str::limit($recipe->description, 20) }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $recipe->availability ? "ОД " . $recipe->availability->date_available_from . " ДО" : 'N/A' }} {{ optional($recipe->availability)->date_available_to }}
                    </td>
                    <td class="py-4">
                        <button wire:click="setRecipeId({{ $recipe->id }})" data-modal-target="availability-Modal" data-modal-toggle="availability-Modal" type="button" class="text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-400 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-1">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Достапност
                        </button>
                        
                        <button wire:click="editRecipe({{ $recipe->id }})" data-modal-target="editRecipe-Modal" data-modal-toggle="editRecipe-Modal" type="button" class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                            </svg>
                            Уреди
                        </button>
                        <button wire:click="changeDelete({{$recipe->id}})" data-modal-target="popup-modal" data-modal-toggle="popup-modal" type="button" class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                            </svg> 
                            Избриши
                        </button>
                    </td>
                </tr>           
                <div wire:ignore.self id="popup-modal" tabindex="-1" class="fixed top-0 left-0 right-0 z-50 hidden p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full flex justify-center items-center">
                    <div class="relative w-full max-w-md max-h-full">
                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                            <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white" data-modal-hide="popup-modal">
                                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                <span class="sr-only">Close modal</span>
                            </button>
                            <div class="p-6 text-center">
                                <svg aria-hidden="true" class="mx-auto mb-4 text-gray-400 w-14 h-14 dark:text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Дали сте сигурни дека сакате да го избришете овој рецепт?</h3>
                                <button wire:click = "deleteRecipe()" data-modal-hide="popup-modal" type="button" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                                    Да, сигурен сум!
                                </button>
                                <button data-modal-hide="popup-modal" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Не, откажете</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div wire:ignore.self id="editRecipe-Modal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                    <div class="relative w-full max-w-md max-h-full">
                        <!-- Modal content -->
                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                            <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white" data-modal-hide="editRecipe-Modal">
                                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                <span class="sr-only" id = "closeModal">Close modal</span>
                            </button>
                            <div class="px-6 py-6 lg:px-8">
                                <h3 class="mb-4 text-xl font-medium text-gray-900 dark:text-white">Уреди го рецептот</h3>
                                <form class="space-y-6" wire:submit.prevent = "updateRecipe">
                                    <div class = "mb-3">
                                        <label for="recipe_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Име на рецептот</label>
                                        <input type="recipe_name" name="recipe_name" id="recipe_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" wire:model = "recipe_name">
                                    </div>
                                    <span class = "text-red-600">@error('recipe_name'){{ $message }}@enderror</span>

                                    <div class = "mb-3">
                                        <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Опис</label>
                                        <div class="mt-2">
                                            <textarea id="description" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Напишете опис за вашиот рецепт..." name = "description" wire:model = "description"></textarea>
                                        </div>
                                    </div>
                                    <span class = "text-red-600">@error('description'){{ $message }}@enderror</span>

                                    <div class = "mb-3">
                                        <label for="hastag_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Хаштаг</label>
                                        <input type="hastag_name" name="hastag_name" id="hastag_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" wire:model = "hastag_name">
                                    </div>
                                    <span class = "text-red-600">@error('hastag_name'){{ $message }}@enderror</span>

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

                                    {{--  --}}
                                    <label for="allergens" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white mt-3">Избери тип на храна</label>
                                    <ul class="items-center w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg">
                                        @forelse($allTypes as $type)
                                            <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                                <div class="flex items-center pl-3">
                                                    <input id="typeCheckBox{{ $type->id }}" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" wire:model="types.{{ $type->id }}">
                                                    <label for="typeCheckBox{{ $type->id }}" class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{ $type->type_name }}</label>
                                                </div>
                                            </li>
                                        @empty
                                            <h1>Не се понајдени алергени!</h1>
                                        @endforelse
                                    </ul>
                                    <span class = "text-red-600">@error('types'){{ $message }}@enderror</span>

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

                                    <div class = "mt-6 mb-6 flex items-center justify-center flex-col">
                                        @if ($recipe_image)
                                            <img src="{{ asset('storage/images/' . $recipe_image) }}" class="w-28 h-28 p-1 mb-6 rounded-full ring-2 ring-gray-300 dark:ring-gray-500 mr-3 max-[1105px]:mb-6" alt="Recipe Image">
                                        @endif
                                        <div class="flex items-center justify-center w-full">
                                            <label for="recipe_image" class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                                                <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                                    <svg aria-hidden="true" class="w-10 h-10 mb-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path></svg>
                                                    <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Кликнете овде</span> или повлечете ја овде.</p>
                                                    <p class="text-xs text-gray-500 dark:text-gray-400">ЈPEG, PNG, JPG or GIF (MAX. 1MB)</p>
                                                </div>
                                                <input id="recipe_image" type="file" class="hidden" name = "recipe_image" onchange="fileValidation(recipe_image)" wire:model = "recipe_image"  />
                                            </label>
                                        </div> 
                                        <span class = "text-red-600">@error('recipe_image'){{ $message }}@enderror</span>
                                        <div id = "imageUploadSuccess" class = "my-6"></div>
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

                                    </div>
                                    <button type="submit" class="w-full text-white bg-main-orange font-medium rounded-lg text-sm px-5 py-2.5 text-center">Зачувај ги промените</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div> 
                <div wire:ignore.self id="availability-Modal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                    <div class="relative w-full max-w-md max-h-full">
                        <!-- Modal content -->
                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                            <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white" data-modal-hide="availability-Modal">
                                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                <span class="sr-only" id = "closeModal">Close modal</span>
                            </button>
                            <div class="px-6 py-6 lg:px-8">
                                <h3 class="mb-4 text-xl font-medium text-gray-900 dark:text-white">Достапност на рецептот</h3>
                                <form class="space-y-6" wire:submit.prevent = "addAvailability">
                                    <label for="promotional_price_duration" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white mt-6">Почетна дата</label>
                                    <div class="relative w-full">
                                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                            <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path>
                                            </svg>
                                        </div>
                                        <input type="date" wire:model="date_available_from" class = "bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5">
                                    </div>
                                    <span class = "text-red-600">@error('date_available_from'){{ $message }}@enderror</span>

                                    <label for="promotional_price_duration" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white mt-6">Завршна дата</label>
                                    <div class="relative w-full">
                                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                            <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path>
                                            </svg>
                                        </div>
                                        <input type="date" wire:model="date_available_to" class = "bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5">
                                    </div>
                                    <span class = "text-red-600">@error('date_available_to'){{ $message }}@enderror</span>


                                    <label for="serving_numbers" class="block text-sm font-medium leading-6 text-gray-900 mt-4">Број на проции</label>
                                    <div class="mt-2">
                                        <input type="number" name="serving_numbers" id="serving_numbers" autocomplete="given-name" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" wire:model = "serving_numbers">
                                    </div>
                                    <span class = "text-red-600">@error('serving_numbers'){{ $message }}@enderror</span>
                                    <button type="submit" class="w-full text-white bg-main-orange font-medium rounded-lg text-sm px-5 py-2.5 text-center mt-6">Зачувај ги промените</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div> 
            @empty
                
            @endforelse
        </tbody>
    </table>
</div>
