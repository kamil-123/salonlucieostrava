@extends('layouts.app')

@section('content')
  <div class='container'>
    <div class='row justify-content-center'>
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">Treatment list</div>
          <div class="card-body">
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
                      <td>Edit</td>
                      <td>Delete</td>
                  </tr>
                  @endforeach
                </tbody>
              </table>    
            </div>
          </div>  
        </div>
      </div>
    </div>
  </div>
@endsection
