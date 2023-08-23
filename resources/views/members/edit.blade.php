@extends('master')

@php
$title = "تعديل المستخدمين"
@endphp

@section('title', $title)

@section('content')
<div class="content " >
    <div class="container-fluid">
        <div class="card mt-4">
            <div class="card-body">
                <h1>{{ $title }}</h1>
                <form action="{{ route('members.update', $member) }}" method="POST" enctype="multipart/form-data">
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
                            value="{{ old('name', $member->name) }}" />
                        @error('name')
                        <small class="invalid-feedback">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="type">النوع</label>
                        <select name="type" class="form-control @error('type') is-invalid @enderror">
                            <option value="subscriber" @if(old('type', $member->type) === 'subscriber') selected
                                @endif>subscriber</option>
                            <option value="contributor" @if(old('type', $member->type) === 'contributor') selected
                                @endif>Contributor</option>
                        </select>

                        @error('type')
                        <small class="invalid-feedback">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="job">المهنة</label>
                        <input id="job" name="job" type="text" placeholder="User Name"
                            class="form-control @error('job') is-invalid @enderror "
                            value="{{ old('job', $member->job) }}" />
                        @error('job')
                        <small class="invalid-feedback">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="phone">رقم الجوال</label>
                        <input id="phone" name="phone" type="number" placeholder="Phone"
                            class="form-control @error('phone') is-invalid @enderror "
                            value="{{ old('phone', $member->phone) }}" />
                        @error('phone')
                        <small class="invalid-feedback">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="identification_number">رقم الهوية</label>
                        <input id="identification_number" name="identification_number" type="number"
                            placeholder="identification_number"
                            class="form-control @error('identification_number') is-invalid @enderror "
                            value="{{ old('identification_number', $member->identification_number) }}" />
                        @error('identification_number')
                        <small class="invalid-feedback">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="salary">الراتب</label>
                        <input id="salary" name="salary" type="number" placeholder="salary"
                            class="form-control @error('salary') is-invalid @enderror "
                            value="{{ old('salary', $member->salary) }}" />
                        @error('salary')
                        <small class="invalid-feedback">{{ $message }}</small>
                        @enderror
                    </div>
                    {{-- <div class="mb-3">
                        <label for="family_members_number">family_members_number</label>
                        <input id="family_members_number" name="family_members_number" type="number"
                            placeholder="family_members_number"
                            class="form-control @error('family_members_number') is-invalid @enderror "
                            value="{{ old('family_members_number', $member->family_members_number) }}" />
                        @error('family_members_number')
                        <small class="invalid-feedback">{{ $message }}</small>
                        @enderror
                    </div> --}}
                    <div class="mb-3">
                        <label for="contributions">المساهمة</label>
                        <input id="contributions" name="contributions" type="number" placeholder="contributions"
                            class="form-control @error('contributions') is-invalid @enderror "
                            value="{{ old('contributions', $member->contributions) }}" />
                        @error('contributions')
                        <small class="invalid-feedback">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="birthday">تاريخ الميلاد</label>
                        <input id="birthday" name="birthday" type="date" placeholder="birthday"
                            class="form-control @error('birthday') is-invalid @enderror "
                            value="{{ old('birthday', $member->birthday) }}" />
                        @error('birthday')
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
