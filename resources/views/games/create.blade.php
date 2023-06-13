<x-app-layout>
    <div class="max-w-xl mx-auto p-4 sm:p-6 lg:p-8">
        <form method="POST" action="{{ route('games.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label class="block mb-1">Imagem</label>
                <div class="bg-slate-300 p-3">
                    <input type="file" name="image" value="{{ old('image') }}">
                    <small class="block">Formatos: .jpg, .jpeg, .png</small>
                    <small class="block">Tamanho max.: 2MB</small>
                </div>
                <x-input-error :messages="$errors->get('image')" class="mt-2" />
            </div>

            <div class="mb-3">
                <label class="block mb-1">Título</label>
                <input
                    class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                    type="text" name="title" value="{{ old('title') }}">
                <x-input-error :messages="$errors->get('title')" class="mt-2" />
            </div>

            <div class="mb-3">
                <label class="block mb-1">Gênero</label>
                <input
                    class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                    type="text" name="gender" value="{{ old('gender') }}">
                <x-input-error :messages="$errors->get('gender')" class="mt-2" />
            </div>

            <div class="mb-3">
                <div>
                    <label class="block mb-1">Plataformas:</label>
                    <div>
                        <input type="checkbox" name="plataform[]" value="Playstation 5"> Playstation 5
                    </div>
                    <div>
                        <input type="checkbox" name="plataform[]" value="Playstation 4"> Playstation 4
                    </div>
                    <div>
                        <input type="checkbox" name="plataform[]" value="Xbox One"> Xbox One
                    </div>
                    <div>
                        <input type="checkbox" name="plataform[]" value="Microsoft Windows"> Microsoft Windows
                    </div>
                </div>
                <x-input-error :messages="$errors->get('plataform')" class="mt-2" />
            </div>

            <div class="mb-3">
                <label class="block mb-1">Preço</label>
                <input
                    class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                    type="number" name="price" value="{{ old('price') }}" step="any">
                <x-input-error :messages="$errors->get('price')" class="mt-2" />
            </div>

            <x-primary-button class="mt-4">{{ __('Adicionar') }}</x-primary-button>
        </form>
    </div>
</x-app-layout>
