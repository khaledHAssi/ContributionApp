@extends('master')



@section('content')
<div class="content py-4">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h1 class="text-primary text-capitalize mr-3">المصروفات</h1>

                <div class="card-body">
                    @if (session('msg'))
                    <div class="alert alert-{{ session('type') }}">{{ session('msg') }}</div>
                    @endif

                    <a href="{{ route('expenses.create') }}" style="margin-bottom: 5px;margin-top: 5px;;"
                        class="btn btn-success ">{{ __('إضافة جديد') }}</a>
                    <div class="card-header bg-dark">
                        <div class="card-tools">
                            <div class="input-group bg-light input-group-sm" style="width: 150px;">
                                <input id="user-search" type="text" class="form-control float-right"
                                    placeholder="إبحث عن أعضاء ">
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
                                <th>الصندوق</th>
                                <th>أوجه الصرف</th>
                                <th>التفاصيل</th>
                                <th>المبلغ</th>
                                <th>العمليات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($expenses as $expense )
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $expense->name}}</td>
                                @if ($expense->investment_id != 0 )
                                <td>{{ $expense->investment->name}}</td>
                                @else
                                <td class="text-danger">لم يتم الدفع من صندوق</td>
                                @endif
                                @if ($expense->expenseField_id)
                                <td>{{ $expense->expense_field->name}}</td>
                                @else
                                <td class="text-danger">لا يوجد وجه صرف</td>
                                @endif
                                <td>{{ $expense->details}}</td>
                                <td>{{ $expense->total_expenses }}</td>

                                <td class="d-flex justify-content-center">
                                    <a href="{{ route('expenses.edit', $expense) }}"
                                        class="ml-2 btn btn-primary btn-sm">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form class="d-inline" action="{{ route('expenses.destroy', $expense->id) }}"
                                        method="POST">
                                        @csrf
                                        @method('delete')
                                        <button onclick="return confirm('!هل أنت متأكد؟')"
                                            class="btn btn-danger btn-sm">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                                @empty
                            <tr>
                                <td class="text-danger" colspan="6">لا يوجد بيانات</td>
                            </tr>
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