<div class="bg-white border-inherit p-5">
    <form action="{{ route("project.create") }}" method="POST">
        @csrf

        <div>
            <x-jet-label for="name" value="Nom du projet" />
            <x-jet-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" />
        </div>

        <div class="mt-4">
            <x-jet-label for="description" value="Description" />
            <textarea class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm block mt-1 w-full" name="description" id="" cols="30" rows="10"></textarea>
        </div>

        <div class="mt-4">  
            <x-jet-button>Enregistrer</x-jet-button>
        </div>

    </form>
</div>