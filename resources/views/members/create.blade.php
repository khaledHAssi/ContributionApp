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
                                <h5><i class="icon fas fa-ban"></i>validation error</h5>

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
                            <label for="name">Name</label>
                            <input id="name" name="name" type="text" placeholder="Name"
                                class="form-control @error('name') is-invalid @enderror " value="{{ old('name') }}" />
                            @error('name')
                                <small class="invalid-feedback">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="type">Type</label>
                            <select name="type" class="form-control @error('type') is-invalid @enderror">
                                <option @selected(old('type') == 'subscriber') value="subscriber">subscriber</option>
                                <option @selected(old('type') == 'contributor') value="contributor">Contributor</option>
                            </select>
                            @error('type')
                                <small class="invalid-feedback">{{ $message }}</small>
                            @enderror
                        </div>
                <div class="mb-3">
                    <label for="job">job</label>
                    <input id="job" name="job" type="text" placeholder="User Name"
                        class="form-control @error('job') is-invalid @enderror " value="{{ old('job') }}" />
                    @error('job')
                        <small class="invalid-feedback">{{ $message }}</small>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="phone">phone</label>
                    <input id="phone" name="phone" type="number" placeholder="Phone"
                        class="form-control @error('phone') is-invalid @enderror " value="{{ old('phone') }}" />
                    @error('phone')
                        <small class="invalid-feedback">{{ $message }}</small>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="identification_number">identification_number</label>
                    <input id="identification_number" name="identification_number" type="number"
                        placeholder="identification_number"
                        class="form-control @error('identification_number') is-invalid @enderror "
                        value="{{ old('identification_number') }}" />
                    @error('identification_number')
                        <small class="invalid-feedback">{{ $message }}</small>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="monthly_number">monthly_number</label>
                    <input id="monthly_number" name="monthly_number" type="number" placeholder="monthly_number"
                        class="form-control @error('monthly_number') is-invalid @enderror "
                        value="{{ old('monthly_number') }}" />
                    @error('monthly_number')
                        <small class="invalid-feedback">{{ $message }}</small>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="family_members_number">family_members_number</label>
                    <input id="family_members_number" name="family_members_number" type="number"
                        placeholder="family_members_number"
                        class="form-control @error('family_members_number') is-invalid @enderror "
                        value="{{ old('family_members_number') }}" />
                    @error('family_members_number')
                        <small class="invalid-feedback">{{ $message }}</small>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="contributions">contributions</label>
                    <input id="contributions" name="contributions" type="number" placeholder="contributions"
                        class="form-control @error('contributions') is-invalid @enderror "
                        value="{{ old('contributions') }}" />
                    @error('contributions')
                        <small class="invalid-feedback">{{ $message }}</small>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="birthday">birthday</label>
                    <input id="birthday" name="birthday" type="date" placeholder="birthday"
                        class="form-control @error('birthday') is-invalid @enderror " value="{{ old('birthday') }}" />
                    @error('birthday')
                        <small class="invalid-feedback">{{ $message }}</small>
                    @enderror
                </div>
                <button class="btn btn-success px-5"><i class="fas fa-save"></i> Add</button>





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
