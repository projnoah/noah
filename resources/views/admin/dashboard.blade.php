@extends('layouts.admin-app')

@section('title', trans('views.admin.titles.dashboard'))

@section('breadcrumb')
    <li class="active">@trans('views.admin.titles.dashboard')</li>
@stop

@section('app-content')
    <script>
        var visitorsData = JSON.parse("{!! addslashes(json_encode(Stat::visitorsStats())) !!}");
    </script>
    <div class="row">
        <div class="col-lg-3 col-md-6">
            <div class="panel info-box panel-white">
                <div class="panel-body">
                    <div class="info-box-stats">
                        <p class="counter">{{  $newUsers = Stat::newUsers('this_month') }}</p>
                        <span class="info-box-title">@trans('views.admin.pages.dashboard.new-users-this-month')</span>
                    </div>
                    <div class="info-box-icon">
                        <i class="icon-users"></i>
                    </div>
                    <div class="info-box-progress">
                        <div class="progress progress-xs progress-squared bs-n">
                            <div class="progress-bar progress-bar-success" role="progressbar" style="width: @stat('newUsersRatio', $newUsers)%">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="panel info-box panel-white">
                <div class="panel-body">
                    <div class="info-box-stats">
                        <p class="counter">{{ $pageViews = Stat::pageViews('this_month') }}</p>
                        <span class="info-box-title">@trans('views.admin.pages.dashboard.page-views-this-month')</span>
                    </div>
                    <div class="info-box-icon">
                        <i class="icon-eye"></i>
                    </div>
                    <div class="info-box-progress">
                        <div class="progress progress-xs progress-squared bs-n">
                            <div class="progress-bar progress-bar-info" role="progressbar" style="width: @stat('pageViewsRatio', $pageViews)%">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="panel info-box panel-white">
                <div class="panel-body">
                    <div class="info-box-stats">
                        <p><span class="counter">@stat('uniqueIPs', 'today')</span></p>
                        <span class="info-box-title">@trans('views.admin.pages.dashboard.unique-ips-today')</span>
                    </div>
                    <div class="info-box-icon">
                        <i class="icon-globe-alt"></i>
                    </div>
                    <div class="info-box-progress">
                        <div class="progress progress-xs progress-squared bs-n">
                            <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="100"
                                 aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="panel info-box panel-white">
                <div class="panel-body">
                    <div class="info-box-stats">
                        <p class="counter">@stat('uniqueVisitors', 'today')</p>
                        <span class="info-box-title">@trans('views.admin.pages.dashboard.unique-visitors-today')</span>
                    </div>
                    <div class="info-box-icon">
                        <i class="icon-target"></i>
                    </div>
                    <div class="info-box-progress">
                        <div class="progress progress-xs progress-squared bs-n">
                            <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="100"
                                 aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- Row -->
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-white">
                <div class="row">
                    <div class="col-md-6">
                        <div class="visitors-chart">
                            <div class="panel-heading">
                                <h4 class="panel-title">@trans('views.admin.pages.dashboard.visitors')</h4>
                            </div>
                            <div class="panel-body">
                                <div id="visitor-chart"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="stats-info visitors-chart">
                            <div class="panel-heading">
                                <h4 class="panel-title">@trans('views.admin.pages.dashboard.browser-stats')</h4>
                            </div>
                            <div class="panel-body">
                                <ul class="list-unstyled">
                                    @foreach(Stat::getTopFive('browser') as $browser)
                                        <li>
                                            <b><i class="fa fa-{{ str_slug($browser->name) }}"></i>&nbsp;{{ $browser->name }}</b>
                                            <div class="text-success pull-right">{{ $browser->ratio }}%<i class="icon-graph"></i></div>
                                            <div class="clearfix">
                                                <div class="progress progress-xs bs-n m-t-xs m-b-xs">
                                                    <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="{{ $browser->ratio }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ $browser->ratio }}%"></div>
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="stats-info">
                            <div class="panel-heading">
                                <h4 class="panel-title">@trans('views.admin.pages.dashboard.city-stats')</h4>
                            </div>
                            <div class="panel-body">
                                <ul class="list-unstyled">
                                    @foreach(Stat::getTopFive('city') as $city)
                                        <li>
                                            <b><i class="{{ str_slug($city->name) }}"></i>&nbsp;{{ Location::cityName($city->name) }}</b>
                                            <div class="text-info pull-right">{{ $city->ratio }}%</div>
                                            <div class="clearfix">
                                                <div class="progress progress-xs bs-n m-t-xs m-b-xs">
                                                    <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="{{ $city->ratio }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ $city->ratio }}%"></div>
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            @include('admin.center.stats.uri')
        </div>
        <div class="col-md-6">
            <div class="panel panel-white">
                <div class="panel-heading">
                    <h4 class="panel-title">Weather</h4>
                </div>
                <div class="panel-body">
                    <div class="weather-widget">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="weather-top">
                                    <div class="weather-current pull-left">
                                        <i class="wi wi-day-cloudy weather-icon"></i>
                                        <p><span>83<sup>&deg;F</sup></span></p>
                                    </div>
                                    <h2 class="weather-day pull-right">Miami, FL<br>
                                        <small><b>13th April, 2015</b></small>
                                    </h2>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <ul class="list-unstyled weather-info">
                                    <li>Wind <span class="pull-right"><b>ESE 16 mph</b></span></li>
                                    <li>Humidity <span class="pull-right"><b>64%</b></span></li>
                                    <li>Pressure <span class="pull-right"><b>30.15 in</b></span></li>
                                    <li>UV Index <span class="pull-right"><b>6</b></span></li>
                                </ul>
                            </div>
                            <div class="col-md-6">
                                <ul class="list-unstyled weather-info">
                                    <li>Cloud Cover <span class="pull-right"><b>60%</b></span></li>
                                    <li>Ceiling <span class="pull-right"><b>17800 ft</b></span></li>
                                    <li>Dew Point <span class="pull-right"><b>70° F</b></span></li>
                                    <li>Visibility <span class="pull-right"><b>10 mi</b></span></li>
                                </ul>
                            </div>
                            <div class="col-md-12">
                                <ul class="list-unstyled weather-days row">
                                    <li class="col-xs-4 col-sm-2"><span>12:00</span><i
                                                class="wi wi-day-cloudy"></i><span>82<sup>&deg;F</sup></span></li>
                                    <li class="col-xs-4 col-sm-2"><span>13:00</span><i
                                                class="wi wi-day-cloudy"></i><span>82<sup>&deg;F</sup></span></li>
                                    <li class="col-xs-4 col-sm-2"><span>14:00</span><i
                                                class="wi wi-day-cloudy"></i><span>82<sup>&deg;F</sup></span></li>
                                    <li class="col-xs-4 col-sm-2"><span>15:00</span><i
                                                class="wi wi-day-cloudy"></i><span>83<sup>&deg;F</sup></span></li>
                                    <li class="col-xs-4 col-sm-2"><span>16:00</span><i
                                                class="wi wi-day-cloudy"></i><span>82<sup>&deg;F</sup></span></li>
                                    <li class="col-xs-4 col-sm-2"><span>17:00</span><i
                                                class="wi wi-day-sunny-overcast"></i><span>82<sup>&deg;F</sup></span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@push('scripts.footer')
<script src="/assets/js/admin/pages/dashboard.js" pjax-script></script>
@endpush