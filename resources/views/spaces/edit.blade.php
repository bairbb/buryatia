<x-app-layout>
    <x-slot name="title">
        <h1 class="text-4xl font-bold">Редактировать место</h1>
    </x-slot>

    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="py-10">
            <form action="{{ route('spaces.update', $space) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('Patch')
                <div class="">
                    <x-input-label for="title" :value="__('Название места')"/>
                    <x-text-input id="title" class="block mt-2 w-full" type="text" name="title"
                                  value="{{ old('title', $space->title) }}" required/>
                    <x-input-error :messages="$errors->get('title')" class="mt-2" />
                </div>
                <div class="mt-5">
                    <x-input-label for="district" :value="__('Район')"/>
                    <select name="district" id="district"
                            class="block mt-2 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                            required>
                        @foreach ($districts as $district)
                            <option value="{{ $district->id }}" {{ $space->district == $district ? 'selected' : '' }}>{{ $district->title }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mt-5">
                    <x-input-label for="description" :value="__('Описание')"/>
                    <textarea id="description"
                              class="block mt-2 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                              type="textarea" rows="3" name="description">{{ old('description', trim($space->description)) }}</textarea>
                    <x-input-error :messages="$errors->get('description')" class="mt-2" />
                </div>
                <div class="mt-5">
                    <x-input-label for="how_to_get" :value="__('Как проехать')"/>
                    <textarea id="how_to_get"
                              class="block mt-2 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                              type="textarea" rows="3" name="how_to_get">{{ old('how_to_get', $space->how_to_get) }}</textarea>
                    <x-input-error :messages="$errors->get('how_to_get')" class="mt-2" />
                </div>
                <div class="mt-5">
                    <x-input-label for="address" :value="__('Адрес')"/>
                    <x-text-input id="address" class="block mt-2 w-full" type="text" name="address"
                                  value="{{ old('address', $space->address) }}"/>
                    <x-input-error :messages="$errors->get('address')" class="mt-2" />
                </div>
                <div class="mt-5">
                    <x-input-label for="phone" :value="__('Телефон')"/>
                    <x-text-input id="phone" class="block mt-2 w-full" type="tel" name="phone"
                                  value="{{ old('phone', $space->phone) }}"/>
                    <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                </div>
                <div class="mt-5">
                    <x-input-label for="email" :value="__('Почта')"/>
                    <x-text-input id="email" class="block mt-2 w-full" type="email" name="email"
                                  value="{{ old('email', $space->email) }}"/>
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>
                <div class="mt-5">
                    <x-input-label for="website" :value="__('Сайт')"/>
                    <x-text-input id="website" class="block mt-2 w-full" type="url" name="website"
                                  value="{{ old('website', $space->website) }}"/>
                    <x-input-error :messages="$errors->get('website')" class="mt-2" />
                </div>
                <fieldset class="flex gap-4 mt-5 border border-gray-300 p-4 rounded-md">
                    <legend class="text-lg font-medium text-gray-700">Геолокация</legend>
                    <div class="w-1/2">
                        <x-input-label for="latitude" :value="__('Широта')"/>
                        <x-text-input id="latitude" class="block mt-2 w-full" type="text" name="latitude"
                                      value="{{ old('latitude', $space->latitude) }}"/>
                        <x-input-error :messages="$errors->get('latitude')" class="mt-2" />
                    </div>
                    <div class="w-1/2">
                        <x-input-label for="longitude" :value="__('Долгота')"/>
                        <x-text-input id="longitude" class="block mt-2 w-full" type="text" name="longitude"
                                      value="{{ old('longitude', $space->longitude) }}"/>
                        <x-input-error :messages="$errors->get('longitude')" class="mt-2" />
                    </div>
                </fieldset>
                <div class="mt-5">
                    <x-input-label for="images" :value="__('Загрузить изображения')"/>
                    <x-text-input id="images" class="block mt-2 w-full" type="file" name="images[]" multiple/>
                    <x-input-error :messages="$errors->get('images')" class="mt-2" />
                </div>
                <div class="flex justify-end mt-5">
                    <x-primary-button class="">
                        Обновить
                    </x-primary-button>
                </div>
            </form>
            <div class="flex flex-wrap gap-8 mt-5">
                @if($space->images)
                    @foreach($space->images as $image)
                        <div class="flex flex-col gap-2">
                            <img src="{{ asset ('storage/' . $image->path) }}" alt="{{ $space->title }}"
                                 class="w-40 h-40 object-cover rounded cursor-pointer thumbnail">
                            <form action="{{ route('images.delete', $image) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <x-secondary-button type="submit" onclick="return confirm('Вы уверены, что хотите удалить это изображение?')">
                                    удалить
                                </x-secondary-button>
                            </form>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
