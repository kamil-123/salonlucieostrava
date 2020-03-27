@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">Confirmation</div>
          <div class="card-body">
            <p class="card-text">Are you sure to delete the following booking?</p>
            <div class="card">
              <ul class >
                <li>Date : {{ $date }}</li>
                <li>Time : {{ $time }}</li>
                <li>Customer : {{ $booking->customer->first_name }} {{$booking->customer->last_name }}</li>

              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection