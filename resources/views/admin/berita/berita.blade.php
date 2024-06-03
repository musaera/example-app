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
                                <th>Judul</th>
                                <th>Kategori</th>
                                <th>Deskripsi</th>
                                <th class="w-1">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $i = 1;
                            @endphp
                            @forelse ($berita as $item)
                                <tr>
                                    <td>
                                        {{ $i++ }}
                                    </td>
                                    <td>{{ Str::limit($item->judul_berita, 10, '...')  }}</td>
                                    <td>{{ $item->kategori->nama_kategori }}</td>
                                    <td>{{  Str::limit($item->isi_berita, 20, '...') }}</td>
                                    <td>
                                        <div class="btn-list flex-nowrap">
                                            <div class="dropdown">
                                                <button class="btn dropdown-toggle align-text-top" data-bs-toggle="dropdown"
                                                    aria-expanded="false">
                                                    Actions
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-end">
                                                    <a class="dropdown-item" href="{{ route('berita.edit', $item->id) }}"
                                                        data-bs-toggle="modal" data-bs-target="#modal-update">
                                                        edit
                                                    </a>
                                                    <form action="{{ route('berita.delete', $item->id) }}" method="POST">
                                                        @csrf
                                                        @method('delete')
                                                        <button type="submit"
                                                            onclick="return confirm('Apakah Anda Yakin Ingin Menghapus Berita Ini?')"
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
    <form action="{{ route('berita.perform') }}" method="post">
        @csrf
        @method('POST')
        <div class="modal modal-blur" id="modal-add" tabindex="-1" role="dialog" aria-modal="false">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add New Berita</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Judul</label>
                            <input type="text" name="judul_berita" class="form-control" autofocus autocomplete="off"
                                value="{{ old('judul_berita') }}">
                            @error('judul_berita')
                                <div class="text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Kategori</label>
                            <select class="form-select" id="kategori" name="kategori_id" autofocus autocomplete="off">
                                <option selected disabled>Pilih Kategori</option>
                                @foreach ($kategori as $item)
                                    <option value="{{ $item->id }}" @if (old('kategori_id') == $item->id) selected @endif>
                                        {{ $item->nama_kategori }}</option>
                                @endforeach
                            </select>
                            @error('kategori_id')
                                <div class="text-danger mt-2">{{ $message }}</div>
                            @enderror

                        </div>
                        <div class="mb-3">
                            <label class="form-label">Deskripsi</label>
                            <input type="text" name="isi_berita" class="form-control" autofocus autocomplete="off"
                                value="{{ old('isi_berita') }}">
                            @error('isi_berita')
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

    {{-- Edit Modal --}}
    @foreach ($berita as $item)

    <form action="{{ route('berita.update', $item->id) }}" method="post">
        @csrf
        @method('PUT')
        <div class="modal modal-blur" id="modal-update" tabindex="-1" role="dialog" aria-modal="false">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Update Berita</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Judul</label>
                            <input type="text" name="judul_berita" class="form-control" autofocus autocomplete="off"
                                value="{{ $item->judul_berita }}">
                            @error('judul_berita')
                                <div class="text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Kategori</label>
                            <select class="form-select" id="kategori" name="kategori_id" autofocus autocomplete="off">
                                <option selected disabled>Pilih Kategori</option>
                                @foreach ($kategori as $itemk)
                                    <option value="{{ $itemk->id }}" @if ($item->kategori_id == $itemk->id) selected @endif>
                                        {{ $itemk->nama_kategori }}</option>
                                @endforeach
                            </select>
                            @error('kategori_id')
                                <div class="text-danger mt-2">{{ $message }}</div>
                            @enderror

                        </div>
                        <div class="mb-3">
                            <label class="form-label">Deskripsi</label>
                            <input type="text" name="isi_berita" class="form-control" autofocus autocomplete="off"
                                value="{{ $item->isi_berita }}">
                            @error('isi_berita')
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
    @endforeach
@endsection
