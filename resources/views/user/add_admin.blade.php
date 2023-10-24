@extends('admin.admin_dashboard')
@section('admin')
    <div class="page-content">
        <div class="row profile-body">
            <div class="col-md-8 col-xl-8 middle-wrapper">
                <div class="row">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="card-title">Add User</h6>
                            <form action="{{ route('store.admin') }}" method="POST" class="form-sample" id="myForm">
                                @csrf
                                <div class="form-group mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Username</label>
                                    <input type="text" name="username" class="form-control" id="exampleInputEmail1">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Name</label>
                                    <input type="text" name="name" class="form-control" id="exampleInputEmail1">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Email</label>
                                    <input type="text" name="email" class="form-control" id="exampleInputEmail1">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Phone</label>
                                    <input type="text" name="phone" class="form-control" id="exampleInputEmail1">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Address</label>
                                    <input type="text" name="address" class="form-control" id="exampleInputEmail1">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Password</label>
                                    <input type="password" name="password" class="form-control" id="exampleInputEmail1">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Role</label>
                                    <select name="roles" id="exampleInputEmail1" class="form-select">
                                        <option disable>Select Role</option>
                                        @foreach ($roles as $role)
                                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary me-2">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
