@extends('layouts.master')
@section('content')

<div class="card shadow mb-4">

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="table1">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Department</th>
                                            <th>Role(s)</th>
                                            <th>Status</th>
                                            <th>Created</th>
                                            <th></th>

                                        </tr>
                                    </thead>

                                    <tbody>
                                        @forelse($users as $user)
                                        <tr>
                                            <td>{{$user->name}}</td>
                                            <td>{{$user->email}}</td>
                                            <td>
                                                @forelse($user->departments as $dept)
                                                  {{$dept->name}}  <a href="{{route('remove.user.dept',[$user->id,$dept->pivot->departmentId])}}" style="text-decoration: none"><i
                                class="bi bi-trash text-danger fa-sm "></i></a>&nbsp;
                                                @empty
                                                <small style="color: red;">No department attached</small>
                                                @endforelse

                                            </td>
                                            <td>
                                                @forelse($user->roles as $role)
                                                  {{$role->name}} <a href="{{route('remove.user.role',[$user->id,$role->pivot->roleId])}}" style="text-decoration: none"><i
                                class="bi bi-trash text-danger fa-sm "></i></a>&nbsp;
                                                @empty
                                                <small style="color: red;">No role attached</small>
                                                @endforelse
                                            </td>
                                            <td>
                                                <small class=" text-center text-{{$user->isAuthorised==0?'danger':'success'}}">{{$user->isAuthorised==0?'unauthorised':'authorised'}}</small>
                                            </td>
                                            <td>{{\Carbon\Carbon::parse($user->created_at)->diffForHumans()}}</td>
                                            <td> <button type="button" class="btn btn-outline-primary block" data-bs-toggle="modal"
                                                         data-bs-target="#user{{$user->id}}">
                                                    Configurations
                                                </button>
                                                <div class="modal fade" id="user{{$user->id}}" tabindex="-1" role="dialog"
                                                     aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable"
                                                         role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalCenterTitle">User Configurations
                                                                </h5>
                                                                <button type="button" class="close" data-bs-dismiss="modal"
                                                                        aria-label="Close">
                                                                    <i data-feather="x"></i>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <ul class="list-group">
                                                                    <li class="list-group-item"><a  href="{{route('add.user.dept',$user->id)}}">
                                                                            <i class="bi bi-plus"></i>
                                                                            Add to Department
                                                                        </a></li>
                                                                    <li class="list-group-item"> <a href="{{route('add.user.role',$user->id)}}">
                                                                            <i class="bi bi-gear"></i>
                                                                            Configure Role
                                                                        </a></li>
                                                                    @if($user->isAuthorised == 0)
                                                                    <li class="list-group-item">  <a href="{{route('user.authorised',$user->id)}}">
                                                                            <i class="bi bi-check"></i>
                                                                            Authorise
                                                                        </a></li>
                                                                    @else

                                                                    <li class="list-group-item">  <a href="{{route('user.unauthorise',$user->id)}}">
                                                                            <i class="bi bi-lock"></i>
                                                                            UnAuthorise
                                                                        </a></li>
                                                                    @endif
                                                                    <li class="list-group-item"> <a href="{{route('view.user.activity',$user)}}">
                                                                            <i class="bi bi-view-list"></i>
                                                                            View Activity Logs
                                                                        </a></li>
                                                                    <li class="list-group-item">
                                                                        <form method="POST" action="{{route('user.destroy',$user)}}">
                                                                            @csrf
                                                                            @method('DELETE')
                                                                            <button type="submit" class="btn"><i
                                                                                    class="bi bi-trash "></i> Remove User</button>
                                                                        </form>
                                                                    </li>

                                                                </ul>
                                                            </div>

                                                        </div>
                                                    </div>

                                            </td>

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

