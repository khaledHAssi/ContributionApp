@extends('master')


@section('content')

    <div class="content ">
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
                    <form action="{{ route('members.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="name">الإسم</label>
                            <input id="name" name="name" type="text" placeholder="الإسم"
                                class="form-control @error('name') is-invalid @enderror " value="{{ old('name') }}" />
                            @error('name')
                                <small class="invalid-feedback">{{ $message }}</small>
                            @enderror
                        </div>
                        @php
                        $id = request('id');
                    @endphp

                        @if($id)
                        <input type="hidden" name="supervisor_id" value="{{ $id }}">
                    @else
                    <div class="mb-3">
                        <label for="supervisor_id">المشرف</label>
                        <select name="supervisor_id" id="supervisor_id" class="form-control @error('supervisor_id') is-invalid @enderror">
                            @foreach ($supervisors as $member)
                                <option value="{{ $member->id }}">{{ $member->name . ' - ' . $member->email }}</option>
                            @endforeach
                        </select>
                        @error('supervisor_id')
                            <small class="invalid-feedback">{{ $message }}</small>
                        @enderror
                    </div>
                    @endif


                        <div class="mb-3">
                            <label for="type">النوع</label>
                            <select name="type" class="form-control @error('type') is-invalid @enderror">
                                <option @selected(old('type') == 'subscriber') value="subscriber">مشترك</option>
                                <option @selected(old('type') == 'contributor') value="contributor">متبرع</option>
                            </select>
                            @error('type')
                                <small class="invalid-feedback">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="job">المهنة</label>
                            <input id="job" name="job" type="text" placeholder=" المهنة"
                                class="form-control @error('job') is-invalid @enderror " value="{{ old('job') }}" />
                            @error('job')
                                <small class="invalid-feedback">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="phone">رقم الجوال</label>
                            <input id="phone" name="phone" type="number" placeholder="رقم الجوال"
                                class="form-control @error('phone') is-invalid @enderror " value="{{ old('phone') }}" />
                            @error('phone')
                                <small class="invalid-feedback">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="identification_number">رقم الهوية</label>
                            <input id="identification_number" name="identification_number" type="number"
                                placeholder="رقم الهوية"
                                class="form-control @error('identification_number') is-invalid @enderror "
                                value="{{ old('identification_number') }}" />
                            @error('identification_number')
                                <small class="invalid-feedback">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="salary">الراتب</label>
                            <input id="salary" name="salary" type="number" placeholder="الراتب"
                                class="form-control @error('salary') is-invalid @enderror " value="{{ old('salary') }}" />
                            @error('salary')
                                <small class="invalid-feedback">{{ $message }}</small>
                            @enderror
                        </div>
                        {{-- <div class="mb-3">
                    <label for="family_members_number">family_members_number</label>
                    <input id="family_members_number" name="family_members_number" type="number"
                        placeholder=""
                        class="form-control @error('family_members_number') is-invalid @enderror "
                        value="{{ old('family_members_number') }}" />
                    @error('family_members_number')
                        <small class="invalid-feedback">{{ $message }}</small>
                    @enderror
                </div> --}}
                        <div class="mb-3">
                            <label for="contributions">المساهمة</label>
                            <input id="contributions" name="contributions" type="number" placeholder="المساهمة"
                                class="form-control @error('contributions') is-invalid @enderror "
                                value="{{ old('contributions') }}" />
                            @error('contributions')
                                <small class="invalid-feedback">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="birthday">تاريخ الميلاد</label>
                            <input id="birthday" name="birthday" type="date" placeholder="تاريخ الميلاد"
                                class="form-control @error('birthday') is-invalid @enderror "
                                value="{{ old('birthday') }}" />
                            @error('birthday')
                                <small class="invalid-feedback">{{ $message }}</small>
                            @enderror
                        </div>
                        <button class="btn btn-success px-3">إضافة<i class="fas fa-save "></i></button>
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
