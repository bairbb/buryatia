<div class="w-1/3 p-2">
  <a href="{{ route('spaces.show', $space->slug) }}" class="block h-full">
    <div
      class="bg-white rounded-lg shadow-md overflow-hidden h-full flex flex-col transition duration-300 ease-in-out transform hover:scale-105 hover:shadow-lg">
      @if($space->images->isNOtEmpty())
        <img src="{{ asset($space->images->first()->path) }}" class="w-full h-60 object-cover" alt="{{ $space->title }}">
      @else
        <div class="w-full h-60 bg-gray-200 flex items-center justify-center">
          <span class="text-gray-500">Нет изображения</span>
        </div>
      @endif
      <div class="p-4 flex-grow">
        <h5 class="font-bold text-lg mb-2 truncate">{{ $space->title }}</h5>
        <p class="text-gray-600 text-sm truncate">{{ $space->district->title }}</p>
      </div>
    </div>
  </a>
</div>
