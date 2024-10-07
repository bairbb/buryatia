<x-app-layout>
  <x-slot name="header">
    <h1 class="text-4xl font-bold">{{ $space->title }}</h1>
  </x-slot>


  <div class="container mx-auto px-4 sm:px-6 lg:p-8">
    <div class="flex gap-6 mb-12">

      {{-- BLOCK IMAGE --}}
      <div class="w-2/3">
        <div class="mb-4">
          @if ($space->images->isNOtEmpty())
          <img id="main-image" src="{{ asset($space->images->first()->path) }}" alt="{{ $space->title }}"
            class="w-full h-auto rounded-lg shadow-md">
          @else
          <div class="w-full h-96 bg-gray-200 flex items-center justify-center">
            <span class="text-gray-500">Нет изображения</span>
          </div>
          @endif
        </div>
        <div class="grid grid-cols-5 gap-2">
          @if($space->images)
          @foreach($space->images as $image)
          <img src="{{ $image->path }}" alt="{{ $space->title }}"
            class="w-full h-20 object-cover rounded cursor-pointer thumbnail" onclick="changeImage(this.src)">
          @endforeach
          @endif
        </div>
      </div>
      {{-- END BLOCK IMAGE --}}

      {{-- BLOCK MAIN CONTENT --}}
      <div class="w-1/3">
        <div class="border p-4 rounded-lg">
          <p class="mb-2"><strong>Адрес:</strong> {{ $space->address }}</p>
          <p class="mb-2"><strong>Телефон:</strong> {{ $space->phone }}</p>
          <p class="mb-2"><strong>Веб-сайт:</strong> <a href="{{ $space->website }}"
              class="text-blue-500 hover:underline">{{ $space->website }}</a></p>
          <p class="mb-2"><strong>Почта:</strong> <a href="mailto:{{ $space->email }}"
              class="text-blue-500 hover:underline">{{ $space->email }}</a></p>
          <p class="mb-2"><strong>Геолокация:</strong>
            <a href="https://www.yandex.ru/maps/?ll={{ $space->latitude }},{{ $space->longitude }}&z=14" target="_blank" class="text-blue-500">
              {{ $space->latitude }}, {{ $space->longitude }}
            </a>
          </p>
          <p class="mb-2"><strong>Район:</strong> {{ $space->district->title }}</p>
        </div>
      </div>
    </div>
    {{-- END BLOCK MAIN CONTENT --}}

    {{-- BLOCK DESCRIPTION --}}
    <div class="py-4">
      <div class="mb-12 shadow px-2 py-4">
        <h2 class="text-xl font-bold pb-6">Описание</h2>
        <p class="">{{ $space->description }}</p>
      </div>
      <div class="mb-12 shadow px-2 py-4">
        <h2 class="text-xl font-bold pb-6">Как проехать</h2>
        <p class="">{{ $space->how_to_get }}</p>
      </div>
    </div>
    {{-- END BLOCK DESCRIPTION --}}

    {{-- BLOCK MAP --}}
    <div id="map" class="h-96"></div>
    {{-- END BLOCK MAP --}}

    {{-- <div class="mt-8">
      @can('update', $space)
      <a href="{{ route('spaces.edit', $space) }}"
        class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 mr-2">Редактировать</a>
      @endcan

      @can('delete', $space)
      <form action="{{ route('spaces.destroy', $space) }}" method="POST" class="inline">
        @csrf
        @method('DELETE')
        <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded-md hover:bg-red-600"
          onclick="return confirm('Вы уверены, что хотите удалить это пространство?')">Удалить</button>
      </form>
      @endcan
    </div> --}}
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
            // center: [{{ $space->latitude }}, {{ $space->longitude }}],
            center: [107.640243, 51.804262],
            zoom: 17
          }
        }
      );

      map.addChild(new YMapDefaultSchemeLayer());
      map.addChild(new YMapDefaultFeaturesLayer());

      // Инициализируйте маркер
      const marker = new YMapDefaultMarker(
        {
          // coordinates: [{{ $space->latitude }}, {{ $space->longitude }}],
          coordinates: [107.640243, 51.804262],
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

    #map {
      margin: 0;
      /* width: 100%; */
      /* height: 100%; */
    }
  </style>
</x-app-layout>
