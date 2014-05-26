<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>{{ trans('project.name') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{ HTML::style('bootstrap/css/bootstrap.min.css') }}
    {{ HTML::style('css/admin.css') }}
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
                    <ul class="nav navbar-nav">
                        <li><a href="{{url('/admin/user')}}"><i class="glyphicon glyphicon-user"></i> {{ trans('admin.users') }}</a></li>
                        <li><a href="{{url('/admin/comment')}}"><i class="glyphicon glyphicon-comment"></i> {{ trans('admin.comments') }}</a></li>
                        <li><a href="{{url('/admin/photo')}}"><i class="glyphicon glyphicon-picture"></i> {{ trans('admin.photos') }}</a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="glyphicon glyphicon-wrench"></i> {{ trans('admin.component') }}</a>
                            <ul class="dropdown-menu">
                                <li><a href="{{url('admin/component/panel')}}">{{ trans('admin.panel') }}</a></li>
                            </ul>
                        </li>                       
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="glyphicon glyphicon-wrench"></i> {{ trans('admin.system') }}</a>
                            <ul class="dropdown-menu">
                                <li><a href="{{url('admin/system/configuration')}}">{{ trans('admin.configuration') }}</a></li>
                                <li class="divider"></li>
                                <li><a href="{{ url('/admin/help') }}">{{ trans('admin.help') }}</a></li>
                            </ul>
                        </li>                           
                    </ul>
                    <ul class="nav navbar-nav pull-right">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <span class="glyphicon glyphicon-user"></span>
                                {{ Auth::user()->first_name }} {{ Auth::user()->last_name }} 
                                <b class="caret"></b>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a href="{{url('admin/user/profile')}}">{{ trans('admin.edit_profile') }}</a></li>
                                <li><a href="{{url('admin/user/password')}}">{{ trans('admin.change_password') }}</a></li>
                                <li class="divider"></li>
                                <li><a href="{{ url('/admin/logout') }}">{{ trans('admin.logout') }}</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div id="content" class="container">
        <div class="alert" style="display: none">
            <strong class="alert-title">Message:</strong> <span class="alert-body">Your changes has been updated.</span>
        </div>
        @if(isset($is_message) && $is_message)
            <div class="alert {{$alert_type}}">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <strong>{{ $alert_name }}:</strong> {{ $alert_message }}
            </div>
        @endif