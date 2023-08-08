@extends('master')

@php
    $title = "Edit Users"
@endphp

@section('title', $title)

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="card mt-4">
        <div class="card-body">
            <h1>{{ $title }}</h1>
            <form action="{{ route('subscribes.update', $subscribe) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert"
                                aria-hidden="true">×</button>
                            <h5><i class="icon fas fa-ban"></i>validation error</h5>

                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                </div>
                    @endif
                    <div class="mb-3">
                        <label for="member_id">Member id</label>
                        <select name="member_id"id="member_id"
                            class="form-control @error('member_id') is-invalid @enderror">
                            @foreach ($members as $member)
                                <option @selected($subscribe->member_id == $member->id) value="{{$member->id}}">
                                    {{ $member->type . ' - ' . $member->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('member_id')
                            <small class="invalid-feedback">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="value">value</label>
                        <input id="value" name="value" type="number" placeholder="value"
                            class="form-control @error('value') is-invalid @enderror " value="{{ old('member_id', $subscribe->value) }}" />
                        @error('value')
                            <small class="invalid-feedback">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="date">date</label>
                        <input id="date" name="date" type="date" placeholder="date"
                            class="form-control @error('date') is-invalid @enderror " value="{{ old('date',$subscribe->date) }}" />
                        @error('date')
                            <small class="invalid-feedback">{{ $message }}</small>
                        @enderror
                    </div>

                <button class="btn btn-success px-5"><i class="fas fa-save"></i> Edit</button>

            </form>
        </div>
    </div>
  </div>
</div>

@stop

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/6.3.1/tinymce.min.js" integrity="sha512-eV68QXP3t5Jbsf18jfqT8xclEJSGvSK5uClUuqayUbF5IRK8e2/VSXIFHzEoBnNcvLBkHngnnd3CY7AFpUhF7w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

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


