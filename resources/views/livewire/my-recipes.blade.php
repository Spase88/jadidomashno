<div>
    <form action="{{ route("storeMyRecipes") }}" method="POST">
    @csrf
    <div class="bg-white shadow overflow-hidden sm:rounded-md">
        <ul class="divide-y divide-gray-200">
            @forelse($recipes as $key => $item)
            <li class="flex py-6 px-4 sm:px-6">
                <div class="flex-shrink-0">
                    <img class="h-28 w-28 rounded-md object-cover" src="{{ asset('storage/images/' . $item['recipe']->recipe_image) }}">
                </div>
                <div class="ml-6 flex-1 flex flex-col">
                    <div class="flex">
                        <div class="font-medium text-gray-900">{{ $item['recipe']->recipe_name }}</div>
                        <div class="ml-auto font-medium text-gray-900">{{ $item['recipe']->commercialData->promotional_price_per_meal }}ден</div>
                    </div>
                    <div class="mt-1 flex-grow text-sm text-gray-500">{{ $item['recipe']->description }}</div>
                    <div class="flex mt-4">
                        <div class="relative rounded-md shadow-sm">
                            <input type="number" id="quantity" class="focus:ring-orange-500 focus:border-orange-500 block w-full sm:text-sm border-gray-300 rounded-md" min="1" name="quantity[{{ $key }}]" value="{{ $item['quantity'] }}">
                        </div>
                        <select id="delivery_method" class="ml-3 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-orange-500 focus:border-orange-500 block w-32 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" name="delivery_method[{{$key}}]">
                            <option value="Испорака">Испорака</option>
                            <option value="Достава">Достава</option>
                        </select>
                        
                            <button wire:click="removeFromCart('{{ $key }}')" type="button" class="ml-3 text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                </svg> 
                                Избриши
                            </button>
                        </div>
                    </div>
                </li>
                @empty
                <div class="flex justify-center items-center h-full">
                    <div class="bg-white p-8 rounded-lg shadow-lg">
                        <div class="flex justify-center items-center mb-8">
                        
                        </div>
                        <p class="text-2xl font-semibold text-center text-gray-700 mb-4">Вашата кошничка е празна!</p>
                        <p class="text-gray-500 text-center mb-6">Сè уште не сте додале нешто во вашата кошничка.</p>
                        <div class="flex justify-center">
                            <a href="{{ route("homepage") }}" class="text-white bg-blue-500 hover:bg-blue-600 font-semibold py-2 px-4 border border-transparent rounded-md shadow-sm flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="mr-1 w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                                </svg>                                  
                                Врати се назад
                            </a>
                        </div>
                    </div>
                </div>
                @endforelse
            </ul>
        </div>
        @if(is_array(Session::get('cart')) && count(Session::get('cart')) > 0)
            <div class = "flex justify-end mt-3">
                <button type = "submit" class="flex items-center justify-center bg-blue-500 text-white font-bold py-2 px-4 rounded-full focus:outline-none focus:ring-4 focus:ring-blue-300 hover:bg-blue-600">
                    <svg class="h-6 w-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                    </svg>
                    Нарачи
                </button>  
            </div>
        @endif

    </form>
</div>
