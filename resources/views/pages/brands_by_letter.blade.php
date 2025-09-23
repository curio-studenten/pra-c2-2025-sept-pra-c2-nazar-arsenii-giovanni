<x-layouts.app>

    <x-slot:breadcrumb>
        <li><a href="/" title="{{ __('misc.home_alt') }}">{{ __('misc.home') }}</a></li>
        <li>{{ $letter }}</li>
    </x-slot:breadcrumb>

    <h1>{{ __('misc.all_brands') }} — {{ $letter }}</h1>

    <nav class="az-menu" aria-label="Brands A–Z">
        @php $letters = range('A','Z'); @endphp
        @foreach($letters as $L)
            @if(in_array($L, $present))
                <a href="/{{ $L }}" class="az-item">{{ $L }}</a>
            @else
                <span class="az-item az-disabled">{{ $L }}</span>
            @endif
        @endforeach
        <a href="/" class="az-item" style="margin-left:auto">{{ __('misc.home') }}</a>
    </nav>

    @if($brands->isEmpty())
        <p>{{ __('No brands found for letter') }} {{ $letter }}</p>
    @else
        <ul>
            @foreach($brands as $brand)
                <li><a href="/{{ $brand->id }}/{{ $brand->getNameUrlEncodedAttribute() }}/">{{ $brand->name }}</a></li>
            @endforeach
        </ul>
    @endif

</x-layouts.app>
