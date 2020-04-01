@extends('layouts.app')

@section('head')
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
  } 
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
@endsection





@section('content')
<div class="container">
    <div class="row justify-content-center">

        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Monthly Calendar</div>
                
                <div class="card-body">
                  {{-- LINKS --}}
                  <div class='row links'>
                    <span class='link-left col'><a href={{  route('calendar', ['month' => $month - 1]) }}>back</a></span>

                    <span class='link-right col'><a href={{  route('calendar', ['month' => $month + 1]) }}>next</a></span>
                  </div>

                  {{-- CALENDAR --}}
                  <h3>{{ date('F', mktime(0,0,0, date('m')+$month, 1, date('Y')) ) }}</h3>
                  <p class='year'>{{ date('Y', mktime(0,0,0, date('m')+$month, 1, date('Y')) ) }}</p>
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
