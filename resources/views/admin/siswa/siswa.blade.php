@extends('layouts.app')

@section('content')
    <div class="container">
        @session('success')
            <div class="alert alert-important alert-success alert-dismissible position-absolute bottom-0 end-0 me-4"
                role="alert">
                <div class="d-flex">
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon alert-icon" width="24" height="24"
                            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M5 12l5 5l10 -10"></path>
                        </svg>
                    </div>
                    <div>
                        {{ session('success') }}
                    </div>
                </div>
                <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
            </div>
        @endsession
        <div class="col-12">
            <div class="mb-4">
                <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-add">Tambah</a>
            </div>
            <div class="card">
                <div class="table-responsive">
                    <table class="table table-vcenter table-mobile-md card-table">
                        <thead>
                            <tr>
                                <th class="w-4">Id</th>
                                <th>Siswa</th>
                                <th>Kelas</th>
                                <th>Domisili</th>
                                <th class="w-1">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $i = 1;
                            @endphp
                            @forelse ($siswa as $item)
                                <tr>
                                    <td>
                                        {{ $i++ }}
                                    </td>
                                    <td>
                                        {{ $item->nama_siswa }}
                                    </td>
                                    <td>
                                        {{ $item->kelas_siswa }}
                                    </td>
                                    <td>
                                        {{ $item->domisili_siswa }}
                                    </td>
                                    <td>
                                        <div class="btn-list flex-nowrap">
                                            <div class="dropdown">
                                                <button class="btn dropdown-toggle align-text-top" data-bs-toggle="dropdown"
                                                    aria-expanded="false">
                                                    Actions
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-end">
                                                    <a class="dropdown-item" href="{{ route('siswa.edit', $item->id) }}">
                                                        edit
                                                    </a>
                                                    <form action="{{ route('siswa.delete', $item->id) }}" method="POST">
                                                        @csrf
                                                        @method('delete')
                                                        <button type="submit"
                                                            onclick="return confirm('Apakah Anda Yakin Ingin Menghapus Data Siswa Ini?')"
                                                            class="dropdown-item">
                                                            Delete
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center">
                                        <p>Tidak Data</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- Add Modal --}}
    <form action="{{ route('siswa.perform') }}" method="post">
        @csrf
        @method('POST')
        <div class="modal modal-blur" id="modal-add" tabindex="-1" role="dialog" aria-modal="false">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add New Siswa</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Nama Siswa</label>
                            <input type="text" name="nama_siswa" class="form-control" autofocus autocomplete="off"
                                value="{{ old('nama_siswa') }}">
                            @error('nama_siswa')
                                <div class="text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Kelas Siswa</label>
                            <select class="form-select" id="floatingSelect" aria-label="Floating label select example"
                                name="kelas_siswa" class="form-control" autofocus autocomplete="off">
                                <option selected="" value="">Pilih Kelas</option>
                                <option value="10" @if (old('kelas_siswa') == 10) selected @endif>10</option>
                                <option value="11" @if (old('kelas_siswa') == 11) selected @endif>11</option>
                                <option value="12" @if (old('kelas_siswa') == 12) selected @endif>12</option>
                                <option value="13" @if (old('kelas_siswa') == 13) selected @endif>13</option>
                            </select>
                            @error('kelas_siswa')
                                <div class="text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Domisili Siswa</label>
                            <input type="text" name="domisili_siswa" class="form-control" autofocus autocomplete="off"
                                value="{{ old('domisili_siswa') }}">
                            @error('domisili_siswa')
                                <div class="text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal">
                            Cancel
                        </a>
                        <button class="btn btn-primary" type="submit" data-bs-dismiss="modal">
                            <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M12 5l0 14"></path>
                                <path d="M5 12l14 0"></path>
                            </svg>
                            Submit
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
