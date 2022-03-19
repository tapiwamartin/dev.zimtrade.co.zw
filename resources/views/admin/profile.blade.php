@extends('layouts.master')
@section('content')

    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-6 col-md-6 order-md-1 order-last">
                    <h3>{{Auth::user()->name}}</h3>
                    <p class="text-subtitle text-muted">{{Auth::user()->email}}  |  {{Auth::user()->organisation}}</p>
                </div>
                <div class="col-6 col-md-6 order-md-2 order-first">

                </div>
            </div>
        </div>
        <section class="section col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Update Password</h4>
                </div>
                <div class="card-body">
                    <form action="{{route('user.password')}}" method="POST">
                        @csrf
                    <div class="form-group has-icon-left">
                    <label for="first-name-icon">Enter old password</label>
                    <div class="position-relative">
                        <input type="password" class="form-control "
                               placeholder="Enter old password" id="first-name-icon" name="old_password">
                        <div class="form-control-icon">
                            <i class="bi bi-key"></i>
                        </div>
                    </div>
                    </div>

                    <div class="form-group has-icon-left">
                    <label for="first-name-icon">Enter new password</label>
                    <div class="position-relative">
                        <input type="password" class="form-control @error('password') is-invalid @enderror"
                               placeholder="Enter new password" id="first-name-icon" name="password">


                        <div class="form-control-icon">
                            <i class="bi bi-key"></i>
                        </div>
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>


                    </div>

                    <div class="form-group has-icon-left">
                    <label for="first-name-icon">Confirm new password</label>
                    <div class="position-relative">
                        <input type="password" class="form-control"
                               placeholder="Confirm new password" id="first-name-icon" name="password_confirmation">
                        <div class="form-control-icon">
                            <i class="bi bi-key-fill"></i>
                        </div>
                    </div>
                </div>
                        <div>
                            <button class="btn btn-outline-success float-md-end float-lg-end float-sm-end">Update</button>
                        </div>
                    </form>
            </div>
            </div>
        </section>
    </div>

@stop
