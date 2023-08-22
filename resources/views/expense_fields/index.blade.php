@extends('master')



@section('content')
<div class="content py-4">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h1 class="text-dark text-capitalize">all Expenses Fields</h1>

                <div class="card-body">
                    @if (session('msg'))
                    <div class="alert alert-{{ session('type') }}">{{ session('msg') }}</div>
                    @endif

                    <a href="{{ route('expense_fields.create') }}" style="margin-bottom: 5px;margin-top: 5px;;"
                        class="btn btn-success mr-5">{{ __('Add New') }}</a>
                    <div class="card-header bg-dark">
                        <div class="card-tools">
                            <div class="input-group input-group-sm" style="width: 150px;">
                                <input id="user-search" type="text" class="form-control float-right"
                                    placeholder="Search members">
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
                                <th>ID</th>
                                <th>Name</th>
                                <th>Notes</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($expense_fields as $expense_field )
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $expense_field->name}}</td>
                                <td>{{ $expense_field->notes}}</td>

                                <td class="d-flex">
                                    <a href="{{ route('expense_fields.edit', $expense_field->id) }}"
                                        class="mr-2 btn btn-primary btn-sm">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form class="d-inline"
                                        action="{{ route('expense_fields.destroy', $expense_field->id) }}"
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
                                <td class="text-danger">No Data Found</td>
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