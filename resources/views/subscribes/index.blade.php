@extends('master')



@section('content')
    <div class="content py-4">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">

                    <div class="card-body">
                        @if (session('msg'))
                            <div class="alert alert-{{ session('type') }}">{{ session('msg') }}</div>
                        @endif

                        <a href="{{ route('subscribes.create') }}" style="margin-bottom: 5px;margin-top: 5px;;"
                            class="btn btn-success mr-5">{{ __('Add New') }}</a>
                            <div class="card-header bg-dark">
                                <div class="card-tools">
                                    <div class="input-group input-group-sm" style="width: 150px;">
                                        <input id="user-search" type="text" class="form-control float-right"
                                            placeholder="Search subscribes">
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
                                    <th>Member</th>
                                    <th>Date</th>
                                    <th>Value</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($subscriptions as $user)
                                    <tr>
                                        <td>{{ $loop->index +1 }}</td>
                                        <td>{{ $user->members->name }} -
                                            {{-- @if ($user->members->type == "subscriber")

                                            <span class="text-green">{{$user->members->name}}</span>
                                            @else
                                            <span class="text-danger">{{$user->members->name}}</span>

                                            @endif --}}
                                        </td>
                                        <td>{{ $user->date }}</td>
                                        <td>{{ $user->value }}</td>
                                        <td class="d-flex">
                                            <a href="{{ route('subscribes.edit', $user) }}"
                                                class="mr-2 btn btn-primary btn-sm">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form class="d-inline"
                                                action="{{ route('subscribes.destroy', $user->id) }}" method="POST">
                                                @csrf
                                                @method('delete')
                                                <button onclick="return confirm('Are you sure!?')"
                                                    class="btn btn-danger btn-sm">
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
