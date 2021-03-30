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