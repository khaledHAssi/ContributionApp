@extends('master')



@section('content')
<div class="content py-4 ">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h1 class="text-primary text-capitalize ">الأعضاء</h1>
                @if (session('msg'))
                <div class="alert alert-{{ session('type') }}">{{ session('msg') }}</div>
                @endif
                <a href="{{ route('members.create') }}" style="margin-bottom: 5px;margin-top: 5px;;"
                    class="btn btn-success">{{ __('اضافة عضو') }}</a>
                <div class="card-header bg-dark ">
                    <div class="card-tools bg-light ">
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <input id="user-search" type="text" class="form-control float-right"
                                placeholder="ابحث عن أعضاء">
                            <div class="input-group-append ">
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
                            <th>الاسم</th>
                            <th>المشرف</th>
                            <th>الوظيفة</th>
                            <th>رقم الهوية</th>
                            <th>الراتب</th>
                            <th>رقم الجوال</th>
                            <th>المساهمة</th>
                            <th>العمليات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($members as $user)
                        <tr>
                            <td>{{ $loop->index + 1 }}</td>
                            <td>{{ $user->name }} - @if ($user->type == 'subscriber')
                                <span class="text-green">{{ $user->type }}</span>
                                @else
                                <span class="text-danger">{{ $user->type }}</span>
                                @endif
                            </td>
                            @if ($user->supervisor)
                            <td>
                                {{ $user->supervisor->name . '-' . $user->supervisor->phone}}</td>
                            @else
                            <td class="text-danger">لا يوجد مشرف</td>
                            @endif
                            <td>{{ $user->job }}</td>
                            <td>{{ $user->identification_number }}</td>
                            <td>{{ $user->salary }}</td>
                            <td>{{ $user->phone }}</td>
                            <td>{{ $user->contributions }}</td>
                            <td class="d-flex">
                                <a href="{{ route('members.edit', $user) }}" class="ml-2 btn btn-primary btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form class="d-inline" action="{{ route('members.destroy', $user->id) }}" method="POST">
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