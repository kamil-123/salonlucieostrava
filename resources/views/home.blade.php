@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">

        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <p class="card-text">You are logged in!</p>
                    <form  class="btn btn-default" action="{{ route('logout') }}" method="POST" >
                        @csrf
                        <input type="submit" value="Logout">
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Your Schedule</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <p class="card-text">Schedule of this week</p>
                    <p>test: {{$dates}} </p>
                    <ul>
                        @foreach ($stylist as $date => $schedule)
                            <li>{{}}</li>
                        @endforeach
                    </ul>

                    </p>
                </div>
            </div>      
        </div>
        
    </div>
</div>
@endsection
