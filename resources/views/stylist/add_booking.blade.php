@extends('layouts.app')

@section('head')

    {{-- <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet"> --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>

@endsection 

@section('content')

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
                <label for="datepicker">Date</label>
                <input class="date form-control"  
                  type="text" 
                  id="datepicker" 
                  name="date"
                  value={{date('Y-m-d')}}
                >
              </div>
            </div>

            {{-- Time  --}}
            <div class="row">
              <div class="form-group col-md-4">
                <label for="time">Starting Time</label>
                <select class="form-control" id="time" name='time'>
                  @foreach ($timeSlotTemplate as $timeslot)
                    <option value={{ $timeslot }}>{{ $timeslot }}</option>
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

@endsection

@section('script')
  <script type="text/javascript">
    $('#datepicker').datepicker({
        autoclose: true,
        format: 'yyyy-mm-dd'
    });
    
  </script>
@endsection
