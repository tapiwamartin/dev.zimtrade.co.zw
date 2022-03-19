@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="col-md-4 col-12 offset-lg-2 offset-md-1">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title col-md">Select Range</h4>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <form class="form form-vertical" action="{{route('report.range.display')}}" method="POST">
                            @csrf
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-12">


                                        <div class="form-group has-icon-left">

                                            <label for="first-name-icon">Start Date</label>
                                            <div class="position-relative">
                                                <input type="date" class="form-control"
                                                       placeholder="Input Role" id="first-name-icon" name="startDate" required>
                                                <div class="form-control-icon">
                                                    <i class="bi bi-calendar-event"></i>
                                                </div>
                                            </div>
                                            <label for="first-name-icon">End Date</label>
                                            <div class="position-relative">
                                                <input type="date" class="form-control"
                                                       placeholder="Input Role" id="first-name-icon" name="endDate" required>
                                                <div class="form-control-icon">
                                                    <i class="bi bi-calendar-event"></i>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12 d-flex justify-content-end">
                                            <button type="submit" class="btn btn-outline-success me-1 mb-1">Submit</button>

                                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    </div>
@endsection
