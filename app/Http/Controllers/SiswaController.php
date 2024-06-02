<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Validated;

class SiswaController extends Controller
{
    public function index()
    {
        $siswa = Siswa::get();
        return view("admin.siswa.siswa", compact("siswa"));
    }

    public function create()
    {
        return view("admin.siswa.create");
    }
    public function store(Request $request)
    {
        $request->validate([
            "nama_siswa" => "required",
            "kelas_siswa" => "required",
            "domisili_siswa" => "required",
        ], [
            "nama_siswa.required" => "Nama Siswa Harus Diisi",
            "kelas_siswa.required" => "Kelas Siswa Harus Diisi",
            "domisili_siswa.required" => "Domisili Siswa Harus Diisi",
        ]);

        Siswa::create([
            "nama_siswa" => $request->nama_siswa,
            "kelas_siswa" => $request->kelas_siswa,
            "domisili_siswa" => $request->domisili_siswa,
        ]);

        return redirect("/siswa")->with("success", "Berhasil Menambahkan Data Siswa");
    }
    public function edit($id)
    {
        $siswa = Siswa::findOrFail($id);
        return view("admin.siswa.edit", compact("siswa"));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            "nama_siswa" => "required",
            "kelas_siswa" => "required",
            "domisili_siswa" => "required",
        ], [
            "nama_siswa.required" => "Nama siswa Harus Diisi",
            "kelas_siswa.required" => "Kelas siswa Harus Diisi",
            "domisili_siswa.required" => "Domisili siswa Harus Diisi",
        ]);

        Siswa::findOrFail($id)->update([
            "nama_siswa" => $request->nama_siswa,
            "kelas_siswa" => $request->kelas_siswa,
            "domisili_siswa" => $request->domisili_siswa,
        ]);

        return redirect("/siswa")->with("success", "Berhasil Menamperbaharui Data siswa");
    }
    public function destroy($id)
    {
        Siswa::findOrFail($id)->delete();
        return redirect("/siswa")->with("success", "Berhasil Menghapus Data siswa");
    }
}
