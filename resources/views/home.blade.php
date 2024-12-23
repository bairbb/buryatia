<x-app-layout>
    <x-slot name="title">
        <h2 class="lg:text-2xl text-xl font-bold">
            {{ __('Главная') }}
        </h2>
    </x-slot>

    <section class="max-h-[38rem] overflow-hidden rounded-b-3xl">
        <img src="{{ asset('storage/images/mainbg.jpg') }}" alt="main_banner" class="object-cover object-bottom h-auto w-full">
    </section>

    <div class="container mx-auto p-4 sm:px-6 lg:px-8 mt-6">
        <div class="flex flex-col mt-10">
            <div class="flex justify-between">
                <h3 class="font-bold text-xl">Недавно добавленные</h3>
                <a href="{{ route('spaces.index') }}" class="text-sm border border-gray-300 p-2 rounded hover:border-indigo-700 hover:bg-indigo-700 hover:text-white">Все места</a>
            </div>
            <div class="mt-8">
                <div class="flex flex-wrap">
                    @foreach($spaces as $space)
                        <div class="lg:w-1/4 md:w-1/2 w-full lg:p-2 p-3">
                            <a href="{{ route('spaces.show', $space->slug) }}" class="block h-full">
                                <div class="bg-white rounded-lg shadow-md overflow-hidden h-full flex flex-col transition duration-300 ease-in-out transform hover:scale-105 hover:shadow-lg">
                                    @if($space->images->isNOtEmpty())
                                        <img src="{{ asset('storage/' . $space->images->first()->path) }}" class="w-full h-60 object-cover"
                                             alt="{{ $space->title }}">
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
                    @endforeach
                </div>
            </div>
        </div>

        <div class="mt-24  lg:px-36 px-4">
            <div class="flex gap-12 items-center">
                <div class="flex flex-col lg:w-1/2 gap-8">
                    <h3 class="font-bold text-xl">О Бурятии</h3>
                    <p>Бурятия - удивительный регион России, расположенный в Восточной Сибири у подножия величественных Саянских гор и на берегу священного озера Байкал. Это земля контрастов, где древняя культура бурятского народа переплетается с природной красотой, создавая уникальный мир, полный загадок и открытий.</p>
                    <div class="">
                        <a href="{{ route('about') }}" class="text-sm border border-gray-300 p-3 rounded hover:border-indigo-700 hover:bg-indigo-700 hover:text-white">
                            Читать далее
                        </a>
                    </div>
                </div>
                <div class="max-h-[30rem] lg:w-1/2 lg:block overflow-hidden hidden">
                    <img src="{{ asset('storage/images/motherburyatia.jpg') }}" alt="" class="object-contain h-auto w-full">
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
