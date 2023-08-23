@extends('master')

@php
    $title = 'تعديل الصرف';

@endphp

@section('title', $title)

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="card mt-4">
                <div class="card-body">
                    <h1>{{ $title }}</h1>
                    <form action="{{ route('expenses.update', $expenses) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="card-body">
                            @if ($errors->any())
                                <div class="alert alert-danger alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                    <h5><i class="icon fas fa-ban"></i>الأخطاء</h5>
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                        </div>
                        @endif

                        <div class="mb-3">
                            <label for="name">الإسم</label>
                            <input id="name" name="name" type="text" placeholder="الإسم"
                                class="form-control @error('name') is-invalid @enderror "
                                value="{{ old('name', $expenses->name) }}" />
                            @error('name')
                                <small class="invalid-feedback">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="investment_id">الصندوق</label>
                            <select name="investment_id"id="investment_id"
                                class="form-control @error('investment_id') is-invalid @enderror">
                                @foreach ($investments as $investment)
                                    <option @selected($expenses->investment_id == $investment->id) value="{{ $investment->id }}">
                                        {{ $investment->name . ' - ' . $investment->total }}
                                    </option>
                                @endforeach
                            </select>
                            @error('investment_id')
                                <small class="invalid-feedback">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="expenseField_id">وجه الصرف</label>
                            <select name="expenseField_id" id="expenseField_id"
                                class="form-control @error('expenseField_id') is-invalid @enderror">
                                @foreach ($expense_fields as $expense_field)
                                    <option @selected($expenses->expenseField_id == $expenses->id) value="{{ $expense_field->id }}">
                                        {{ $expense_field->name . ' -- تم إنشاؤه في  : ' . $expense_field->created_at }}
                                    </option>
                                @endforeach
                            </select>
                            @error('expenseField_id')
                                <small class="invalid-feedback">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="details">التفاصيل</label>
                            <input id="details" name="details" type="text" placeholder="التفاصيل"
                                class="form-control @error('details') is-invalid @enderror "
                                value="{{ old('details', $expenses->details) }}" />
                            @error('details')
                                <small class="invalid-feedback">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="total_expenses">المبلغ</label>
                            <input id="total_expenses" name="total_expenses" type="number" placeholder="المبلغ"
                                class="form-control @error('total') is-invalid @enderror "
                                value="{{ old('name', $expenses->total_expenses) }}" />
                            @error('total')
                                <small class="invalid-feedback">{{ $message }}</small>
                            @enderror
                        </div>

                        <button class="btn btn-success px-5">تعديل<i class="fas fa-save"></i></button>

                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>

@stop

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/6.3.1/tinymce.min.js"
        integrity="sha512-eV68QXP3t5Jbsf18jfqT8xclEJSGvSK5uClUuqayUbF5IRK8e2/VSXIFHzEoBnNcvLBkHngnnd3CY7AFpUhF7w=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        tinymce.init({
            selector: '.myeditor'
        })
    </script>

    <script src="{{ asset('adminassets\plugins\bs-custom-file-input\bs-custom-file-input.min.js') }}"></script>
    <script>
        $(function() {
            bsCustomFileInput.init();
        });
    </script>

@stop
