<x-app-layout>
    <x-slot name="title">
        <div class="flex justify-between">
            <h1 class="text-2xl font-bold">{{ $selectedDistrict->title }}<h1>
            @auth
                @if(Auth::user()->is_admin)
                    <a href="{{ route('spaces.create') }}">
                        <x-primary-button>добавить место</x-primary-button>
                    </a>
               @endif
            @endif
        </div>
    </x-slot>

    <div class="container mx-auto px-4 sm:px-6 lg:p-8">
        <div class="flex py-4 gap-8">
            {{-- боковое меню --}}
            <aside class="w-1/4 mr-5 py-2">
                <ul>
                    <a href="{{ route('spaces.index') }}" class="hover:text-blue-500">
                        <li class="border border-gray-300 px-2 py-1 {{ request('district') == null ? 'bg-gray-600 text-white' : ''}}">
                            Все районы
                        </li>
                    </a>
                    @foreach ($districts as $district)
                        <a href="{{ route('districts.show', $district->slug) }}" class="hover:text-blue-500">
                            <li class="border border-gray-300 px-2 py-1 {{ request('district') == $district->slug ? 'bg-gray-600 text-white' : ''}}">
                                {{ $district->title }}
                            </li>
                        </a>
                    @endforeach
                </ul>
            </aside>

            {{-- основное содержимое --}}
            <div class="w-3/4">
                @if($spaces->count() > 0)
                    <div class="flex flex-wrap ">
                        @foreach($spaces as $space)
                            @include('spaces._space_card', ['space' => $space])
                        @endforeach
                    </div>
                @else
                    <p class="mt-4">Места пока не добавлены.</p>
                @endif
            </div>
        </div>
        <div class="mt-8">
            {{ $spaces->links() }}
        </div>
    </div>

</x-app-layout>
