@extends('master')



@section('content')
<div class="content py-4">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h1 class="text-dark text-capitalize">المشرفين</h1>
                @if (session('msg'))
                <div class="alert alert-{{ session('type') }}">{{ session('msg') }}</div>
                @endif

                <a href="{{ route('supervisors.create') }}" style="margin-bottom: 5px;margin-top: 5px;;"
                    class="btn btn-success">{{ __('اضافة مشرف') }}</a>
                <div class="card-header bg-dark">
                    <div class="card-tools">
                        <div class="input-group bg-light input-group-sm" style="width: 150px;">
                            <input id="user-search" type="text" class="form-control float-right"
                                placeholder="إبحث عن أعضاء">
                            <div class="input-group-append">
                                <button id="search-button" class="btn btn-default">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <table class="table table-bordered" id="users-table">
                    <thead>
                        <tr class="bg-dark text-white">
                            <th>#</th>
                            <th>الصورة</th>
                            <th>اسم المشرف</th>
                            <th>الأيميل </th>
                            <th>رقم الهاتف</th>
                            <th>العمليات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($supervisors as $supervisor)
                        <tr>
                            <td>{{ $loop->index +1 }}</td>
                            <td>
                                <img class="img-circle img-bordered-sm" height="65" width="65"
                                    src="{{ Storage::url($supervisor->user_image) }}" alt="user image">
                            </td>
                            <td>{{ $supervisor->name }}
                            </td>
                            <td> {{$supervisor->email}}
                            </td>
                            <td> {{$supervisor->phone}}
                            </td>

                            <td class="d-flex">
                                <a href="{{ route('supervisors.edit', $supervisor) }}"
                                    class="ml-2 btn btn-primary btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form class="d-inline" action="{{ route('supervisors.destroy', $supervisor->id) }}"
                                    method="POST">
                                    @csrf
                                    @method('delete')
                                    <button onclick="return confirm('Are you sure!?')" class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6">No Data Found</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.datatables.net/1.11.2/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function() {
            $('#search-button').on('click', function() {
                var searchValue = $('#user-search').val().trim();
                $('#users-table').DataTable().search(searchValue).draw();
            });
        });
</script>
@endsection
