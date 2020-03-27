@extends('layouts.app')

@section('content')
  <div class='container'>
    <div class='row justify-content-center'>
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">Treatment list</div>
          <div class="card-body">
            {{-- show error message if error basicly comment not filled --}}
            @if (count($errors) > 0)        
              <div class="alert alert-danger">
                <ul>      
                  @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                 @endforeach
                </ul>
              </div>
            @endif
            {{-- show success message when comment is stored --}}
            @if(Session::has('success_message'))
              <div class="alert alert-success">
                {{ Session::get('success_message') }}
              </div>
            @endif
            <div id="table" class="table-editable">
              <span class="table-add float-right mb-3 mr-2"><a href="#!" class="text-success"><i 
                class="fas fa-plus fa-2x" aria-hidden="true"></i></a></span>
              <table class="table table-bordered table-responsive-md table-striped text-center">
                <thead>
                  <tr>
                  <th class="text-center">Name</th>
                  <th class="text-center">Price</th>
                  <th class="text-center">Duration</th>
                  <th class="text-center">Edit</th>
                  <th class="text-center">Delete</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($treatments as $treatment)
                    <tr>
                      <td class="pt-3-half" contenteditable="true">{{ $treatment->name }}</td>
                      <td class="pt-3-half" contenteditable="true">{{ $treatment->price . ' CZK' }}</td>
                      <td class="pt-3-half" contenteditable="true">{{ $treatment->duration }}</td>
                      <td>
                        <span class="table-remove">
                          <button type="button" class="btn btn-primary btn-rounded btn-sm my-0">Edit</button>
                        </span>
                      </td>
                      <td>
                        <span class="table-remove">
                          <button type="button" class="btn btn-danger btn-rounded btn-sm my-0">Delete</button>
                        </span>
                      </td>
                   </tr>
                  @endforeach
                  <tr>                  
                    <td><input type="text" name="name" placeholder="Name" id="iname" class="form-control" value="{{old('name')}}"></td>
                    <td><input type="text" name="price" placeholder="Price" id="iprice" class="form-control" value="{{old('price')}}"></td>
                    <td>
                      {{-- <input type="text" name="duration" placeholder="Duration" id="iduration" class="form-control"> --}}
                      <select name="duration" id="iduration" class="form-control">
                        <option value="00:30:00" selected>00:30:00</option>
                        <option value="01:00:00">01:00:00</option>
                        <option value="01:30:00">01:30:00</option>
                        <option value="02:00:00">02:00:00</option>
                        <option value="02:30:00">02:30:00</option>
                        <option value="03:00:00">03:00:00</option>
                      </select>
                    </td>
                    <td></td>
                    <td>
                      <form action="{{action('TreatmentController@store')}}" method="post">
                        @csrf
                        <input type="hidden" name="name" id="hname" value="{{old('name')}}">
                        <input type="hidden" name="price" id="hprice" value="{{old('price')}}">
                        <input type="hidden" name="duration" id="hduration" value="{{old('duration')}}">
                        <input type="hidden" name="stylist_id" value={{$stylist_id}}>
                        <input type="submit" class="btn btn-success btn-rounded btn-sm my-0" value="add" id="addbutton">
                      </form> 
                    </td>                     
                  </tr>                
                </tbody>
              </table>    
            </div>
          </div>  
        </div>
      </div>
    </div>
  </div>

  {{-- <script>
    document.addEventListener('DOMContentLoaded', ()=>{
      const addbutton = document.querySelector('#addbutton');
      addbutton.addEventListener('click',()=>{
        console.log('addbutton click');
      });
    });
  </script> --}}
@endsection
