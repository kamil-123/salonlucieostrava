@extends('layouts.calendarTemplate')

@section('content')
<div class="container">
    <div class="row justify-content-center">

        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Monthly Calendar</div>
                
                <div class="card-body">
                  <div class='row links'>
                    <span class='link-left col'><a href=#>back</a></span>
                    <span class='link-right col'><a href=#>next</a></span>
                  </div>
                  <h3>March</h3>
                  <p class='year'>2020</p>
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
                        <div class="row">
                          <div class="col calendar-day calendar-no-current-month">
                            <time datetime="2014-06-29">29</time>
                          </div>
                          <div class="col calendar-day calendar-no-current-month">
                            <time datetime="2014-06-30">30</time>
                          </div>
                          <div class="col calendar-day">
                            <time datetime="2014-07-01">01</time>
                          </div>
                          <div class="col calendar-day">
                            <time datetime="2014-07-02">02</time>
                          </div>
                          <div class="col calendar-day">
                            <time datetime="2014-07-03">03</time>
                          </div>
                          <div class="col calendar-day">
                            <time datetime="2014-07-04">04</time>
                          </div>
                          <div class="col calendar-day">
                            <time datetime="2014-07-05">05</time>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col calendar-day">
                            <time datetime="2014-07-06">06</time>
                          </div>
                          <div class="col calendar-day">
                            <time datetime="2014-07-07">07</time>
                          </div>
                          <div class="col calendar-day">
                            <time datetime="2014-07-08">08</time>
                          </div>
                          <div class="col calendar-day">
                            <time datetime="2014-07-09">09</time>
                          </div>
                          <div class="col calendar-day">
                            <time datetime="2014-07-10">10</time>
                          </div>
                          <div class="col calendar-day">
                            <time datetime="2014-07-11">11</time>
                          </div>
                          <div class="col calendar-day">
                            <time datetime="2014-07-12">12</time>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col calendar-day">
                            <time datetime="2014-07-13">13</time>
                          </div>
                          <div class="col calendar-day">
                            <time datetime="2014-07-14">14</time>
                          </div>
                          <div class="col calendar-day">
                            <time datetime="2014-07-15">15</time>
                          </div>
                          <div class="col calendar-day">
                            <time datetime="2014-07-16">16</time>
                          </div>
                          <div class="col calendar-day">
                            <time datetime="2014-07-17">17</time>
                          </div>
                          <div class="col calendar-day">
                            <time datetime="2014-07-18">18</time>
                          </div>
                          <div class="col calendar-day">
                            <time datetime="2014-07-19">19</time>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col calendar-day">
                            <time datetime="2014-07-20">20</time>
                          </div>
                          <div class="col calendar-day">
                            <time datetime="2014-07-21">21</time>
                          </div>
                          <div class="col calendar-day">
                            <time datetime="2014-07-22">22</time>
                          </div>
                          <div class="col calendar-day">
                            <time datetime="2014-07-23">23</time>
                          </div>
                          <div class="col calendar-day">
                            <time datetime="2014-07-24">24</time>
                          </div>
                          <div class="col calendar-day">
                            <time datetime="2014-07-25">25</time>
                          </div>
                          <div class="col calendar-day">
                            <time datetime="2014-07-26">26</time>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col calendar-day">
                            <time datetime="2014-07-27">27</time>
                          </div>
                          <div class="col calendar-day">
                            <time datetime="2014-07-28">28</time>
                          </div>
                          <div class="col calendar-day">
                            <time datetime="2014-07-29">29</time>
                          </div>
                          <div class="col calendar-day">
                            <time datetime="2014-07-30">30</time>
                          </div>
                          <div class="col calendar-day">
                            <time datetime="2014-07-31">31</time>
                          </div>
                          <div class="col calendar-day calendar-no-current-month">
                            <time datetime="2014-08-01">01</time>
                          </div>
                          <div class="col calendar-day calendar-no-current-month">
                            <time datetime="2014-08-02">02</time>
                          </div>
                        </div>
                      </div>


                    
                  {{-- </div> --}}
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
