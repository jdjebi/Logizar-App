<div>
    <x-tables.simple-table.table tbodyStyle="odd:bg-white even:bg-gray-50">
        <x-slot name="columns">
            <x-tables.simple-table.th>#</x-tables.simple-table.th>
            <x-tables.simple-table.th>Nom</x-tables.simple-table.th>
            <x-tables.simple-table.th>Slug</x-tables.simple-table.th>
            <x-tables.simple-table.th>Date modification</x-tables.simple-table.th>
        </x-slot>
        <x-slot name="rows">
            @foreach ($categories as $category)  
                <x-tables.simple-table.row class="odd:bg-white even:bg-gray-50">
                    <x-tables.simple-table.td class="font-medium text-gray-900 whitespace-nowrap">{{ $loop->index + 1 }}</x-tables.simple-table.td>
                    <x-tables.simple-table.td class="font-medium text-gray-900">{{ $category->name }}</x-tables.simple-table.td>
                    <x-tables.simple-table.td>{{ $category->slug }}</x-tables.simple-table.td>
                    <x-tables.simple-table.td>{{ $category->updated_at->format("d/m/Y") }}</x-tables.simple-table.td>
                </x-tables.simple-table.row>
            @endforeach
        </x-slot>
    </x-tables.simple-table.table>
</div>