<div>
    <button data-modal-target="addModal" data-modal-toggle="addModal" class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 mb-3" type="button">
        Додади
    </button>
    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400 text-center">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    #
                </th>
                <th scope="col" class="px-6 py-3">
                    Име на типот
                </th>
            </tr>
        </thead>
        <tbody>
            
            @forelse ($allTypes as $type)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $type->id }}
                    </th>
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $type->type_name }}
                    </th>
                    <td class="py-4 w-1/4">
                        <button wire:click="editType({{ $type->id }})" data-modal-target="edit-Modal" data-modal-toggle="edit-Modal" type="button" class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                            </svg>
                            Уреди
                        </button>
                        <button wire:click="changeDelete({{$type->id}})" data-modal-target="deleteModal" data-modal-toggle="deleteModal" type="button" class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                            </svg> 
                            Избриши
                        </button>
                    </td>
                </tr>      
                
                @section('deleteMethod')deleteType()@endsection
                @include("livewire.modals.deleteModal")

                @section("editModalHeader") Уреди го типот на храна @endsection
                @section("editMethod")updateType()@endsection
                @section("editModalContent")
                    <div class = "mb-3">
                        <label for="type_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Име на типот</label>
                        <input type="type_name" name="type_name" id="type_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" wire:model = "type_name">
                    </div>
                    <span class = "text-red-600 mt-3">@error('type_name'){{ $message }}@enderror</span>
                @endsection
                @include("livewire.modals.editModal")
                
                @section("addHeader") Додади нов тип на храна @endsection
                @section("addMethod")addType()@endsection
                @section("addFields") 
                    <div class = "mb-3">
                        <label for="type_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Име на типот</label>
                        <input type="type_name" name="type_name" id="type_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" wire:model = "type_name">
                    </div>
                <span class = "text-red-600 mt-3">@error('type_name'){{ $message }}@enderror</span>
                @endsection
                @include('livewire.modals.addModal')
            @empty
                <h1 class = "text-lg font-bold mb-3">Не се пронајдени типови на храна, додадете!</h1>
                @section("addMethod")addType()@endsection
                @include('livewire.modals.addModal')
            @endforelse
        </tbody>
    </table>
</div>
