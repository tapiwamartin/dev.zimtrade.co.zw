@extends('layouts.master')
@section('content')

    <div class="card shadow col-md-12 offset-0 mb-4">

                        <div class="card-body">
                            <h5>Assign user to an inquiry #{{$ticket->id}}</h5>
                            <hr>
                            <div class="table-responsive">
                                <table class="table table-bordered"  width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Department</th>
                                            <th>Role(s)</th>
                                            <th>Service level Agreement</th>
                                            <th>Status</th>
                                            <th></th>

                                        </tr>
                                    </thead>

                                    <tbody>
                                        @forelse($users as $user)
                                        <tr>
                                            <td>{{$user->name}}</td>

                                            <td>
                                                @forelse($user->departments as $dept)
                                                  {{$dept->name}}  <a href="{{route('remove.user.dept',[$user->id,$dept->pivot->departmentId])}}" style="text-decoration: none"><i
                                class="fas fa-times text-danger fa-sm "></i></a>&nbsp;
                                                @empty
                                                <small style="color: red;">No department attached</small>
                                                @endforelse

                                            </td>
                                            <td>
                                                @forelse($user->roles as $role)
                                                  {{$role->name}} <a href="{{route('remove.user.role',[$user->id,$role->pivot->roleId])}}" style="text-decoration: none"><i
                                class="fas fa-times text-danger fa-sm "></i></a>&nbsp;
                                                @empty
                                                <small style="color: red;">No role attached</small>
                                                @endforelse
                                            </td>
                                            <form method="POST" action="{{route('ticket.agent.assign')}}">
                                                @csrf


                                            <td>
                                                <input type="hidden" name="user_id" value="{{$user->id}}">
                                                <input type="hidden" name="ticket_id" value="{{$ticket->id}}">
                                                    <div class="form-group">
                                                    <select class="form-control" name="sla_id">
                                                        @forelse($serviceLevelAgreement as $sla)
                                                            <option value="{{$sla->id}}">{{$sla->name}} hour(s):{{$sla->hours}}</option>
                                                        @empty
                                                        @endforelse
                                                    </select>
                                                </div>

                                            </td>
                                            <td>
                                                <small class=" text-center text-{{$user->isAuthorised==0?'danger':'success'}}">{{$user->isAuthorised==0?'unauthorised':'authorised'}}</small>
                                            </td>

                                            <td>

                                                <button type="submit" class=" btn btn-outline-success"> Assign</button>

                                          </td>
                                        </form>

                                        </tr>
                                        @empty
                                        <tr>
                                            <td class="text-center text-danger" colspan="5">No users Found</td>
                                        </tr>
                                        @endforelse

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    @stop
