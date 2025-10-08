<x-layouts.app>
    <x-slot:title>
        {{ __('misc.all_brands') }}
    </x-slot:title>

    <div class="jumbotron">


        <div class="manuals">
            @foreach($manuals as $manual)
                <div class="manual-item">
                    <h1"//{{ $manual->id }}" title="{{ $manual->name }}">
                        {{ $manual->name }}
                    </h1>
                    <form action="{{ route('delete.destroy', $manual->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="image" class="trash-bin" aria-label="Delete"></button>
                                <p>{{ __('misc.delete') }}</p>

                    </form>
                </div>
            @endforeach
        </div>
    </div>
</x-layouts.app>