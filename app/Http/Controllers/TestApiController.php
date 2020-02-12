<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Student;

class TestApiController extends Controller
{
    public function test(Request $request)
    {
    	$katakunci = $request->get('katakunci');
        $data = Student::where('nama','like','%' .$katakunci. '%')->paginate(5);
        return $data;
    }

    public function index()
    {
        return Student::all();
    }

    public function create(request $request)
    {
        $student = new Student;
        $student->nama  = $request->nama;
        $student->jk    = $request->jk;
        $student->save();

        return "Data Berhasil disimpan";
    }

    public function update(request $request, $id)
    {
        $student = Student::find($id);
        $student->nama  = $request->nama;
        $student->jk    = $request->jk;
        $student->save();

        return "Data Berhasil diubah";
    }

    public function delete($id)
    {
        $student = Student::find($id);
        $student->delete();

        return "Data Berhasil dihapus";
    }
}
