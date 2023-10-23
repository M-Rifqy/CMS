@extends('admin.admin_dashboard')
@section('admin')
    <div class="page-content">
        <div class="row profile-body">
            <div class="col-md-8 col-xl-8 middle-wrapper">
                <div class="row">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="card-title">Add Permission</h6>
                            <form action="{{ route('store.permission') }}" method="POST" class="form-sample" id="myForm">
                                @csrf
                                <div class="form-group mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Permission Name</label>
                                    <input type="text" name="name" class="form-control" id="exampleInputEmail1">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="exampleFormControlSelect1" class="form-label">Group Name</label>
                                    <select name="group_name" id="exampleFormControlSelect1" class="form-select">
                                        <option disabled selected="">Select Group</option>
                                        <option value="item">Menu Item</option>
                                        <option value='category'>Menu Category</option>
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
