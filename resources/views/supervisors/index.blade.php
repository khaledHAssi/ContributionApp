@extends('master')



@section('content')
<div class="content py-4">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h1 class="text-primary text-capitalize">المشرفين</h1>
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
                            @if ($supervisor->user_image != null )
                            <td>
                                <img class="img-circle img-bordered-sm" height="65" width="65"
                                src="{{ Storage::url($supervisor->user_image) }}" alt="user image">
                            </td>
                                    @else
                                        <td style="color:red;">No Pic</td>
                                    @endif

                            <td>{{ $supervisor->name }}
                            </td>
                            <td> {{$supervisor->email}}
                            </td>
                            <td> {{$supervisor->phone}}
                            </td>

                            <td class="d-flex">
                                <a href="{{ route('reports.supervisor.members', $supervisor) }}"
                                class="ml-2 btn btn-primary btn-sm">
                                التقرير
                                <i class="fas fa-file"></i>

                            </a>
                                <a href="{{ route('supervisors.show', $supervisor->id) }}"
                                    class="btn btn-primary btn-sm mr-1"> <i class="fas fa-eye"></i> </a>
                                <a href="{{ route('supervisors.edit', $supervisor) }}"
                                    class="ml-2 btn btn-primary btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="{{ route('members.create', ['id' => $supervisor->id]) }}" class="ml-2 btn btn-primary btn-sm">
                                    <i class="fas fa-plus"></i>
                                </a>
                                <form class="d-inline" action="{{ route('supervisors.destroy', $supervisor->id) }}"
                                    method="POST">
                                    @csrf
                                    @method('delete')
                                    <button onclick="return confirm('!هل أنت متأكد؟')" class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td class="text-danger" colspan="6">لا يوجد بيانات</td>
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
