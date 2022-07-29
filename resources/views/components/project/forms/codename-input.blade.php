<div>

    <x-forms.inputs.label-input 
        model="code_name" 
        label="Code du projet*" 
        label_title="Nom du projet utilisé dans son url"  
        class="w-full" 
        wire:input="checkCodeNameUnicity"
    />

    <div class="my-3">
        <span class="text-xs text-gray-500 {{ empty($code_name) || $codeNameIsUnique ? '' : 'text-red-600' }}">
            Lien du projet : {{ $this->baseUrl }}/{{ $this->code_name }}
            @if (!empty($code_name) && !$codeNameIsUnique)
                , code déjà utilisé.
            @endif
        </span>
    </div>

    <span class="text-sm text-gray-500">45 caractères au maximum. Le code du projet est unique.
        Appliquez de petites variations pour le rendre unique si necessaire. Exemple : <span
            class="font-semibold">logizar.app ou logizar.1</span>. Les caractères spéciaux autorisés : "-
        .". Ces derniers ne doivent figurés ni au début ni à la fin du code.
    </span>
</div>
