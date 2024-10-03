<x-app-layout>
  <x-slot name="header">
    <h1 class="text-4xl font-bold">{{ $space->title }}</h1>
  </x-slot>


  <div class="container mx-auto px-4 sm:px-6 lg:p-8">
    <div class="flex gap-6">

      {{-- BLOCK IMAGE --}}
      <div class="w-2/3">
        <div class="mb-4">
          @if ($space->images->isNOtEmpty())
            <img id="main-image" src="{{ asset($space->images->first()->path) }}" alt="{{ $space->title }}" class="w-full h-auto rounded-lg shadow-md">
          @else
            <div class="w-full h-96 bg-gray-200 flex items-center justify-center">
              <span class="text-gray-500">Нет изображения</span>
            </div>
          @endif
        </div>
        <div class="grid grid-cols-5 gap-2">
          @if($space->images)
            @foreach($space->images as $image)
              <img src="{{ $image->path }}" alt="{{ $space->title }}" class="w-full h-20 object-cover rounded cursor-pointer thumbnail" onclick="changeImage(this.src)">
            @endforeach
          @endif
        </div>
      </div>
      {{-- END BLOCK IMAGE --}}

      {{-- BLOCK MAIN CONTENT  --}}
      <div class="w-1/3">
        <div class="border p-4 rounded-lg">
          <p class="mb-2"><strong>Адрес:</strong> {{ $space->address }}</p>
          <p class="mb-2"><strong>Телефон:</strong> {{ $space->phone }}</p>
          <p class="mb-2"><strong>Веб-сайт:</strong> <a href="{{ $space->website }}" class="text-blue-500 hover:underline">{{ $space->website }}</a></p>
          <p class="mb-2"><strong>Почта:</strong> <a href="mailto:{{ $space->email }}" class="text-blue-500 hover:underline">{{ $space->email }}</a></p>
          <p class="mb-2"><strong>Геолокация:</strong>
            <a href="https://www.yandex.ru/maps/?ll={{ $space->longitude }},{{ $space->latitude }}&z=14" target="_blank" class="text-blue-500">
              {{ $space->longitude }},{{ $space->latitude }}
            </a>
          </p>
          <p class="mb-2"><strong>Район:</strong> {{ $space->district->title }}</p>
        </div>
      </div>
    </div>
    {{-- END BLOCK MAIN CONTENT --}}

    {{-- BLOCK DESCRIPTION --}}
    <div class="mt-8 py-4">
      <div class="mb-8">
        <h2 class="text-xl pb-8">Описание</h2>
        <p class="">{{ $space->description }}</p>
      </div>
      <div class="mb-8">
        <h2 class="text-xl pb-8">Как проехать</h2>
        <p class="">{{ $space->how_to_get }}</p>
      </div>
    </div>

    <div class="tabs flex flex-col w-full md:w-[360px]">
      <!-- tabs header -->
      <div class="relative flex flex-row items-center">
        <button data-type="tabs" data-target="#tab-4"
          class="active w-1/3 md:w-[120px] h-16 px-4 flex flex-col justify-end items-center gap-1 relative py-2 hover:bg-surface-100 dark:hover:bg-surfacedark-100">
          <span class="material-symbols-outlined">music_note</span>
          <p class="text-sm tracking-[.00714em]">Music</p>
        </button>
        <button data-type="tabs" data-target="#tab-5"
          class="w-1/3 md:w-[120px] h-16 px-4 flex flex-col justify-end items-center gap-1 relative py-2 hover:bg-surface-100 dark:hover:bg-surfacedark-100">
          <span class="material-symbols-outlined">image</span>
          <p class="text-sm tracking-[.00714em]">Photos</p>
        </button>
        <button data-type="tabs" data-target="#tab-6"
          class="w-1/3 md:w-[120px] h-16 px-4 flex flex-col justify-end items-center gap-1 relative py-2 hover:bg-surface-100 dark:hover:bg-surfacedark-100">
          <span class="material-symbols-outlined">videocam</span>
          <p class="text-sm tracking-[.00714em]">Video</p>
        </button>
        <!-- indicator -->
        <div role="indicator"
          class="absolute left-0 bottom-0 transition-all duration-200 ease-in-out bg-primary-600 dark:bg-primary-200 w-1/3 md:w-[120px] h-0.5 rounded-t-full">
        </div>
      </div>
      <hr class="border-gray-200 dark:border-gray-700">
      <!-- tabs content -->
      <div class="flex flex-col">
        <div id="tab-4" role="tabpanel" class="active [&.active]:block hidden py-4 transition duration-400 ease-in-out">
          <h3>Tabs content 1</h3>
        </div>
        <div id="tab-5" role="tabpanel" class="[&.active]:block hidden py-4 transition duration-400 ease-in-out">
          <h3>Tabs content 2</h3>
        </div>
        <div id="tab-6" role="tabpanel" class="[&.active]:block hidden py-4 transition duration-400 ease-in-out">
          <h3>Tabs content 3</h3>
        </div>
      </div>
    </div>
    {{-- END BLOCK DESCRIPTION --}}

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

  <style>
    .thumbnail.active {
      border: 2px solid #3490dc;
    }
  </style>
</x-app-layout>
