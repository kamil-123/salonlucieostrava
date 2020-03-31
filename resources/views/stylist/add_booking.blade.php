<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Salon Lucie Ostrava') }}</title>

     <!-- Scripts -->
     <script src="{{ asset('js/appl.js') }}"></script>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('/css/app.css') }}" type="text/css">

    {{-- DateTime picker --}}
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    {{-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> --}}
    <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
    {{-- <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" /> --}}

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
                        @if (Auth::user()->stylist !== null)
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('treatmentindex') }}">{{ __('Treatments') }}</a>
                            </li>
                        @endif
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

        <div class='container'>
          <div class='row justify-content-center'>
            <div class='col-md-8'>
              <div class='card'>
                <div class='card-header'>New Booking</div>
                <div class='card-body justify-content-left'>
                  <form action={{ action('BookingViewController@store') }} method='POST'>
                    @csrf

                    @if (\Session::has('success'))
                      <div class="alert alert-success">
                        <p>{{ \Session::get('success') }}</p>
                      </div><br />
                    @endif


                    {{-- Dates --}}
                    <div class="row">
                      <div class="form-group col-md-4">
                        <label for="date">Date</label>
                        <input id="datepicker" width="276" />
                      </div>
                    </div>

                    {{-- Time  --}}
                    <div class="row">
                      <div class="form-group col-md-4">
                        <label for="time">Starting Time</label>
                        <select class="form-control" id="time" name='time'>
                          @foreach ($timeSlotTemplate as $slotTemplate)
                            @if ($timeslot === $slotTemplate)
                              <option selected value={{ $slotTemplate }}>{{ $slotTemplate }}</option>
                            @else
                              <option value={{ $slotTemplate }}>{{ $slotTemplate }}</option>
                            @endif
                          @endforeach
                        </select> 
                      </div>
                    </div>
                    

                    {{-- Treatment  --}}
                    <div class="row">
                      <div class="form-group col-md-8">
                        <label for="treatment">Treatment</label>
                        <select class="form-control" id="treatment" name='treatment'>
                          @foreach ($treatments as $treatment)
                              <option value={{ $treatment->id }}>{{ $treatment->name }}</option>
                          @endforeach

                        </select>
                      </div>
                    </div>

                    {{-- Names --}}
                    <div class="row mb-4">
                      <div class="col">
                        <label for="first_name">First Name</label>
                        <input id='first_name' name ='first_name' type="text" class="form-control" placeholder='First name'>
                      </div>
                      <div class="col">
                        <label for="last_name">Last Name</label>
                        <input id='last_name' name='last_name' type="text" class="form-control" placeholder='Last name'>
                      </div>
                    </div>

                    {{-- Phone --}}
                    <div class="row">
                      <div class="form-group col-md-8">
                        <label for="phone_number">Phone</label>
                        <input id='phone_number' name='phone' type="tel" class="form-control" placeholder='Phone number'>
                      </div>
                    </div>

                    {{-- Email --}}
                    <div class="row">
                      <div class="form-group col-md-8">
                        <label for="email_address">Email</label>
                        <input id='email_address' name='email' type="email" class="form-control" placeholder='Email address'>
                      </div>
                    </div>
                    

                    {{-- Submit --}}
                    <div class="row">
                      <div class="col-md-4 d-flex"></div>
                      <div class="form-group col-md-4 d-flex"  style="margin-top:60px">
                        <input 
                          type="submit"
                          class="btn btn-success mx-auto"
                          action=action()
                          value="Book"
                        >
                      </div>
                    </div>

                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
    <script>
      $('#datepicker').datepicker({
          uiLibrary: 'bootstrap4'
      });
    </script>

    </div>
  </body>
  </html>
  


            

