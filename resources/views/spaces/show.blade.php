<x-app-layout>
    <x-slot name="title">
        <div class="flex justify-between">
            <h1 class="lg:text-4xl text-xl font-bold">{{ $space->title }}</h1>
            <div class="flex gap-2">
                @auth
                    @if(Auth::user()->is_admin)
                        <a href="{{ route('spaces.edit', $space) }}">
                            <x-primary-button>редактировать место</x-primary-button>
                        </a>
                        <form action="{{ route('spaces.delete', $space) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <x-primary-button type="submit"
                                              onclick="return confirm('Вы уверены, что хотите удалить это место?')">
                                удалить место
                            </x-primary-button>
                        </form>
                    @endif
                @endif
            </div>
        </div>
    </x-slot>


    <div class="container mx-auto p-4 sm:p-6 lg:p-8">
        <div class="flex lg:flex-nowrap flex-wrap gap-6 mb-6">

            {{-- BLOCK IMAGE --}}
            <div class="lg:w-2/3 w-full">
                <div class="mb-4 h-[600px]">
                    @if ($space->images->isNOtEmpty())
                        <img id="main-image" src="{{ asset('storage/' . $space->images->first()->path) }}"
                             alt="{{ $space->title }}"
                             class="w-full h-full object-cover overflow-hidden rounded-lg shadow-md">
                    @else
                        <div class="w-full h-full bg-gray-200 flex items-center justify-center rounded-lg shadow-md">
                            <span class="text-gray-500">Нет изображения</span>
                        </div>
                    @endif
                </div>
                <div class="grid grid-cols-5 gap-2">
                    @if($space->images)
                        @foreach($space->images as $image)
                            <img src="{{ asset ('storage/' . $image->path) }}" alt="{{ $space->title }}"
                                 class="w-full h-20 object-cover rounded cursor-pointer thumbnail"
                                 onclick="changeImage(this.src)">
                        @endforeach
                    @endif
                </div>
            </div>
            {{-- END BLOCK IMAGE --}}

            {{-- BLOCK MAIN CONTENT --}}
            <div class="lg:w-1/3 w-full">
                <div class="border p-4 rounded-lg">
                    <p class="mb-2"><strong>Адрес:</strong>
                        {{ $space->address }}
                    </p>
                    <p class="mb-2"><strong>Телефон:</strong> {{ $space->phone }}</p>
                    <p class="mb-2"><strong>Веб-сайт:</strong>
                        <a href="{{ $space->website }}" target="_blank" class="text-blue-500 hover:underline">
                            {{ $space->website }}
                        </a>
                    </p>
                    <p class="mb-2"><strong>Почта:</strong>
                        <a href="mailto:{{ $space->email }}" class="text-blue-500 hover:underline">
                            {{ $space->email }}
                        </a>
                    </p>
                    <p class="mb-2"><strong>Геолокация:</strong>
                        <a href="https://www.yandex.ru/maps/?ll={{ $space->longitude }},{{ $space->latitude }}&z=14"
                           target="_blank" class="text-blue-500">
                            {{ $space->latitude }}, {{ $space->longitude }}
                        </a>
                    </p>
                    <p class="mb-2"><strong>Район:</strong> {{ $space->district->title }}</p>
                </div>
            </div>
        </div>
        {{-- END BLOCK MAIN CONTENT --}}

        {{-- BLOCK DESCRIPTION --}}
        <div class="py-2">
            <div class="mb-8 shadow px-2 py-4">
                <h2 class="text-xl font-bold pb-6">Описание</h2>
                <p class="">{{ $space->description }}</p>
            </div>
            <div class="mb-8 shadow px-2 py-4">
                <h2 class="text-xl font-bold pb-6">Как проехать</h2>
                <p class="">{{ $space->how_to_get }}</p>
            </div>
        </div>
        {{-- END BLOCK DESCRIPTION --}}

        {{-- BLOCK MAP --}}
        <div id="map" class="h-[400px]"></div>
        {{-- END BLOCK MAP --}}
    </div>

    <script src="https://api-maps.yandex.ru/v3/?apikey={{ config('app.map_key') }}&lang=ru_RU"></script>

    <script>
        function changeImage(src) {
            document.getElementById('main-image').src = src;

            // Обновляем активную миниатюру
            const thumbnails = document.getElementsByClassName('thumbnail');
            for (let thumb of thumbnails) {
                thumb.classList.remove('active');
                if (thumb.src === src) {
                    thumb.classList.add('active');
                }
            }
        }
    </script>

    <script>
        initMap();

        async function initMap() {
            await ymaps3.ready;

            const {YMap, YMapDefaultSchemeLayer, YMapDefaultFeaturesLayer, YMapMarker} = ymaps3;
            const {YMapDefaultMarker} = await ymaps3.import('@yandex/ymaps3-markers@0.0.1');

            const map = new YMap(
                document.getElementById('map'),
                {
                    location: {
                        center: [{{ $space->longitude }}, {{ $space->latitude }}],
                        // center: [107.640243, 51.804262],
                        zoom: 17
                    }
                }
            );

            map.addChild(new YMapDefaultSchemeLayer());
            map.addChild(new YMapDefaultFeaturesLayer());

            // Инициализируйте маркер
            const marker = new YMapDefaultMarker(
                {
                    coordinates: [{{ $space->longitude }}, {{ $space->latitude }}],
                    // coordinates: [107.640243, 51.804262],
                    draggable: false
                }
            );

            map.addChild(marker);
        }
    </script>

    <style>
        .thumbnail.active {
            border: 2px solid #3490dc;
        }
    </style>
</x-app-layout>
