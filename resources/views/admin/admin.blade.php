@extends('master')

@section('content')
            <div class="row">
                <div class="list-title">
                    <span>Team</span>
                    <a href="" class="btn btn-default" data-toggle="modal" data-target="#addPeople">ADD ADMIN</a>
                </div>

                <!-- Add Admin Modal-->
                <div class="modal fade" tabindex="-1" role="dialog" id="addPeople" >
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                                <h4 class="modal-title">Add People as Admin</h4>
                            </div>
                            <div class="modal-body">
                                <form action="{{route('admin_add')}}" method="post">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Username" name="username">
                                        {{ csrf_field() }}
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control"  placeholder="Passwords" name="password">
                                    </div>
                                
                            </div>
                            <div class="modal-footer">
                                <button  class="btn btn-info">ADD</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>  <!-- Add Admin Modal-->

                <div class="list">
                    <!--Admin list header-->
                    <div class="row list-header">
                        <div class="col-sm-5">USERNAME</div>
                        <div class="col-sm-5">PASSWORDS HASHED</div>
                        <div class="col-sm-2">ACTION</div>
                    </div>
                    <div class="custom-bg-divider"></div>   <!--Admin list header-->
                    <!--Admin list -->
                    @foreach($admins as $admin)
                    <div class="list-content">
                        <div class="row">
                            <div class="col-sm-5">
                                <div class="name-detail">
                                    <div class="team-avatar">
                                        <span class="glyphicon glyphicon-user"></span>
                                    </div>
                                    <div class="team-name">
                                        <p>{{$admin->username}}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-5">
                                <span class="text-warning">{{$admin->password}}</span>
                            </div>
                            <div class="col-sm-2">
                                <a href="/admin/admin/admin_panel/delete/{{$admin->id}}"><span class="glyphicon glyphicon-trash text-danger"></span></a>
                            </div>
                        </div>
                        <div class="custom-divider"></div>
                    </div>
                    @endforeach
                      <!--Admin list -->

                    <!--Admin list -->

                </div>
            </div>
@stop

@section('script')
<script src="../../js/jquery.min.js"></script>
<script src="../../js/bootstrap.min.js"></script>
@stop