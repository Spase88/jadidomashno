<table class="w-full text-sm text-left text-gray-500 dark:text-gray-400 text-center">
    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
        <tr>
            <th scope="col" class="px-6 py-3">
                #
            </th>
            <th scope="col" class="px-6 py-3">
                Име на рецептот
            </th>
            <th scope="col" class="px-6 py-3">
                Име и презиме на гурманот
            </th>
            <th scope="col" class="px-6 py-3">
                Количина
            </th>
            <th scope="col" class="px-6 py-3">
                Начин на достава
            </th>
            <th scope="col" class="px-6 py-3">
                Цена
            </th>
            <th scope="col" class="px-6 py-3">
                Дата на нарачување
            </th>
        </tr>
    </thead>
    <tbody>

        @forelse ($orders as $order)
        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
            <td class="py-4">
                {{ $order->id }}
            </td>
            <td class="py-4">
                {{ $order->recipe_name }}
            </td>
            <td class="py-4">
                {{ $order->gourmet_name }} {{ $order->gourmet_lastname }}
            </td>
            <td class="py-4">
                {{ $order->quantity }}
            </td>
            <td class="py-4">
                {{ $order->delivery_method }}
            </td>
            <td class="py-4">
                {{ $order->price }}
            </td>
            <td class="py-4">
                {{ $order->ordered_at }}
            </td>
        </tr>    
        @empty
            <h1 class = "text-lg font-bold mb-3">Не се пронајдени нарачки!</h1>
        @endforelse
    </tbody>
</table>