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
                        <a href="{{ route('manage.statistics.export') }}" class="btn btn-primary" target="_blank">
                            {{ trans('pages.manage.statistics.download-csv') }}
                        </a>
                        <h2>
                            {{ trans('pages.manage.statistics.users') }}
                            <span class="badge">{{ $users }}</span>
                        </h2>

                        <table class="table table-striped table-hover table-condensed">
                            <caption></caption>
                            <tbody>
                                <tr>
                                    <td>{{ trans('pages.manage.statistics.blocked-users') }}</td>
                                    <td>{{ $blockedUsers }}</td>
                                </tr>
                                <tr>
                                    <td>{{ trans('pages.manage.statistics.unverified-users') }}</td>
                                    <td>{{ $unverifiedUsers }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div>
                        <h2>
                            {{ trans('pages.manage.statistics.activities') }}
                            <span class="badge">{{ $activities }}</span>
                        </h2>

                        <table class="table table-striped table-hover table-condensed">
                            <caption>{{ trans('pages.manage.statistics.captions.activities-by-zoo') }}</caption>
                            <tbody>
                                @foreach ($zooOptions as $key => $title)
                                    <tr>
                                        <td>{{ $title }}</td>
                                        <td>{{ $activitiesByZoo->has($key) ? $activitiesByZoo->get($key)->count : 0 }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <table class="table table-striped table-hover table-condensed">
                            <caption>{{ trans('pages.manage.statistics.captions.activities-by-language') }}</caption>
                            <tbody>
                                @foreach ($languageOptions as $key => $title)
                                    <tr>
                                        <td>{{ $title }}</td>
                                        <td>{{ $activitiesByLanguage->has($key) ? $activitiesByLanguage->get($key)->count : 0 }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div>
                        <h2>
                            {{ trans('pages.manage.statistics.activity-items') }}
                            <span class="badge">{{ $activityItems }}</span>
                        </h2>

                        <table class="table table-striped table-hover table-condensed">
                            <caption>{{ trans('pages.manage.statistics.captions.activity-items-by-language') }}</caption>
                            <tbody>
                                @foreach ($zooOptions as $key => $title)
                                    <tr>
                                        <td>{{ $title }}</td>
                                        <td>{{ $activityItemsByZoo->has($key) ? $activityItemsByZoo->get($key)->count : 0 }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

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
                    </div>

                    <div>
                        <h2>
                            {{ trans('pages.manage.statistics.discount-vouchers') }}
                            <span class="badge">{{ $discountVouchers }}</span>
                        </h2>

                        <table class="table table-striped table-hover table-condensed">
                            <tbody>
                                <tr>
                                    <th>{{ trans('pages.manage.statistics.columns.discount-vouchers-total') }}</th>
                                    <th>{{ trans('general.discount-voucher-status.active') }}</th>
                                    <th>{{ trans('general.discount-voucher-status.inactive') }}</th>
                                    <th>{{ trans('pages.manage.statistics.columns.discount-vouchers-redeemed') }}</th>
                                </tr>
                                <tr>
                                    <td>{{ $discountVouchers }}</td>
                                    <td>{{ $discountVouchersByStatus->has(1) ? $discountVouchersByStatus->get(1)->count : 0 }}</td>
                                    <td>{{ $discountVouchersByStatus->has(0) ? $discountVouchersByStatus->get(0)->count : 0 }}</td>
                                    <td>{{ $discountVouchersRedeemed }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
