@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">

        <div class="col-md-6" style="margin-top: 50px;">



            <div class="card mb-5">


                <div class="card-body">
                  <h4 class="text-md-center">Update Service Level Agreement</h4>
                    <form method="POST" action="{{ route('sla.update',$serviceLevelAgreement) }}">
                        @csrf
                        @method('PUT')

                        <div class="form-group has-icon-left">
                            <label for="first-name-icon">Name</label>
                            <div class="position-relative">
                                <input type="text" class="form-control"
                                       placeholder="Enter Name" id="first-name-icon" name="name" value="{{$serviceLevelAgreement->name}}">
                                <div class="form-control-icon">
                                    <i class="bi bi-receipt"></i>
                                </div>
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                                      <strong>{{ $message }}</strong>
                                                    </span>
                                @enderror
                            </div>

                        </div>

                        <div class="form-group has-icon-left">
                            <label for="first-name-icon">SLA Hours</label>
                            <div class="position-relative">
                                <input type="number" class="form-control"
                                       placeholder="Enter resolution time" id="first-name-icon" name="hours" min="1" value="{{$serviceLevelAgreement->hours}}">
                                <div class="form-control-icon">
                                    <i class="bi bi-clock"></i>
                                </div>
                                @error('hours')
                                <span class="invalid-feedback" role="alert">
                                                      <strong>{{ $message }}</strong>
                                                    </span>
                                @enderror
                            </div>

                        </div>


                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-block btn-success">
                                    {{ __('Update') }}
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
