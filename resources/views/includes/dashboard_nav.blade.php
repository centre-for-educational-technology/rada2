@php ( $nav = [ [ 'key' => 'dashboard', 'route' => 'dashboard', 'trans' => 'pages.dashboard.title', ], ])

@can('viewResultsList', 'App\Activity')
    @php ( $nav[]= [ 'key' => 'results', 'route' => 'results', 'trans' => 'pages.activity-results-index.title', ])
@endcan

<ul class="nav nav-tabs">
    @foreach( $nav as $single )
        <li role="presentation" class="{{ $activeTab === $single['key'] ? 'active' : '' }}">
            <a href="{!! route($single['route']) !!}">{{ trans($single['trans']) }}</a>
        </li>
    @endforeach
</ul>
