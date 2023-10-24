@extends('admin.admin_dashboard')
@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <style>
        .form-check-label {
            text-transform: capitalize;
        }
    </style>
    <div class="page-content">
        <div class="row profile-body">
            <div class="col-md-8 col-xl-12 middle-wrapper">
                <div class="row">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="card-title">Edit Roles in Permission</h6>
                            <form action="{{ route('update.role.permission', $role->id) }}" method="POST" class="form-sample"
                                id="myForm">
                                @csrf
                                <div class="form-group mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Role Name</label>
                                    <h3>{{ $role->name }}</h3>

                                </div>
                                <div class="form-check mb-2">
                                    <input type="checkbox" class="form-check-input" id="checkDefaultMain">
                                    <label class="form-check-label" for="checkDefaultMain">Select All</label>
                                </div>
                                <hr>
                                @foreach ($permission_groups as $group)
                                    <div class="row">
                                        <div class="col-3">
                                            @php
                                                $permissions = App\Models\User::getPermissionsByGroupName($group->group_name);
                                            @endphp
                                            <div class="form-check mb-2">
                                                <input type="checkbox" class="form-check-input" id="checkDefault"
                                                    {{ App\Models\User::roleHasPermissions($role, $permissions) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="checkDefault">
                                                    {{ $group->group_name }}
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-9">
                                            @foreach ($permissions as $permission)
                                                <div class="form-check mb-2">
                                                    <input type="checkbox" class="form-check-input"
                                                        value="{{ $permission->id }}" id="checkDefault{{ $permission->id }}"
                                                        name="permission[]"
                                                        {{ $role->hasPermissionTo($permission->name) ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="checkDefault{{ $permission->id }}">
                                                        {{ $permission->name }}
                                                    </label>
                                                </div>
                                            @endforeach
                                            <br>
                                        </div>
                                    </div>
                                @endforeach
                                <button type="submit" class="btn btn-primary me-2">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $('#checkDefaultMain').click(function() {
            if ($(this).is(':checked')) {
                $('input[type=checkbox]').prop('checked', true)
            } else {
                $('input[type=checkbox]').prop('checked', false)
            }
        })

        $('#myForm').submit(function() {
            // Get the selected role_id from the dropdown
            var selectedRoleId = $('#exampleInputEmail1').val();

            // Set the role_id in the data object
            data['role_id'] = selectedRoleId;

            // Continue with the form submission
        });
    </script>
@endsection
