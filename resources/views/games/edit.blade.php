<x-app-layout>
    <div class="max-w-xl mx-auto p-4 sm:p-6 lg:p-8">
        <form method="POST" action="{{ route('games.update', $game) }}" enctype="multipart/form-data">
            @csrf
            @method('patch')
            <div class="mb-3">
                <label class="block mb-1">Imagem</label>
                <div class="bg-slate-300 p-3">
                    <div class="mb-3">
                        <img id="game-image" class="max-h-52" src="/img/{{ $game->image }}" alt="">
                    </div>
                    <input type="file" name="image" value="{{ old('image', $game->image) }}" onchange="previewImage(event)">
                    <small class="block">Formatos: .jpg, .jpeg, .png</small>
                    <small class="block">Tamanho max.: 2MB</small>
                </div>
                <x-input-error :messages="$errors->get('image')" class="mt-2" />
            </div>

            <div class="mb-3">
                <label class="block mb-1">Título</label>
                <input
                    class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                    type="text" name="title" value="{{ $game->title }}">
                <x-input-error :messages="$errors->get('title')" class="mt-2" />
            </div>

            <div class="mb-3">
                <label class="block mb-1">Gênero</label>
                <input
                    class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                    type="text" name="gender" value="{{ old('gender', $game->gender) }}">
                <x-input-error :messages="$errors->get('gender')" class="mt-2" />
            </div>

            <div class="mb-3">
                <div>
                    <label class="block mb-1">Plataformas:</label>
                    @foreach ($platformOptions as $option)
                        <div>
                            <input type="checkbox" name="plataform[]" value="{{ $option }}"
                                {{ in_array($option, $game->plataform) ? 'checked' : '' }}>
                            {{ $option }}
                        </div>
                    @endforeach

                </div>
                <x-input-error :messages="$errors->get('plataform')" class="mt-2" />
            </div>

            <div class="mb-3">
                <label class="block mb-1">Preço</label>
                <input
                    class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                    type="number" name="price" value="{{ old('price', $game->price) }}" step="any">
                <x-input-error :messages="$errors->get('price')" class="mt-2" />
            </div>

            <x-primary-button class="mt-4">{{ __('Alterar') }}</x-primary-button>
            <a href="{{ route('games.myGames') }}">{{ __('Cancelar') }}</a>
        </form>
        <script>
            function previewImage(event) {
                var input = event.target;
                var reader = new FileReader();

                reader.onload = function() {
                    var dataURL = reader.result;
                    var image = document.getElementById('game-image');
                    image.src = dataURL;
                };

                reader.readAsDataURL(input.files[0]);
            }
        </script>
    </div>
</x-app-layout>
