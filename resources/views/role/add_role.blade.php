@extends('admin.admin_dashboard')
@section('admin')
    <div class="page-content">
        <div class="row profile-body">
            <div class="col-md-8 col-xl-8 middle-wrapper">
                <div class="row">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="card-title">Add Role</h6>
                            <form action="{{ route('store.role') }}" method="POST" class="form-sample" id="myForm">
                                @csrf
                                <div class="form-group mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Role Name</label>
                                    <input type="text" name="name" class="form-control" id="exampleInputEmail1">
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
