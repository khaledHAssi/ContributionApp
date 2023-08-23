@extends('master')

@section('styles')

    <style>
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
    </style>

@stop

@section('content')

    <div class="content">
        <div class="container-fluid">
            <div class="card mt-4">
                <div class="card-body">
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
                    <form action="{{ route('subscribes.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="member_id">العضو</label>
                            <select name="member_id"id="member_id"
                                class="form-control @error('member_id') is-invalid @enderror">
                                @foreach ($members as $member)
                                    <option value="{{ $member->id }}">{{ $member->name . ' - ' . $member->type }}
                                    </option>
                                @endforeach
                            </select>
                            @error('member_id')
                                <small class="invalid-feedback">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="investment_id">الصندوق</label>
                            <select name="investment_id" id="investment_id"
                                class="form-control @error('investment_id') is-invalid @enderror">
                                @foreach ($investments as $investment)
                                    <option value="{{ $investment->id }}">{{ $investment->name . ' - ' . $investment->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('investment_id')
                                <small class="invalid-feedback">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="name">الإسم</label>
                            <input id="name" name="name" type="text" placeholder="الإسم"
                                class="form-control @error('name') is-invalid @enderror " name="{{ old('name') }}" />
                            @error('name')
                                <small class="invalid-feedback">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="value">القيمة</label>
                            <input id="value" name="value" type="number" placeholder="القيمة"
                                class="form-control @error('value') is-invalid @enderror " value="{{ old('value') }}" />
                            @error('value')
                                <small class="invalid-feedback">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="date">التاريخ</label>
                            <input id="date" name="date" type="date" placeholder="التاريخ"
                                class="form-control @error('date') is-invalid @enderror " value="{{ old('date') }}" />
                            @error('date')
                                <small class="invalid-feedback">{{ $message }}</small>
                            @enderror
                        </div>
                        <button class="btn btn-success px-5"><i class="fas fa-save"></i> إضافة</button>





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
