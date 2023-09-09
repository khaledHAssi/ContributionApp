@extends('master')

@php
$members = \App\Models\Member::all();
$subscriberCount = $members->where('type', 'subscriber')->count();
$contributorCount = $members->where('type', 'contributor')->count();
    @endphp

<style>
    .Headers4 {
        margin-left: 10px;
        margin-right: 0px;
        font-weight: 600;
    }

    .Headers5 {
        margin-left: 0px;
        margin-top: 1.1% !important;
    }
</style>

@section('content')
<div class="content py-4">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <div class="container-xxl">
                    <div class="container">
                        <div class="row g-4 align-items-center mb-4 flex">
                            <div class="col-lg-5 wow fadeInUp" data-wow-delay="0.1s">
                                <div class="d-flex justify-content-center">
                                    <img class="img-thumbnail" width="450"
                                        src="{{ Storage::url($supervisor->user_image) }}" alt="user image">
                                </div>
                                <div class="d-flex justify-content-center">
                                    <p class="text-warning">
                                        {{-- {{ $supervisor->status }} --}}
                                    </p>
                                </div>
                            </div>
                            <div class="col-4 wow fadeInUp details" style="position: relative;top:-2em;bottom: 1em;"
                                data-wow-delay="0.3s">
                                <div style="display:flex;">
                                    <h4 class="Headers4">الإسم: </h4>
                                    <h5 class="Headers5">
                                        {{ $supervisor->name }}
                                    </h5>
                                </div>
                                <div style="display:flex;">
                                    <h4 class="Headers4">الإيميل: </h4>
                                    <h5 class="Headers5">
                                        {{ $supervisor->email }}
                                    </h5>
                                </div>
                                <div style="display:flex;">
                                    <h4 class="Headers4">رقم الجوال: </h4>
                                    <h5 class="Headers5">
                                        {{ $supervisor->phone }}
                                    </h5>
                                </div>
                            </div>
                            <div class="col-3 wow fadeInUp details" style="position: relative;top:-2em;bottom: 1em;"
                                data-wow-delay="0.3s">
                                <div style="display:flex;">
                                    <h4 class="Headers4">عدد الأعضاء المتبرعين: </h4>
                                    <h5 class="Headers5">
                                        {{ $contributorCount }}
                                    </h5>
                                </div>
                                <div style="display:flex;">
                                    <h4 class="Headers4"> عدد الأعضاء المشتركين: </h4>
                                    <h5 class="Headers5">
                                        {{$subscriberCount}}
                                    </h5>
                                </div>
                            </div>
                            {{-- <div class="col-lg-12 wow fadeInUp" data-wow-delay="0.1s">
                                <nav>
                                    <div class="nav nav-tabs mb-3" id="nav-tab" role="tablist">
                                        <button class="nav-link fw-semi-bold active text-bold" id="nav-story-tab"
                                            data-bs-toggle="tab" data-bs-target="#nav-story" type="button" role="tab"
                                            aria-controls="nav-story" aria-selected="true">Description</button>
                                    </div>
                                </nav>
                                <div class="tab-content" id="nav-tabContent">
                                    <div class="tab-pane fade show active" id="nav-story" role="tabpanel"
                                        aria-labelledby="nav-story-tab">
                                        <p class="Headers5">

                                        </p>
                                    </div>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                </div>
                <span class="h4" style="font-weight: 900;display: block;">الأعضاء المُشرِف عليهم</span>
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
                <table id="users-table" class="table table-bordered table-hover">
                    <thead>
                        <tr class="bg-dark text-white">
                            <th>#</th>
                            <th>الإسم</th>
                            <th>النوع</th>
                            <th>رقم الجوال</th>
                            <th>رقم الهوية</th>
                            <th>الراتب</th>
                            <th>المبلغ المطلوب دفعه / مجموع اشتراكاته</th>
                            <th>المبلغ المتبقي</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($supervisor->members as $student)

                        @php
                        $creationDate = new DateTime($student->created_at);
                        $currentDate = new DateTime();
                        $interval = $creationDate->diff($currentDate);
                        $monthDiff = $interval->format('%m') + 12 * $interval->format('%y');
                        $contribution = $student->contributions;
                        $totalAmount = $contribution * $monthDiff;
                        @endphp
                        @php

                        @endphp
                        @php
                        $total = 0;
                        $RemainingAmount = 0 ;
                        @endphp

                        @foreach ($student->subscribes as $item)
                        @php
                        $total += $item->value;
                        $RemainingAmount = $totalAmount - $total;
                        @endphp
                        @endforeach



                        <tr>
                            <td>{{ $loop->index + 1 }}</td>
                            <td>{{ $student->name }}</td>
                            @if ($student->type === 'subscriber')
                            <td class="text-danger">مشترك</td>
                            @else
                            <td class="text-success">متبرع</td>
                            @endif
                            <td>{{ $student->phone }}</td>
                            <td>{{ $student->identification_number }}</td>
                            <td>{{ $student->salary }}</td>
                            @if ($student->subscribes->count() > 0)
                            <td>{{ $totalAmount }} - {{ $total }}</td>
                            @else
                            <td class="text-danger"> {{$totalAmount}} .. ليس لديه اشتراكات</td>
                            @endif
                            @if ($student->subscribes->count() > 0)
                            <td>{{$RemainingAmount}}</td>
                            @else
                            <td class="text-danger">متبرع</td>
                            @endif
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@stop
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
