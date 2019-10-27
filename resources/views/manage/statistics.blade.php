@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('pages.manage.statistics.heading') }}
                </div>

                <div class="panel-body">

                    <div>
                        <h2>
                            {{ trans('pages.manage.statistics.activity-items') }}
                            <span class="badge">{{ $activityItems }}</span>
                        </h2>

                        <table class="table table-striped table-hover table-condensed">
                            <caption>{{ trans('pages.manage.statistics.captions.activity-items-by-question-type') }}</caption>
                            <tbody>
                                @foreach ($questionTypeOptions as $key => $title)
                                    <tr>
                                        <td>{{ $title }}</td>
                                        <td>{{ $activityItemsByType->has($key) ? $activityItemsByType->get($key)->count : 0 }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <table class="table table-striped table-hover table-condensed">
                            <caption>{{ trans('pages.manage.statistics.captions.activity-items-by-language') }}</caption>
                            <tbody>
                                @foreach ($languageOptions as $key => $title)
                                    <tr>
                                        <td>{{ $title }}</td>
                                        <td>{{ $activityItemsByLanguage->has($key) ? $activityItemsByLanguage->get($key)->count : 0 }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div>
                        <h2>
                            {{ trans('pages.manage.statistics.games') }}
                            <span class="badge">{{ $games }}</span>
                        </h2>

                        <table class="table table-striped table-hover table-condensed">
                            <caption>{{ trans('pages.manage.statistics.captions.games-by-status') }}</caption>
                            <tbody>
                                <tr>
                                    <td>{{ trans('general.activity-status.complete') }}</td>
                                    <td>{{ $gamesByStatus->has(1) ? $gamesByStatus->get(1)->count : 0 }}</td>
                                </tr>
                                <tr>
                                    <td>{{ trans('general.activity-status.ongoing') }}</td>
                                    <td>{{ $gamesByStatus->has(0) ? $gamesByStatus->get(0)->count : 0 }}</td>
                                </tr>
                            </tbody>
                        </table>

                        <div id="map"></div>
                    </div>

                    <div>
                        <h2>
                            {{ trans('pages.manage.statistics.users') }}
                        </h2>

                        <div id="google-analytics-line-graph">

                            <select class="form-control" v-on:change="onTypeChange">
                                <option value="last-week">{{ trans('pages.manage.statistics.last-week') }}</option>
                                <option value="last-month">{{ trans('pages.manage.statistics.last-month') }}</option>
                                <option value="max">{{ trans('pages.manage.statistics.max') }}</option>
                            </select>
                            <line-chart class="line-chart line-chart-max" type="max"></line-chart>
                            <line-chart class="line-chart line-chart-last-month" type="last-month"></line-chart>
                            <line-chart class="line-chart line-chart-last-week" type="last-week"></line-chart>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('header-styles')
    <style>
        #map {
            height: 500px;
        }
        #google-analytics-line-graph {
            position: relative;
            display: block;
            overflow: hidden;
            height: 440px;
            background-color: #ffffff;
        }
        #google-analytics-line-graph .line-chart {
            height: 400px;
            width: 100%;
            position: absolute;
            top: 40px;
        }
    </style>
@endsection

@section('footer-scripts')
    <script>
        var map;
        var markers = [];


        function initMap() {
            map = new google.maps.Map(document.getElementById('map'), {
                center: {lat: -34.397, lng: 150.644},
                zoom: 10
            });

            var averagePositionsOfGames = {!! $averagePositionsOfGames !!};
            var averagePositionsOfGamesLength = averagePositionsOfGames.length;
            for (var i=0; i<averagePositionsOfGamesLength; i++) {
                var averagePositionsOfGame = averagePositionsOfGames[i];
                var marker = getNewMarker(
                    averagePositionsOfGame.title,
                    averagePositionsOfGame.latitude,
                    averagePositionsOfGame.longitude
                )
                markers.push(marker);
                map.setCenter(new google.maps.LatLng(
                    averagePositionsOfGame.latitude,
                    averagePositionsOfGame.longitude
                ));
            }
        }

        function getNewMarker(title, latitude, longitude) {
            var marker = new google.maps.Marker({
                title: title,
                position: {
                    lat: Number(latitude),
                    lng: Number(longitude)
                },
                map: map,
                animation: google.maps.Animation.DROP
            });

            marker.setIcon({
                path: google.maps.SymbolPath.CIRCLE,
                fillColor: 'red',
                fillOpacity: 1.0,
                scale: 4.5,
                strokeColor: 'red',
                strokeWeight: 0.5
            });

            return marker;
        }

    </script>

    <script src="{{ elixir('js/statistics.js') }}"></script>

    <script
            src="https://maps.googleapis.com/maps/api/js?key={{ config('services.maps.google.api_key') }}&callback=initMap"
            async defer
    ></script>
@endsection