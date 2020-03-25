@extends('layouts.calendarTemplate')

@section('content')
<div class="container">
    <div class="row justify-content-center">

        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Monthly Calendar</div>
                
                <div class="card-body">
                  {{-- LINKS --}}
                  <div class='row links'>
                    <span class='link-left col'><a href=#>back</a></span>
                    <span class='link-right col'><a href=#>next</a></span>
                  </div>

                  {{-- CALENDAR --}}
                  <h3>{{ date('F') }}</h3>
                  <p class='year'>{{ date('Y') }}</p>
                      <div class="calendar" data-toggle="calendar">
                        <div class="row">
                          <div class="col calendar-week">
                            <div>Mon</div>
                          </div>
                          <div class="col calendar-week">
                            <div>Tue</div>
                          </div>
                          <div class="col calendar-week">
                            <div>Wed</div>
                          </div>
                          <div class="col calendar-week">
                            <div>Thu</div>
                          </div>
                          <div class="col calendar-week">
                            <div>Fri</div>
                          </div>
                          <div class="col calendar-week">
                            <div>Sat</div>
                          </div>
                          <div class="col calendar-week">
                            <div>Sun</div>
                          </div>
                        </div>
                        
                        @foreach($date_list as $day)
                            @if( $day['weekday'] === '1' ) {{-- Monday--}}
                              <div class="row">
                                @if( $day['month'] !== date('m') )
                                  <div class='col calendar-day calendar-no-current-month'>
                                @else
                                  <div class='col calendar-day'>
                                @endif
                                    <time datetime="{{ $day['full'] }}">{{ $day['day'] }}</time>
                                  </div>
                            @elseif( $day['weekday'] === '0' ) {{-- Sunday --}}
                                @if( $day['month'] !== date('m') )
                                  <div class='col calendar-day calendar-no-current-month'>
                                @else
                                  <div class='col calendar-day'>
                                @endif
                                  <time datetime="{{ $day['full'] }}">{{ $day['day'] }}</time>
                                </div>
                              </div>
                            @else    {{-- Other Days --}}
                              @if( $day['month'] !== date('m') )
                                <div class='col calendar-day calendar-no-current-month'>
                              @else
                                <div class='col calendar-day'>
                              @endif
                                  <time datetime="{{ $day['full'] }}">{{ $day['day'] }}</time>
                                </div>
                            @endif

                        @endforeach
                        
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
