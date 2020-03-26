@extends('layouts.app')

@section('content')
<div class='container'>
  <div class='row justify-content-center'>

    <div class='col-md-8'>
      <div class='card'>
        <div class='card-header'>Edit Booking</div>
        <div class='card-body'>
          {{-- <h4>title</h4> --}}
          {{-- <p class='card-text'>text </p> --}}
          <form action='{{ action('BookingViewController@edit') }}' method='POST'>
            @csrf
            @method('PUT')
            <input name="first_name">
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection