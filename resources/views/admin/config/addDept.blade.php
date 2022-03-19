@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">

        <div class="col-md-4 mb-5" style="margin-top: 50px;">




            <div class="card">


                <div class="card-header">
                    <h4 class="card-title col-md">Add to department</h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('deptUser.store') }}">
                        @csrf
                        @forelse($departments as $department)
                        <input type="hidden" name="userId" value="{{$id}}">


                              <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="exampleCheck1" value="{{$department->id}}" name="departmentId[]">
                                <label class="form-check-label" for="exampleCheck1">{{$department->name}}</label>
                              </div>


                        @empty
                        <p>No Categories Configured in the system Please Contact Admin</p>
                         @endforelse


                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-outline-success btn-block float-end">
                                    {{ __('Save/Update') }}
                                </button>

                            </div>
                        </div>


                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
