<x-layouts.app>

    <x-slot:introduction_text>
        <p><img src="img/afbl_logo.png" align="right" width="100" height="100">{{ __('introduction_texts.homepage_line_1') }}</p>
        <p>{{ __('introduction_texts.homepage_line_2') }}</p>
        <p>{{ __('introduction_texts.homepage_line_3') }}</p>
    </x-slot:introduction_text>

    @isset($topManuals)
        <h2>{{ __('Top 10 most popular manuals') }}</h2>
        <ul>
            @foreach($topManuals as $m)
                <li>
                    <a href="/{{ $m->brand->id }}/{{ $m->brand->getNameUrlEncodedAttribute() }}/{{ $m->id }}/">
                        {{ $m->brand->name }}: {{ $m->name }}
                    </a>
                </li>
            @endforeach
        </ul>
    @endisset

    <h1>
        <x-slot:title>
            {{ __('misc.all_brands') }}
        </x-slot:title>
    </h1>

    <nav class="az-menu" aria-label="Brands A–Z">
        @php
            $letters = range('A','Z');
            // Determine which letters exist in dataset
            $present = $brands->map(fn($b) => strtoupper(substr($b->name,0,1)))->unique()->toArray();
        @endphp
        @foreach($letters as $L)
            @if(in_array($L, $present))
                <a href="/{{ $L }}" class="az-item">{{ $L }}</a>
            @else
                <span class="az-item az-disabled">{{ $L }}</span>
            @endif
        @endforeach
    </nav>


    <?php
    $size = count($brands);
    $columns = 3;
    $chunk_size = ceil($size / $columns);
    ?>

    <div class="container">
        <!-- Example row of columns -->
        <div class="row">

            @foreach($brands->chunk($chunk_size) as $chunk)
                <div class="col-md-4">

                    <ul>
                        @foreach($chunk as $brand)

                            <?php
                            $current_first_letter = strtoupper(substr($brand->name, 0, 1));

                            if (!isset($header_first_letter) || (isset($header_first_letter) && $current_first_letter != $header_first_letter)) {
                                echo '</ul>
                        <h2>' . $current_first_letter . '</h2>
                        <ul>';
                            }
                            $header_first_letter = $current_first_letter
                            ?>

                            <li>
                                <a href="/{{ $brand->id }}/{{ $brand->getNameUrlEncodedAttribute() }}/">{{ $brand->name }}</a>
                            </li>
                        @endforeach
                    </ul>

                </div>
                <?php
                unset($header_first_letter);
                ?>
            @endforeach

        </div>

    </div>
</x-layouts.app>
