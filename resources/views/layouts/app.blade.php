<!DOCTYPE html>
<html lang="en" ng-app="backendApp" ng-cloak>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Richard Quiz</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css" integrity="sha384-XdYbMnZ/QjLh6iI4ogqCTaIjrFk87ip+ekIjefZch0Y+PvJ8CDYtEs1ipDmPorQ+" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700">

    <!-- Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <script src="https://use.fontawesome.com/2b0f0783a8.js"></script>
   <!--  <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> -->

    <style>
        body {
            font-family: 'Lato';
        }

        .fa-btn {
            margin-right: 6px;
        }

        .text-center {
          text-align: center;
        }

        .quote-card {
          background: #fff;
          color: #222222;
          padding: 20px;
          padding-left: 50px;
          box-sizing: border-box;
          box-shadow: 0 2px 4px rgba(34, 34, 34, 0.12);
          position: relative;
          overflow: hidden;
          min-height: 120px;
        }
        .quote-card p {
          font-size: 22px;
          line-height: 1.5;
          margin: 0;
          max-width: 80%;
        }
        .quote-card cite {
          font-size: 16px;
          margin-top: 10px;
          display: block;
          font-weight: 200;
          opacity: 0.8;
        }
        .quote-card:before {
          font-family: Georgia, serif;
          content: "“";
          position: absolute;
          top: 10px;
          left: 10px;
          font-size: 5em;
          color: rgba(238, 238, 238, 0.8);
          font-weight: normal;
        }
        .quote-card:after {
          font-family: Georgia, serif;
          content: "”";
          position: absolute;
          bottom: -110px;
          line-height: 100px;
          right: -32px;
          font-size: 25em;
          color: rgba(238, 238, 238, 0.8);
          font-weight: normal;
        }
        @media (max-width: 640px) {
          .quote-card:after {
            font-size: 22em;
            right: -25px;
          }
        }
        .quote-card.blue-card {
          background: #0078FF;
          color: #ffffff;
          box-shadow: 0 1px 2px rgba(34, 34, 34, 0.12), 0 2px 4px rgba(34, 34, 34, 0.24);
        }
        .quote-card.blue-card:before, .quote-card.blue-card:after {
          color: #5FAAFF;
        }
        .quote-card.green-card {
          background: #00970B;
          color: #ffffff;
          box-shadow: 0 1px 2px rgba(34, 34, 34, 0.12), 0 2px 4px rgba(34, 34, 34, 0.24);
        }
        .quote-card.green-card:before, .quote-card.green-card:after {
          color:#59E063 ;
        }

        .quote-card.red-card {
          background: #F61E32;
          color: #ffffff;
          box-shadow: 0 1px 2px rgba(34, 34, 34, 0.12), 0 2px 4px rgba(34, 34, 34, 0.24);
        }
        .quote-card.red-card:before, .quote-card.red-card:after {
          color:#F65665 ;
        }

        .quote-card.yellow-card {
          background: #F9A825;
          color: #222222;
          box-shadow: 0 1px 2px rgba(34, 34, 34, 0.12), 0 2px 4px rgba(34, 34, 34, 0.24);
        }
        .quote-card.yellow-card:before, .quote-card.yellow-card:after {
          color: #FBC02D;
        }
    </style>
</head>
<body id="app-layout">
    <nav class="navbar navbar-inverse navbar-static-top">
        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ url('/') }}">
                    Richard Quiz
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav" hidden>
                    <li><a href="{{ url('/home') }}">Home</a></li>
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
  <!--                       <li><a href="{{ url('/login') }}">Login</a></li>
                        <li><a href="{{ url('/register') }}">Register</a></li> -->
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    @yield('content')

    <!-- JavaScripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js" integrity="sha384-I6F5OKECLVtK/BL+8iSLDEHowSAfUo76ZL9+kGAgTRdiByINKJaqTPH/QVNS1VDb" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.6.1/angular.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.6.1/angular-route.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.6.1/angular-sanitize.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/1.5.12/clipboard.min.js"></script>
    <script>
    	$(document).ready(function(){
    		var app;
    		var readURL;
    		new Clipboard('.btn');
    		readURL = function(input) {
    		  var reader;
    		  if (input.files && input.files[0]) {
    		    reader = new FileReader;
    		    reader.onload = function(e) {
    		      return $(input).prev().attr('src', e.target.result);
    		    };
    		    return reader.readAsDataURL(input.files[0]);
    		  }
    		};
    		$(document).on('change', '.input-image', function() {
    		  return readURL(this);
    		});
    	});
    </script>
    <script src="{{url("/")}}{{ elixir("js/app.js") }}"></script>
    @yield('scripts')
</body>
</html>
