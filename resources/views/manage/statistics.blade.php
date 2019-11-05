@extends('layouts.app')

@section('content')
<div class="container" id="monitoring-vue-container">
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
                            <a href="#" id="toggle-tasks">
                                <span class="name show-pie hidden">Show pie</span>
                                <span class="name show-table">Show table</span>
                            </a>
                        </h2>

                        <table id="tasks-table" class="table table-striped table-hover table-condensed hidden">
                            <caption>{{ trans('pages.manage.statistics.captions.activity-items-by-question-type') }}</caption>
                            <tbody>
                                @php
                                    $tasksPieChartData = [];
                                    $tasksPieChartLabels = [];
                                @endphp
                                @foreach ($questionTypeOptions as $key => $title)
                                    @php
                                        $activityItem = $activityItemsByType->has($key) ? $activityItemsByType->get($key) : null;
                                        $count = $activityItem !== null ? $activityItem->count : 0;
                                        $time = $activityItem !== null ? $activityItem->time : 0;
                                        $tasksPieChartData[] = $count;
                                        $tasksPieChartLabels[] = $title;
                                    @endphp
                                    <tr>
                                        <td>{{ $title }}</td>
                                        <td>{{ $count }}</td>
                                        <td>{{ $time }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <div id="tasks-pie-chart-container">
                            <pie-chart class="tasks-pie-chart"
                                       labels='{!! json_encode($tasksPieChartLabels) !!}'
                                       data="{!! json_encode($tasksPieChartData) !!}"
                            ></pie-chart>
                        </div>

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
                            {{ trans('pages.manage.statistics.top-games') }}
                        </h2>

                        <table class="table table-striped table-hover table-condensed">
                            <tbody>
                                @foreach($topGames as $game)
                                    <tr>
                                        <td>{{ $game->rnk }}</td>
                                        <td>{{ $game->title }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
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
        #toggle-tasks {
            font-size: 14px;
            color: #FFFFFF;
            background: #3097D1;
            padding: 4px 10px;
            border-radius: 6px;
            float: right;
            text-decoration: none;
        }
    </style>
@endsection

@section('footer-scripts')
    <script>
        var map;
        var markers = [];
        var infoWindow = null;


        function initMap() {
            map = new google.maps.Map(document.getElementById('map'), {
                center: {lat: -34.397, lng: 150.644},
                zoom: 10
            });
            infoWindow = new google.maps.InfoWindow({
                disableAutoPan: true
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
                marker.addListener('click', function () {
                    if ( infoWindow && infoWindow.getMap() ) {
                        infoWindow.close();
                    }
                    infoWindow.setContent(this.title);
                    infoWindow.open(map, this);
                });
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
                scale: 8.5,
                strokeColor: 'black',
                strokeWeight: 0.5
            });

            return marker;
        }

        setTimeout(function () {
            $('#toggle-tasks').on('click', function (e) {

                e.preventDefault();
                console.log('olemas');
                $(this).find('.name').each(function () {
                    console.log('leitud');
                    if ($(this).hasClass('hidden')) {
                        $(this).removeClass('hidden');
                    } else {
                        $(this).addClass('hidden');
                        if ($(this).hasClass('show-pie')) {
                            $('#tasks-pie-chart-container').removeClass('hidden');
                            $('#tasks-table').addClass('hidden');
                        } else {
                            $('#tasks-table').removeClass('hidden');
                            $('#tasks-pie-chart-container').addClass('hidden');
                        }
                    }
                });

                return false;
            });
        }, 500);

    </script>

    <script src="{{ elixir('js/statistics.js') }}"></script>

    <script
            src="https://maps.googleapis.com/maps/api/js?key={{ config('services.maps.google.api_key') }}&callback=initMap"
            async defer
    ></script>
@endsection