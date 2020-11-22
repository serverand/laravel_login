@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Users
                    <div style="float:right;">
                        <button type="button" class="btn btn-outline-secondary" onclick="window.location.href='/user/create'">+ Add User</button>
                    </div>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <table class="table">
                        <thead>
                            <tr>
                                <th>UserName / Email</th>
                                <th class="col-md-4 text-center">Actions</th>
                            </tr>
                            @foreach ($users as $user)
                            <tr>
                                <td><strong>{{$user->name}}</strong><br>{{$user->email}}</td>
                                <td>
                                    <button type="button" class="btn btn-outline-secondary" onclick="window.location.href='/user/edit/{{$user->id}}'">Edit User</button> 
                                    <button type="button" class="btn btn-outline-secondary" onclick="window.location.href='/user/delete/{{$user->id}}'">Delete User</button>
                                </td>
                            </tr>
                            @endforeach
                        </thead>
                    </table>
                    <!-- PAGINATE -->
                    <div class="clearfix"></div>
                    {{$users->links()}}
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
