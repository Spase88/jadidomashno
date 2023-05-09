<div>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 mx-auto">
        @forelse ($recipes as $recipe)
            <div class="zoom-effect max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                <a href="#">
                    <img class="rounded-t-lg h-60 w-full object-cover" src="{{ asset('storage/images/' . $recipe->recipe_image) }}" alt="" />
                </a>
                <div class="flex items-center space-x-4 mt-4">
                    <img class="w-10 h-10 rounded-full" src="{{ asset('storage/images/' . $recipe->users->profile_image) }}" alt="">
                    <div class="font-medium dark:text-white">
                        <div>{{ $recipe->users->name }} {{ $recipe->users->lastname }}</div>
                        <div class="text-sm text-gray-500 dark:text-gray-400">{{ $recipe->created_at }}</div>
                    </div>
                </div>
                <div class="p-5">
                    <a href="#">
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $recipe->recipe_name }}</h5>
                    </a>
                    <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">{{ $recipe->description }}</p>
                    <div class="mb-3 pt-4 pb-2">
                        @foreach ($recipe->hashtags as $hashtag)
                            <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">{{ $hashtag->hastag_name }}</span>
                        @endforeach
                    </div>
                    <div class="flex mb-4">
                        <div class="mr-4">
                            <span class="text-gray-500 line-through">{{ $recipe->commercialData->price_per_meal . "ден" }}</span>
                            <span class="text-green-500">{{ $recipe->commercialData->promotional_price_per_meal . "ден" }}</span>
                        </div>
                        <div class="bg-green-500 rounded-full text-white px-4 py-1 text-sm font-semibold">
                            Промотивна цена
                        </div>
                    </div>
                    @if(Auth::check() && Auth::user()->role_id === 2)
                            <div class = "flex">
                                <button type = "button" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" wire:click = "addToCart({{ $recipe->id }}, {{ $recipe->user_id }})">
                                    Додади во кошничка
                                    <svg  xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 ml-2 -mr-1">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
                                    </svg>
                                </button>
                            </div>
                    @endif
                </div>
            </div>

        @empty
        {{-- class="w-4 h-4 ml-2 -mr-1" --}}
        @endforelse
        
    </div>
</div>
