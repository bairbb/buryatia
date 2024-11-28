<div class="lg:w-1/3 w-1/2 p-2">
  <a href="{{ route('spaces.show', $space->slug) }}" class="block h-full">
    <div class="bg-white rounded-lg shadow-md overflow-hidden h-full flex flex-col transition duration-300 ease-in-out transform hover:scale-105 hover:shadow-lg">
      @if($space->images->isNOtEmpty())
        <img src="{{ asset('storage/' . $space->images->first()->path) }}" class="w-full h-60 object-cover" alt="{{ $space->title }}">
      @else
        <div class="w-full h-60 bg-gray-200 flex items-center justify-center">
          <span class="text-gray-500">Нет изображения</span>
        </div>
      @endif
      <div class="lg:p-4 p-2 flex-grow">
        <h5 class="font-bold lg:text-base text-sm mb-2 truncate">{{ $space->title }}</h5>
        <p class="text-gray-600 lg:text-sm text-xs truncate">{{ $space->district->title }}</p>
      </div>
    </div>
  </a>
</div>
