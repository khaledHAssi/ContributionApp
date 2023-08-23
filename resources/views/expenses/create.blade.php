@extends('master')

@section('styles')

    {{-- <style>
    .questions_wrapper div {
        position: relative;
    }

    .questions_wrapper div span {
        width: 20px;
        height: 20px;
        background: #333;
        display: flex;
        justify-content: center;
        /* align-items: center; */
        color: #fff;
        font-size: 36px;
        line-height: 14px;
        border-radius: 50px;
        cursor: pointer;
        position: absolute;
        right: 8px;
        top: 8px;
        display: none;
    }

    .questions_wrapper div:hover span {
        display: flex;
    }

    .questions_wrapper div span:hover {
        background: #f00;
    }
</style> --}}

@stop
@php
    $title = 'إضافة صرف';

@endphp
@section('content')

    <div class="content">
        <div class="container-fluid">
            <div class="card mt-4">
                <div class="card-body">
                    <div class="card-body">
                    <h1>{{ $title }}</h1>
                        @if (session('msg'))
                        <div class="alert alert-{{ session('type') }}">{{ session('msg') }}</div>
                        @endif
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

                    <form action="{{ route('expenses.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label for="name">الإسم</label>
                            <input id="name" name="name" type="text" placeholder="الإسم"
                                class="form-control @error('name') is-invalid @enderror " value="{{ old('name') }}" />
                            @error('name')
                                <small class="invalid-feedback">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="details">التفاصيل</label>
                            <input id="details" name="details" type="text" placeholder="التفاصيل"
                                class="form-control @error('details') is-invalid @enderror " value="{{ old('details') }}" />
                            @error('details')
                                <small class="invalid-feedback">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="investment_id">الصندوق</label>
                            <select name="investment_id" id="investment_id" class="form-control" @error('investment_id') is-invalid @enderror>
                                @foreach ($investments as $item)
                                    <option value="{{$item->id}}">
                                        {{ $item->name . '-' . $item->total }}
                                    </option>
                                @endforeach
                            </select>
                            @error('investment_id')
                                <small class="invalid-feedback">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="total_expenses">مبلغ الصرف</label>
                            <input id="total_expenses" name="total_expenses" type="number" placeholder=""
                                class="form-control @error('total_expenses') is-invalid @enderror "
                                value="{{ old('name') }}" />
                            @error('total_expenses')
                                <small class="invalid-feedback">{{ $message }}</small>
                            @enderror
                        </div>

                        <button class="btn btn-success px-3">إضافة<i class="mr-2 fas fa-save"></i></button>





                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
@section('scripts')
    <script src="{{ asset('adminassets\plugins\bs-custom-file-input\bs-custom-file-input.min.js') }}"></script>
    <script>
        $(function() {
            bsCustomFileInput.init();
        });
    </script>
@endsection

@stop
