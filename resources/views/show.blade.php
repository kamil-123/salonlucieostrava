@extends('layouts.app')

@section('content')
<div class='container'>
    <div class='row justify-content-center'>

        <div class='col-md-8'>
            <div class='card'>
                <div class='card-header'>Booking Details</div>
                <div class='card-body'>
                <h4>{{ date('d-m-Y') }}</h4>
                <p class='card-text'> </p>

                  <ul class='list-group list-group-flush'>
                    <ul class='list-group'>
                      <li class='list-group-item'>
                        <img class='mr-3' src='{{ asset('/images/icons/clock.png') }}' alt='time' style='width:1.3rem' >
                        {{ $time }}
                      </li>
                      <li class='list-group-item'>
                        <img class='mr-3' src='{{ asset('/images/icons/scissor.png') }}' alt='time' style='width:1.3rem' >
                        {{ $booking->treatment_id }}
                      </li>
                      <li class='list-group-item'>
                        <img class='mr-3' src='{{ asset('/images/icons/user.png') }}' alt='time' style='width:1.3rem' >
                        {{ $booking->customer_id }}
                      </li>
                      <li class='list-group-item'>
                        <img class='mr-3' src='{{ asset('/images/icons/phone.png') }}' alt='time' style='width:1.3rem' >
                        {{ $booking->customer_id }}
                      </li>
                      <li class='list-group-item'>
                        <img class='mr-3' src='{{ asset('/images/icons/mail.png') }}' alt='time' style='width:1.3rem' >
                        {{ $booking->customer_id }}
                      </li>
                    </ul>
                  </ul>
                  


                </div>
            </div>
        </div>
    </div>
</div>
@endsection
                