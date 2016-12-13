<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>WE Distribution</title>
    <link type="text/css" rel="stylesheet" href="../../../css/bootstrap.min.css">
    <link type="text/css" rel="stylesheet" href="../../../css/custom.css">
</head>
<body>
<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#mobile">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a href="#" class="navbar-brand">WE Distribution</a>
        </div>
        <div class="collapse navbar-collapse" id="mobile">
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        Moe Kyaw
                        <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu" id="dropdown-menu">
                        <li><a href="#"><span class="glyphicon glyphicon-off"></span>Log Out</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
            <div class="row" id="circle-person">
                <div class="avatar">
                    <span class="glyphicon glyphicon-user"></span>
                </div>
                <div id="person-admin">
                    <span>Mg Mg</span>
                    <span>admin</span>
                </div>
            </div>
            <div class="row" id="dashboard">
                <span>Dashboard</span>
            </div>
            <div class="row" id="nav-side">
                <ul class="nav">
                    <li><a href="{{route('book_panel') }}"><span class="glyphicon glyphicon-book"></span>Book</a></li>
                    <li><a href="{{route('e_book_panel') }}"><span class="glyphicon glyphicon-book"></span>E-Book</a></li>
                   <li><a href="{{route('cover_image') }}"><span class="glyphicon glyphicon-book"></span>Cover Image</a></li>
                    <li><a href="{{route('comment_panel')}}"><span class="glyphicon glyphicon-comment"></span>Comment</a></li>
                    <li><a href="{{route('e_comment_panel')}}"><span class="glyphicon glyphicon-comment"></span>E Book Comment</a></li>
                    <li><a href="{{route('order_panel') }}"><span class="glyphicon glyphicon-list-alt"></span>Order List</a></li>
                    <li><a href="{{route('admin_panel') }}"><span class="glyphicon glyphicon-user"></span>Admin</a></li>
                    <li><a href="{{route('pos_panel') }}"><span class="glyphicon glyphicon-tags"></span>POS</a></li>
                    <li><a href="{{route('logout') }}"><span class="glyphicon glyphicon-off"></span>Logout</a></li>
                </ul>
            </div>
        </div>
       
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
            @yield('content')
        </div>
</div>

</div>
@yield('script')

</body>
</html>