@extends('master')

@php
$title = "تعديل الصندوق"

@endphp

@section('title', $title)

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="card mt-4">
            <div class="card-body">
                <h1>{{ $title }}</h1>
                <form action="{{ route('investments.update', $investment) }}" method="POST"
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
                        <label for="name">الإسم</label>
                        <input id="name" name="name" type="text" placeholder="Name"
                            class="form-control @error('name') is-invalid @enderror "
                            value="{{ old('name', $investment->name) }}" />
                        @error('name')
                        <small class="invalid-feedback">{{ $message }}</small>
                        @enderror
                    </div>
                    <button class="btn btn-success px-5">تعديل<i class="mr-2 fas fa-save"></i></button>

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
