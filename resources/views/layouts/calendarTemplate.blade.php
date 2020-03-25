<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Salon Lucie Ostrava') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    {{-- <link href="{{ asset('sass/app.css') }}" rel="stylesheet" type="text/css"> --}}
    <link rel="stylesheet" href="{{ mix('/css/app.css') }}" type="text/css">

    <style>
          body {
						padding: 20px 0px 200px;
					}
					h3 {
						margin-top: 1rem;
						margin-left: 1rem;
					}
					.year {
						font-family: 'Roboto', sans-serif;
						font-size: 0.9rem;
						margin-left: 1rem;
					}
					.links {
						margin: 0;
					}
					.link-left {
						text-align: left;
					}
					.link-right {
						text-align: right;
					}
					.calendar {
						margin: 2rem;
					}
					/* .popover.calendar-event-popover {
						font-family: 'Roboto', sans-serif;
						font-size: 12px;
						color: rgb(120, 120, 120);
						border-radius: 2px;
						max-width: 300px;
					}
					.popover.calendar-event-popover h4 {
						font-size: 14px;
						font-weight: 900;
					}
					.popover.calendar-event-popover .location,
					.popover.calendar-event-popover .datetime {
						font-size: 14px;
						font-weight: 700;
						margin-bottom: 5px;
					}
					.popover.calendar-event-popover .location > span,
					.popover.calendar-event-popover .datetime > span {
						margin-right: 10px;
					}
					.popover.calendar-event-popover .space,
					.popover.calendar-event-popover .attending {
						margin-top: 10px;
						padding-bottom: 5px;
						border-bottom: 1px solid rgb(160, 160, 160);
						font-weight: 700;
					}
					.popover.calendar-event-popover .space > .pull-right,
					.popover.calendar-event-popover .attending > .pull-right {
						font-weight: 400;
					}
					.popover.calendar-event-popover .attending {
						margin-top: 5px;
						font-size: 18px;
						padding: 0px 10px 5px;
					}
					.popover.calendar-event-popover .attending img {
						border-radius: 50%;
						width: 40px;
					}
					.popover.calendar-event-popover .attending span.attending-overflow {
						display: inline-block;
						width: 40px;
						background-color: rgb(200, 200, 200);
						border-radius: 50%;
						padding: 8px 0px 7px;
						text-align: center;
					}
					.popover.calendar-event-popover .attending > .pull-right {
						font-size: 28px;
					}
					.popover.calendar-event-popover a.btn {
						margin-top: 10px;
						width: 100%;
						border-radius: 3px;
					} */
					[data-toggle="calendar"] > .row > .calendar-day {
						font-family: 'Roboto', sans-serif;
						width: 14.28571428571429%;
						border: 1px solid rgb(235, 235, 235);
						border-right-width: 0px;
						border-bottom-width: 0px;
						min-height: 120px;
					}
					[data-toggle="calendar"] > .row > .calendar-week {
						font-family: 'Roboto', sans-serif;
						line-height: 3rem;
						text-align: center;
					}
					[data-toggle="calendar"] > .row > .calendar-day.calendar-no-current-month {
						color: rgb(200, 200, 200);
					}
					[data-toggle="calendar"] > .row > .calendar-day:last-child {
						border-right-width: 1px;
					}

					[data-toggle="calendar"] > .row:last-child > .calendar-day {
						border-bottom-width: 1px;
					}
/* 
					.calendar-day > time {
						position: absolute;
						display: block;
						bottom: 0px;
						left: 0px;
						font-size: 12px;
						font-weight: 300;
						width: 100%;
						padding: 10px 10px 3px 0px;
						text-align: right;
					}
					.calendar-day > .events {
						cursor: pointer;
					}
					.calendar-day > .events > .event h4 {
						font-size: 12px;
						font-weight: 700;
						white-space: nowrap;
						overflow: hidden;
						text-overflow: ellipsis;
						margin-bottom: 3px;
					}
					.calendar-day > .events > .event > .desc,
					.calendar-day > .events > .event > .location,
					.calendar-day > .events > .event > .datetime,
					.calendar-day > .events > .event > .attending {
						display: none;
					}
					.calendar-day > .events > .event > .progress {
						height: 10px;
					} */
    </style>

</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Salon Lucie Ostrava') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->first_name }} {{ Auth::user()->last_name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
