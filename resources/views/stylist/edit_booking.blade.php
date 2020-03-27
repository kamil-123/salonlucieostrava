@extends('layouts.app')

@section('head')

    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
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
        <div class='card-body'>
          <form action={{ action('BookingViewController@edit', [ 'id' => $id ]) }} method='POST'>
            @csrf
            @method('PUT')

            @if (\Session::has('success'))
              <div class="alert alert-success">
                <p>{{ \Session::get('success') }}</p>
              </div><br />
            @endif

                  <div class="row">
                    <div class="col-md-4"></div>
                    <div class="form-group col-md-4">
                      <strong>Date : </strong>
                      <input class="date form-control"  type="text" id="datepicker" name="date">
                   </div>
                  </div>
                  <div class="row">
                    <div class="col-md-4"></div>
                    <div class="form-group col-md-4" style="margin-top:60px">
                      <button type="submit" class="btn btn-success">Submit</button>
                    </div>
                  </div>

            {{-- Names --}}
            <div class="form-row">
              <div class="col">
                <label for="first_name">First Name</label>
                <input id='first_name' type="text" class="form-control" placeholder="First name">
              </div>
              <div class="col">
                <label for="last_name">Last Name</label>
                <input id='last_name' type="text" class="form-control" placeholder="Last name">
              </div>
            </div>
            
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  $('#datepicker').datepicker({
      autoclose: true,
      format: 'yyyy-mm-dd'
   });
</script>

@endsection