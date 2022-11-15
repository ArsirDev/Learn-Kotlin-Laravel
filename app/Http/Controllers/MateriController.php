<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use Illuminate\Support\Facades\Auth;
use App\Models\Materi;
use Illuminate\Support\Facades\Validator;


class MateriController extends BaseController
{
    public function setInputMateri(Request $request) 
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required',
            'another_description' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendError('data tidak boleh kosong.', $validator->errors());
        }

        $user = Auth::user();
        $path = $request->file('image')->store('images');
        $success = Materi::create([
            'owner_id' => $user->id,
            'name' => $user->name,
            'title' => $request->title,
            'description' => $request->description,
            'another_description' => $request->another_description,
            'image' => asset($path),
        ]);

        return $this->sendResponse($success, "Successfully saved");
    }

    public function setUpdate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required',
            'another_description' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendError('data tidak boleh kosong.', $validator->errors());
        }
        $path = $request->file('image')->store('images');
        $udapte = Materi::find($request->id)->update([
            'title' => $request->title,
            'description' => $request->description,
            'another_description' => $request->another_description,
            'image' => asset($path),
        ]);

        return $this->sendResponse($udapte, "Successfully update");
    }

    public function deleteMateri(Request $request) 
    {
        $success = Materi::find($request->id)->delete();

        return $this->sendResponse($success, "Successfully delete materi");
    }

    public function getDetailMateri(Request $request)
    {
        $id = $request->id;

        $success = Materi::find($id);

        return $this->sendResponse($success, "Successfully Show Detail");
    }

    public function getAllInputMateri()
    {
        $success = Materi::all();
        return $this->sendResponse($success, "Successfully show materi");
    }

    public function getInputMateriById() 
    {
        $user = Auth::user();
        $success = Materi::where('name', 'like', "%" . $user->name . "%")->get();
        return $this->sendResponse($success, "Successfully show materi");
    }
}
