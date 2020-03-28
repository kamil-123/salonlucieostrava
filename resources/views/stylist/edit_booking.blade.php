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
        <div class='card-header'>Edit Booking</div>
        <div class='card-body justify-content-left'>
          <form action={{ action('BookingViewController@update', [ 'id' => $id ]) }} method='POST'>
            @csrf
            @method('PUT')

            @if (\Session::has('success'))
              <div class="alert alert-success">
                <p>{{ \Session::get('success') }}</p>
              </div><br />
            @endif

            {{-- Hidden --}}
            <input type='hidden'  name='customer_id' value= {{ $booking->customer_id }}>

            {{-- Dates --}}
            <div class="row">
              <div class="form-group col-md-4">
                <label for="datepicker">Date</label>
                <input class="date form-control"  
                  type="text" 
                  id="datepicker" 
                  name="date"
                  value={{$date}}
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
                    @if ($treatment->id === $booking->treatment_id)
                      <option value={{ $treatment->id}} selected>{{ $treatment->name }}</option>
                    @else
                      <option value={{ $treatment->id}}>{{ $treatment->name }}</option>
                    @endif
                  @endforeach

                </select>
              </div>
            </div>

            {{-- Names --}}
            <div class="row mb-4">
              <div class="col">
                <label for="first_name">First Name</label>
                <input id='first_name' type="text" class="form-control" value={{ $booking->customer->first_name }}>
              </div>
              <div class="col">
                <label for="last_name">Last Name</label>
                <input id='last_name' type="text" class="form-control" value={{ $booking->customer->last_name }}>
              </div>
            </div>

            {{-- Phone --}}
            <div class="row">
              <div class="form-group col-md-8">
                <label for="phone_number">Phone</label>
                <input id='phone_number' type="tel" class="form-control" value={{ $booking->customer->phone }}>
              </div>
            </div>

            {{-- Email --}}
            <div class="row">
              <div class="form-group col-md-8">
                <label for="email_address">Email</label>
                <input id='email_address' type="email" class="form-control" value={{ $booking->customer->email }}>
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
                  value="Submit the Change"
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
