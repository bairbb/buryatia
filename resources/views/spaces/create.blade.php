<x-app-layout>
  <x-slot name="header">
    <h1 class="text-4xl font-bold">Добавить новое место</h1>
  </x-slot>

  <div class="container mx-auto px-4 sm:px-6 lg:px-8">
    <div class="py-10">
      <form action="{{ route('spaces.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="">
          <x-input-label for="title" :value="__('Название места')" />
          <x-text-input id="title" class="block mt-2 w-full" type="text" name="title" required />
          {{-- <x-input-error :messages="$errors->get('email')" class="mt-2" /> --}}
        </div>
        <div class="mt-5">
          <x-input-label for="district" :value="__('Район')" />
          <select name="district" id="district"
            class="block mt-2 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
            required>
            <option>Выберите район</option>
            @foreach ($districts as $district)
              <option value="{{ $district->id }}">{{ $district->title }}</option>
            @endforeach
          </select>
        </div>
        <div class="mt-5">
          <x-input-label for="description" :value="__('Описание')" />
          <textarea id="description"
            class="block mt-2 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
            type="textarea" rows="3" name="description" required></textarea>
          {{-- <x-input-error :messages="$errors->get('email')" class="mt-2" /> --}}
        </div>
        <div class="mt-5">
          <x-input-label for="how_to_get" :value="__('Как проехать')" />
          <textarea id="how_to_get"
            class="block mt-2 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
            type="textarea" rows="3" name="how_to_get" required></textarea>
          {{--
          <x-input-error :messages="$errors->get('email')" class="mt-2" /> --}}
        </div>
        <div class="mt-5">
          <x-input-label for="address" :value="__('Адрес')" />
          <x-text-input id="address" class="block mt-2 w-full" type="text" name="address" required />
          {{--
          <x-input-error :messages="$errors->get('email')" class="mt-2" /> --}}
        </div>
        <div class="mt-5">
          <x-input-label for="phone" :value="__('Телефон')" />
          <x-text-input id="phone" class="block mt-2 w-full" type="tel" name="phone" required />
          {{--
          <x-input-error :messages="$errors->get('email')" class="mt-2" /> --}}
        </div>
        <div class="mt-5">
          <x-input-label for="email" :value="__('Почта')" />
          <x-text-input id="email" class="block mt-2 w-full" type="email" name="email" required />
          {{--
          <x-input-error :messages="$errors->get('email')" class="mt-2" /> --}}
        </div>
        <div class="mt-5">
          <x-input-label for="website" :value="__('Сайт')" />
          <x-text-input id="website" class="block mt-2 w-full" type="url" name="website" required />
          {{--
          <x-input-error :messages="$errors->get('email')" class="mt-2" /> --}}
        </div>
        <fieldset class="flex gap-4 mt-5 border border-gray-300 p-4 rounded-md">
          <legend class="text-lg font-medium text-gray-700">Геолокация</legend>
          <div class="w-1/2">
            <x-input-label for="latitude" :value="__('Широта')" />
            <x-text-input id="latitude" class="block mt-2 w-full" type="text" name="latitude" required />
          </div>
          <div class="w-1/2">
            <x-input-label for="longitude" :value="__('Долгота')" />
            <x-text-input id="longitude" class="block mt-2 w-full" type="text" name="longitude" required />
          </div>
        </fieldset>
        <div class="mt-5">
          <x-input-label for="images" :value="__('Загрузить изображения')" />
          <x-text-input id="images" class="block mt-2 w-full" type="file" name="images[]" multiple required/>
          {{--
          <x-input-error :messages="$errors->get('email')" class="mt-2" /> --}}
        </div>
        <div class="flex justify-end mt-5">
          <x-primary-button class="">
            Сохранить
          </x-primary-button>
        </div>
      </form>
    </div>
  </div>
</x-app-layout>