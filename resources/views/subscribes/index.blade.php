@extends('master')



@section('content')
<div class="content py-4">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h1 class="text-primary text-capitalize">الإشتراكات</h1>
                @if (session('msg'))
                <div class="alert alert-{{ session('type') }}">{{ session('msg') }}</div>
                @endif

                <a href="{{ route('subscribes.create') }}" style="margin-bottom: 5px;margin-top: 5px;;"
                    class="btn btn-success">{{ __('إضافة مشترك') }}</a>
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
                            <th>العضو</th>
                            <th>الصندوق</th>
                            <th>التاريخ</th>
                            <th>قيمة الإشتراك</th>
                            <th>العمليات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($subscriptions as $user)
                        <tr>
                            <td>{{ $loop->index +1 }}</td>
                            <td>{{ $user->members->name }} -
                                @if ($user->members->type == "subscriber")

                                <span class="text-green">{{$user->members->type}}</span>
                                @else
                                <span class="text-danger">{{$user->members->type}}</span>

                                @endif
                            </td>
                            <td>
                                <span class="text-green">{{$user->investments->name}}</span>
                            </td>
                            <td>{{ $user->date }}</td>
                            <td>{{ $user->value }}</td>
                            <td class="d-flex">
                                <a href="{{ route('subscribes.edit', $user) }}" class="ml-2 btn btn-primary btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form class="d-inline" action="{{ route('subscribes.destroy', $user->id) }}"
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