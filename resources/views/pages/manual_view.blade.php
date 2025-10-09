<x-layouts.app>

    <x-slot:head>
        <meta name="robots" content="index, nofollow">
    </x-slot:head>

    <x-slot:breadcrumb>
        <li><a href="/{{ $brand->id }}/{{ $brand->getNameUrlEncodedAttribute() }}/" alt="Manuals for '{{$brand->name}}'" title="Manuals for '{{$brand->name}}'">{{ $brand->name }}</a></li>
        <li><a href="/{{ $brand->id }}/{{ $brand->getNameUrlEncodedAttribute() }}/{{ $manual->id }}/" alt="View manual for '{{$brand->name}}'" title="View manual for '{{$brand->name}}'">{{ $manual->name }}</a></li>
    </x-slot:breadcrumb>

    <h1>{{ $brand->name }} - {{ $manual->name }}</h1>

    @if (!empty($manual->url))
        <a href="{{ $manual->url }}" target="_blank" rel="noopener" title="Download your manual here">Click here to download the manual</a>
    @else
        <p>Download link is not available for this manual.</p>
    @endif

    <div style="margin-top: 20px;">
        <button id="shortLinkBtn" onclick="getShortLink()" style="padding: 10px 20px; cursor: pointer;">
            Korte link opvragen
        </button>
        <div id="shortLinkResult" style="margin-top: 10px;"></div>
    </div>

    <script>
        function getShortLink() {
            const url = '/{{ $brand->id }}/{{ $brand->getNameUrlEncodedAttribute() }}/{{ $manual->id }}/short-link';
            console.log('Calling URL:', url);
            
            fetch(url)
                .then(response => {
                    console.log('Response status:', response.status);
                    if (!response.ok) {
                        throw new Error('HTTP ' + response.status);
                    }
                    return response.json();
                })
                .then(data => {
                    console.log('Response data:', data);
                    document.getElementById('shortLinkResult').innerHTML = 
                        '<strong>Korte link:</strong> <a href="' + data.short_url + '" target="_blank">' + data.short_url + '</a>';
                })
                .catch(error => {
                    console.error('Error:', error);
                    document.getElementById('shortLinkResult').innerHTML = 
                        '<span style="color: red;">Error generating short link: ' + error.message + '</span>';
                });
        }
    </script>

</x-layouts.app>
