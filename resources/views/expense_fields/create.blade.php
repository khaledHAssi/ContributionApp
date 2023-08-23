@extends('master')

@section('styles')


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
                <form action="{{ route('expense_fields.store') }}" method="POST" enctype="multipart/form-data">
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
                        <label for="notes">الملاحظات</label>
                        <input id="notes" name="notes" type="text" placeholder="الملاحظات"
                            class="form-control @error('notes') is-invalid @enderror " value="{{ old('name') }}" />
                        @error('notes')
                        <small class="invalid-feedback">{{ $message }}</small>
                        @enderror
                    </div>
                    <button class="btn btn-success px-5">إضافة<i class="fas fa-save"></i></button>





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
