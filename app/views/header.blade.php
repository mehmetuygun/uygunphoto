<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>{{ trans('project.name') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{ HTML::style('bootstrap/css/bootstrap.min.css') }}
    {{ HTML::style('css/style.css') }}
    {{ HTML::style('css/font-awesome.min.css') }}
    {{ HTML::style('css/bootstrap-social.css') }}
    @if (isset($css))
        @foreach ($css as $key)
            {{HTML::style($key)}}
        @endforeach
    @endif
</head>
<body>
    <div id="wrap">
        <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="{{url()}}">{{ trans('project.name') }}</a>
                </div>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav pull-right">
                        @if (Auth::check()) 
                        <li>
                            <a href="#" data-toggle="modal" data-target="#myModal">{{ trans('general.upload') }}</a>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <span class="glyphicon glyphicon-user"></span>
                                {{ Auth::user()->first_name }} {{ Auth::user()->last_name }} 
                                <b class="caret"></b>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a href="#">{{ trans('general.profile') }}</a></li>
                                <li class="divider"></li>
                                <li><a href="#">{{ trans('general.logout') }}</a></li>
                            </ul>
                        </li>
                        @else 
                        <li><a href="{{ url('register') }}">{{ trans('general.register') }}</a></li>
                        <li><a href="{{ url('login') }}">{{ trans('general.login') }}</a></li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
        <div id="content" class="container">
