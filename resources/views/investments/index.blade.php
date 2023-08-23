@extends('master')
@section('content')
    <div class="content py-4">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <h1 class="text-dark text-capitalize">الصناديق</h1>
                    @if (session('msg'))
                        <div class="alert alert-{{ session('type') }}">{{ session('msg') }}</div>
                    @endif
                    <a href="{{ route('investments.create') }}" style="margin-bottom: 5px;margin-top: 5px;;"
                        class="btn btn-success ">{{ __('إضافة جديد') }}</a>
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
                                <th>الإسم</th>
                                <th>اسم الاشتراك و إسم العضو </th>
                                <th>الرصيد</th>
                                <th>العمليات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($investments   as $investment)
                                <tr>
                                    <td>{{ $investment->id }}</td>
                                    <td>{{ $investment->name }}</td>
                                    <td>
                                        @forelse ($investment->subscribers as $subscriber)
                                            <p>
                                                <span> اسم الاشتراك :
                                                    {{ $subscriber->name . ' -- اسم العضو : ' . $subscriber->members->name }}
                                                </span>
                                            </p>
                                        @empty
                                            <span class="text-danger"> لا يوجد مشتركين</span>
                                        @endforelse
                                    </td>
                                    @if ($investment->total)
                                    <td>{{ $investment->total }}</td>
                                    @else
                                    <td class="text-danger">لا يوجد رصيد</td>
                                    @endif
                                    <td class="d-flex justify-content-center ">
                                        <a href="{{ route('investments.edit', $investment) }}"
                                            class="ml-2 btn btn-primary btn-sm">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form  action="{{ route('investments.destroy', $investment->id) }}"
                                            method="POST">
                                            @csrf
                                            @method('delete')
                                            <button onclick="return confirm('Are you sure!?')"
                                                class="btn btn-danger btn-sm">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                @empty
                                    <td colspan="6">No Data Found</td>
                            @endforelse
                            </tr>
                        </tbody>
                    </table>
                </div>
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
