<x-app-layout>
    <x-slot name="title">
        <h1 class="text-4xl font-bold">Результаты по запросу "{{ $query }}"</h1>
    </x-slot>
    <div class="container mx-auto px-6 mt-8">
        @if($spaces->isNotEmpty())
            <div class="flex flex-wrap ">
                @foreach($spaces as $space)
                    @include('spaces._space_card', ['space' => $space])
                @endforeach
            </div>
        @else
            <p class="mt-8">Нет результатов.</p>
        @endif

        <div class="mt-8 px-2">
            {{ $spaces->links() }}
        </div>
    </div>
</x-app-layout>
