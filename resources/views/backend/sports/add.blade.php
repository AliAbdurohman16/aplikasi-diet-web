@extends('layouts.backend.main')

@section('title', 'Tambah Data Olahraga')

@section('css')
<link rel="stylesheet" href="{{ asset('backend') }}/libs/select2/select2.min.css"/>
<link rel="stylesheet" href="{{ asset('backend') }}/css/select2.css"/>
<link rel="stylesheet" href="{{ asset('backend') }}/libs/summernote/summernote.min.css"/>
@endsection

@section('content')
<div class="container-fluid">
    <div class="layout-specing">
        <div class="d-md-flex justify-content-between align-items-center">
            <h5 class="mb-0">Tambah Data Olahraga</h5>

            <nav aria-label="breadcrumb" class="d-inline-block">
                <ul class="breadcrumb bg-transparent rounded mb-0 p-0">
                    <li class="breadcrumb-item text-capitalize"><a href="{{ route('sports.index') }}">Olahraga</a></li>
                    <li class="breadcrumb-item text-capitalize active" aria-current="page">Tambah Data</li>
                </ul>
            </nav>
        </div>

        <a href="{{ route('sports.index') }}" class="btn btn-warning btn-sm mt-4"><i class="fa-solid fa-arrow-left"></i> Kembali</a>

        <div class="col-lg-12 mt-4">
            <div class="card">
                <div class="container">
                    <div class="card-body">
                        <form action="{{ route('sports.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row mt-4">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Foto Olahraga <span class="text-danger">*</span></label>
                                        <div class="row">
                                            <div class="col-sm-3 mb-2">
                                                <img src="{{ asset('default/image.png') }}" width="100px" alt="image" class="img-thumbnail img-preview">
                                            </div>
                                            <div class="col-sm-9">
                                                <input type="file" name="image" id="image" class="form-control @error('image') is-invalid @enderror" value="{{ old('image') }}" accept="image/*" onchange="previewImg()">
                                                @error('image')
                                                    <span class="invalid-feedback errorimage" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div><!--end col-->
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Nama Olahraga <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Nama Olahraga" name="name" value="{{ old('name') }}" autocomplete="name">
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div><!--end col-->
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Jumlah Set <span class="text-danger">*</span></label>
                                        <div class="row">
                                            <div class="col-7 col-sm-8 mb-2">
                                                <input name="set" id="set" type="number" class="form-control @error('set') is-invalid @enderror" placeholder="Jumlah Set" value="{{ old('set') }}">
                                                @error('set')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="col-5 col-sm-4"><p class="mt-1">Kali</p></div>
                                        </div>
                                    </div>
                                </div><!--end col-->
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Durasi <span class="text-danger">*</span></label>
                                        <div class="row">
                                            <div class="col-7 col-sm-8 mb-2">
                                                <input name="time" id="time" type="number" class="form-control @error('time') is-invalid @enderror" placeholder="Waktu" value="{{ old('time') }}">
                                                @error('time')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="col-5 col-sm-4">
                                                <select name="per" id="per" class="form-control select2 @error('per') is-invalid @enderror">
                                                    <option value="">Pilih Per</option>
                                                    <option value="Detik" {{ old('per') == 'Detik' ? 'selected' : '' }}>Detik</option>
                                                    <option value="Menit" {{ old('per') == 'Menit' ? 'selected' : '' }}>Menit</option>
                                                    <option value="Jam" {{ old('per') == 'Jam' ? 'selected' : '' }}>Jam</option>
                                                </select>
                                                @error('per')
                                                    <span class="invalid-feedback errorname" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div><!--end col-->
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Kalori <span class="text-danger">*</span></label>
                                        <div class="row">
                                            <div class="col-7 col-sm-8 mb-2">
                                                <input name="calories" id="calories" type="number" class="form-control @error('calories') is-invalid @enderror" placeholder="Kalori" value="{{ old('calories') }}">
                                                @error('calories')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="col-5 col-sm-4"><p class="mt-1">/gram</p></div>
                                        </div>
                                    </div>
                                </div><!--end col-->
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Lemak <span class="text-danger">*</span></label>
                                        <div class="row">
                                            <div class="col-7 col-sm-8 mb-2">
                                                <input name="fat" id="fat" type="number" class="form-control @error('fat') is-invalid @enderror" placeholder="Lemak" value="{{ old('fat') }}">
                                                @error('fat')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="col-5 col-sm-4"><p class="mt-1">/gram</p></div>
                                        </div>
                                    </div>
                                </div><!--end col-->
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label">Deskripsi Olahraga  <span class="text-danger">*</span></label>
                                        <textarea name="description" id="summernote" rows="4" class="form-control @error('description') is-invalid @enderror" placeholder="Deskripsi Olahraga">{{ old('description') }}</textarea>
                                        @error('description')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div><!--end row-->
                            <div class="row">
                                <div class="col-sm-12">
                                    <input type="submit" id="submit" name="send" class="btn btn-primary" value="Simpan">
                                </div><!--end col-->
                            </div><!--end row-->
                        </form><!--end form-->
                    </div>
                </div>
            </div>
        </div>
        <!--end col-->
    </div>
</div><!--end container-->
@endsection

@section('javascript')
<script src="{{ asset('backend') }}/libs/select2/select2.min.js"></script>
<script src="{{ asset('backend') }}/libs/summernote/summernote.min.js"></script>
<script>
    $(document).ready(function() {
        $('.select2').select2();
        $('#summernote').summernote();
    });

    // function preview image
    function previewImg() {
        const logo = document.querySelector('#image');
        const imgPreview = document.querySelector('.img-preview');
        const fileImg = new FileReader();
        fileImg.readAsDataURL(logo.files[0]);
        fileImg.onload = function(e) {
            imgPreview.src = e.target.result;
        }
    }
</script>
@endsection
