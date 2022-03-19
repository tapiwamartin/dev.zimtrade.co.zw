@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">

        <div class="col-md-4 mb-5" style="margin-top: 50px;">
         
      
     
          
            <div class="card">
                   <h4 class="text-md-center">Configure Role</h4>
                
                <hr>
                <div class="card-body">
                    <form method="POST" action="{{ route('roleUser.store') }}">
                        @csrf
                        @forelse($roles as $role)
                        <input type="hidden" name="userId" value="{{$id}}">
                        
                           
                              <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="exampleCheck1" value="{{$role->id}}" name="roleId[]">
                                <label class="form-check-label" for="exampleCheck1">{{$role->name}}</label>
                              </div>
                                    
                        
                        @empty
                        <p>No Roles in the system Please Contact Admin</p>
                        @endforelse

                   
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-block btn-success">
                                    {{ __('Save') }}
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
