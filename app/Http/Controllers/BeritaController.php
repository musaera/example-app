<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Validated;

class BeritaController extends Controller
{
    public function index()
    {
        $berita = Berita::get();
        $kategori = Kategori::get();

        return view("admin.berita.berita", compact("berita", "kategori"));
    }
    public function create()
    {
        return view("admin.berita.create");
    }
    public function store(Request $request)
    {
        $request->validate([
            "judul_berita" => "required",
            "kategori_id" => "required",
            "isi_berita" => "required",
        ], [
            "judul_berita.required" => "Judul Berita Harus Diisi",
            "kategori_id.required" => "Kategori Harus Diisi",
            "isi_berita.required" => "Deskripsi Berita Harus Diisi",
        ]);

        Berita::create([
            "judul_berita" => $request->judul_berita,
            "kategori_id" => $request->kategori_id,
            "isi_berita" => $request->isi_berita,
        ]);

        return redirect("/berita")->with("success", "Berhasil Menambahkan Data Berita");
    }
    public function edit($id)
    {
        $kategori = Berita::findOrFail($id);
        return view("admin.berita.edit", compact("berita"));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            "judul_berita" => "required",
            "kategori_id" => "required",
            "isi_berita" => "required",
        ], [
            "judul_berita.required" => "Judul Berita Harus Diisi",
            "kategori_id.required" => "Kategori Harus Diisi",
            "isi_berita.required" => "Deskripsi Berita Harus Diisi",
        ]);

        berita::findOrFail($id)->update([
            "judul_berita" => $request->judul_berita,
            "kategori_id" => $request->kategori_id,
            "isi_berita" => $request->isi_berita,
        ]);
        return redirect("/berita")->with("success", "Berhasil Menamperbaharui Data Berita");
    }
    public function destroy($id)
    {
        Berita::findOrFail($id)->delete();
        return redirect("/berita")->with("success", "Berhasil Menghapus Data Berita");
    }
}
