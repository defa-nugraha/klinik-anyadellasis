<?php

namespace App\Http\Controllers;

use App\Models\ICDModel;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class ICDController extends Controller
{
    function index()
    {
        $data = [
            'icd' => ICDModel::all()
        ];

        return view('admin.icd.index', $data);
    }

    function create(Request $request)
    {
        $request->validate([
            'code' => 'required',
            'description' => 'required',
            'category' => 'required',
            'type' => 'required'
        ]);

        $data = [
            'code' => $request->code,
            'description' => $request->description,
            'category' => $request->category,
            'type' => $request->type,
        ];

        $create = ICDModel::create($data);

        if ($create) {
            Alert::success('ICD Ditambahkan!');
        } else {
            Alert::error('ICD Gagal ditambahkan!');
        }

        return redirect()->back();
    }

    function update(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'code' => 'required',
            'description' => 'required',
            'category' => 'required',
            'type' => 'required'
        ]);

        $data = [
            'code' => $request->code,
            'description' => $request->description,
            'category' => $request->category,
            'type' => $request->type,
        ];

        $update = ICDModel::where('id', decryptStr($request->id))->update($data);

        if ($update) {
            Alert::success('ICD diupdate!');
        } else {
            Alert::error('ICD Gagal diupdate!');
        }

        return redirect()->back();
    }

    function delete($id)
    {
        $data = ICDModel::find(decryptStr($id));
        if ($data) {
            $data->delete();
            Alert::success('ICD dihapus!');
        } else {
            Alert::error('ICD gagal dihapus!');
        }

        return redirect()->back();
    }
}
