@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="mb-5">
            <a href="/siswa" class="btn btn-secondary">Back</a>
        </div>
        <div class="card">
            <div class="card-body">
                <form action="{{ route('siswa.update', $siswa->id) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label class="form-label">Nama Siswa</label>
                        <input type="text" name="nama_siswa" class="form-control" autofocus autocomplete="off"
                            value="{{ $siswa->nama_siswa }}">
                        @error('nama_siswa')
                            <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Kelas Siswa</label>
                        <input type="text" name="kelas_siswa" class="form-control" autofocus autocomplete="off"
                            value="{{ $siswa->kelas_siswa }}">
                        @error('kelas_siswa')
                            <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Domisili Siswa</label>
                        <input type="text" name="domisili_siswa" class="form-control" autofocus autocomplete="off"
                            value="{{ $siswa->domisili_siswa }}">
                        @error('domisili_siswa')
                            <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <button class="btn btn-primary" type="submit">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endsection
