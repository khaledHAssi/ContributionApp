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
                <form action="{{ route('supervisors.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="name">اسم المشرف</label>
                        <input id="name" name="name" type="text" placeholder="الإسم" class="form-control
                         @error('name') is-invalid @enderror " value="{{ old('name') }}" />

                        @error('name')
                        <small class="invalid-feedback">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="email">الأيميل</label>
                        <input id="email" name="email" type="email" placeholder="example@gmail.com"
                            class="form-control @error('email') is-invalid @enderror " value="{{ old('email') }}" />
                        @error('email')
                        <small class="invalid-feedback">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputFile">اضافة صورة</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="user_image" id="exampleInputFile" value="{{ old('user_image') }}"
                                    @error('user_image') is-invalid @enderror >
                                <label class="custom-file-label" for="exampleInputFile">Choose Img</label>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="phone">رقم الهاتف</label>
                        <input id="phone" name="phone" type="number" placeholder=""
                            class="form-control @error('phone') is-invalid @enderror " value="{{ old('phone') }}" />
                        @error('phone')
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

@stop
@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/6.3.1/tinymce.min.js"
    integrity="sha512-eV68QXP3t5Jbsf18jfqT8xclEJSGvSK5uClUuqayUbF5IRK8e2/VSXIFHzEoBnNcvLBkHngnnd3CY7AFpUhF7w=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    @stop
    @section('scripts')
    <script src="{{ asset('adminassets\plugins\bs-custom-file-input\bs-custom-file-input.min.js') }}"></script>
    <script>
        $(function() {
            bsCustomFileInput.init();
        });
    </script>
@endsection
