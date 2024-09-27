<x-app-layout>
  <x-slot name="header">
    <h1 class="text-4xl font-bold">{{ $space->title }}</h1>
  </x-slot>


  <div class="container mx-auto px-4 sm:px-6 lg:p-8">

    <div class="flex gap-6">
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
          {{-- <img src="{{ asset($space->images->first()->path) }}" alt="{{ $space->title }}"
            class="w-full h-20 object-cover rounded cursor-pointer thumbnail active" onclick="changeImage(this.src)"> --}}
          @if($space->images)
            @foreach($space->images as $image)
              <img src="{{ $image->path }}" alt="Фото пространства" class="w-full h-20 object-cover rounded cursor-pointer thumbnail" onclick="changeImage(this.src)">
            @endforeach
          @endif
        </div>
      </div>
      <div class="w-1/3">
        <p class="mb-2"><strong>Район:</strong> {{ $space->district->title }}</p>
        <p class="mb-2"><strong>Адрес:</strong> {{ $space->address }}</p>
        <p class="mb-2"><strong>Телефон:</strong> {{ $space->phone }}</p>
        <p class="mb-2"><strong>Веб-сайт:</strong> <a href="{{ $space->website }}" class="text-blue-500 hover:underline">{{ $space->website }}</a></p>
        <p class="mb-2"><strong>Описание:</strong> {{ $space->description }}</p>
        <p class="mb-2"><strong>Как добраться:</strong> {{ $space->how_to_get }}</p>
      </div>
    </div>

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
