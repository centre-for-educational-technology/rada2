@if ($image->getExternalProvider()['name'] === 'ajapaik')
<a href="{!! 'https://ajapaik.ee/photo/' . $image->getExternalProvider()['id'] !!}"
   target="_blank"
   class="provider-logo{{ (isset($absolute) && $absolute === TRUE) ? ' provider-logo-absolute' : '' }}"
>
    @if( isset($size) && $size)
        <img src="https://ajapaik.ee/static/images/ajapaik_266px.7d65ad54a95f.png" alt="ajapaik-logo" style="width: {{ $size }};">
    @else
        <img src="https://ajapaik.ee/static/images/ajapaik_266px.7d65ad54a95f.png" alt="ajapaik-logo">
    @endif
</a>
@endif

@if ($image->getExternalProvider()['name'] === 'cultural-monuments-registry')
<a href="{!! 'https://register.muinas.ee/public.php?menuID=photolibrary-cmtype-46&action=view&id=' . $image->getExternalProvider()['id'] . '&page=1&filter%5Bcmtype%5D=46' !!}"
   target="_blank"
   class="provider-logo{{ (isset($absolute) && $absolute === TRUE) ? ' provider-logo-absolute' : '' }}"
>
        @if( isset($size) && $size)
                <img src="{{ asset('img/logos/cultural-monuments-registry.png') }}" alt="cultural-monuments-registry-logo" style="width: {{ $size }};">
        @else
                <img src="{{ asset('img/logos/cultural-monuments-registry.png') }}" alt="cultural-monuments-registry-logo">
        @endif
</a>
@endif