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
                        <li><a href="{{url('/admin/user')}}"><i class="glyphicon glyphicon-user"></i> Users</a></li>
                        <li><a href="{{url('/admin/comment')}}"><i class="glyphicon glyphicon-comment"></i> Comments</a></li>
                        <li><a href="{{url('/admin/comment')}}"><i class="glyphicon glyphicon-picture"></i> Images</a></li>
                        <li><a href="#"><i class="glyphicon glyphicon-wrench"></i> System</a></li>                       
                    </ul>
                    <ul class="nav navbar-nav pull-right">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <span class="glyphicon glyphicon-user"></span>
                                {{ Auth::user()->first_name }} {{ Auth::user()->last_name }} 
                                <b class="caret"></b>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a href="#">{{ trans('admin.setting') }}</a></li>
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