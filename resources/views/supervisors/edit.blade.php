@extends('master')



@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="card mt-4">
            <div class="card-body">
                <h1>تعديل المشرفين</h1>
                <form action="{{ route('supervisors.update', $supervisor) }}" method="POST"
                    enctype="multipart/form-data">
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
                        <label for="name">اسم المشرف</label>
                        <input id="name" name="name" type="text" placeholder="الإسم" class="form-control
                        @error('name') is-invalid @enderror " value="{{ old('name' , $supervisor->name) }}" />
                        @error('name')
                        <small class="invalid-feedback">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="email">الأيميل</label>
                        <input id="email" name="email" type="email" placeholder="example@gmail.com"
                            class="form-control @error('email') is-invalid @enderror "
                            value="{{ old('email' ,$supervisor->email) }}" />
                        @error('email')
                        <small class="invalid-feedback">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputFile">تعديل الصورة</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input @error('user_image') is-invalid @enderror"
                                    id="exampleInputFile" name="user_image">
                                <label class="custom-file-label" for="exampleInputFile">Choose img</label>
                                @error('user_image')
                                <small class="invalid-feedback">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="phone">رقم الهاتف</label>
                        <input id="phone" name="phone" type="number" placeholder="رقم الجوال"
                            class="form-control @error('phone') is-invalid @enderror "
                            value="{{ old('phone' ,$supervisor->phone) }}" />
                        @error('phone')
                        <small class=" invalid-feedback">{{ $message }}</small>
                        @enderror
                    </div>



                    <button class="btn btn-success px-3">تعديل<i class="mr-2 fas fa-save"></i> </button>

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