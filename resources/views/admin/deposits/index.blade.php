@extends('layouts.master')
@section('content')
<div class="row">

        <section class="row">
            <div class="col-12 col-lg-12">

                <a href="{{route('deposit.create')}}" class=" btn btn-outline-success  mb-2">Record Amount</a>
                <div class="card shadow mb-4">

                    <div class="card-body">
                        <div class="table-responsive-sm">
                            <table class="table table-bordered table-striped small font-weight" id="table1" >
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Amount</th>
                                    <th>Transaction Date</th>
                                    <th>User</th>
                                    <th>Region</th>
                                    <th>Narration</th>
                                    <th>Currency</th>
                                    <th></th>


                                </tr>
                                </thead>

                                <tbody>
                                @forelse($deposits as $deposit)
                                    <tr>
                                        <td>{{$deposit->id}}</td>
                                        <td>{{$deposit->amount}}</td>
                                        <td>{{$deposit->transactionDate}}</td>
                                        <td>{{$deposit->user->name}}</td>
                                        <td>{{$deposit->region->name}}</td>
                                        <td>{{$deposit->narration->name}}</td>
                                        <td>{{$deposit->currency->code}}</td>
                                        <td>{{\Carbon\Carbon::parse($deposit->created_at)->diffForHumans()}}</td>
                                        <td>

                                                                <a class="mb-2" href="{{route('deposit.destroy',$deposit->id)}}">
                                                                    <i class="bi bi-trash small font-weight"></i>
                                                                    Reverse
                                                                </a>



                                        </td>


                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-uppercase text-danger text-center text">No Deposits Found</td>
                                    </tr>
                                @endforelse

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                    @stop
