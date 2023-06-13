<x-app-layout>
    <div class="max-w-7xl mx-auto p-4 sm:p-6 lg:p-8">
        @if (session('success'))
            <div class="max-w-7xl mx-auto mt-4">
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative"
                    role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            </div>
        @endif
        
        @if (count($games) > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-x-4 gap-y-4 mt-6">
                @foreach ($games as $game)
                    <div class="bg-white shadow-sm rounded-lg divide-y hover:cursor-pointer">
                        <div class="flex justify-end px-2 pt-1">
                            <x-dropdown>
                                <x-slot name="trigger">
                                    <button>
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400"
                                            viewBox="0 0 20 20" fill="currentColor">
                                            <path
                                                d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                                        </svg>
                                    </button>
                                </x-slot>
                                <x-slot name="content">
                                    <x-dropdown-link :href="route('games.edit', $game)">
                                        {{ __('Editar') }}
                                    </x-dropdown-link>
                                    <form method="POST" action="{{ route('games.destroy', $game) }}">
                                        @csrf
                                        @method('delete')
                                        <x-dropdown-link :href="route('games.destroy', $game)"
                                            onclick="event.preventDefault(); this.closest('form').submit();">
                                            {{ __('Deletar') }}
                                        </x-dropdown-link>
                                    </form>
                                </x-slot>
                            </x-dropdown>
                        </div>

                        <div class="h-80 p-3 flex items-center justify-center flex-col">
                            <img class="max-h-60" class="rounded-t-lg object-contain" src="/img/{{ $game->image }}"
                                alt="">
                        </div>
                        <div class="p-4 pt-1 flex flex-col space-x-2">
                            <div class="flex-1">
                                <div class="flex justify-between items-center">
                                    <div>
                                        <span class="text-gray-800">Postado por {{ $game->user->name }}</span>
                                        <small
                                            class="block text-sm text-gray-600">{{ $game->created_at->format('j M Y, g:i a') }}</small>
                                    </div>
                                </div>
                                <div class="mt-2">
                                    <ul>
                                        <li>
                                            <b>Título:</b> {{ $game->title }}
                                        </li>
                                        <li>
                                            <b>Gênero:</b> {{ $game->gender }}
                                        </li>
                                        <li>
                                            <span class="text-green-700 text-lg">R${{ $game->price }}</span>
                                        </li>
                                        <li>
                                            @foreach ($game->plataform as $index => $plataform)
                                                <small class="text-xs text-gray-600">
                                                    @if ($index > 0)
                                                        -
                                                    @endif {{ $plataform }}
                                                </small>
                                            @endforeach
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="max-w-7xl mx-auto mt-4">
                <div class="bg-slate-300 border px-4 py-3 rounded relative"
                    role="alert">
                    <span class="block sm:inline">Você ainda não adicionou nenhum jogo...</span>
                </div>
            </div>
        @endif
    </div>
</x-app-layout>
