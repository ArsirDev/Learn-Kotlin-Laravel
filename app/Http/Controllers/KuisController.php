<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use App\Models\Kuis;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class KuisController extends BaseController
{
    public function setInputKuis(Request $request) 
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'question' => 'required',
            'answer_a' => 'required',
            'answer_b' => 'required',
            'answer_c' => 'required',
            'answer_d' => 'required',
            'correct_answer' => 'required'
        ]);

        if ($validator->fails()) {
            return $this->sendError('data tidak boleh kosong.', $validator->errors());
        }

        $user = Auth::user();
        $path = $request->file('image')->store('images');
        $success = Kuis::create([
            'owner_id' => $user->id,
            'name' => $user->name,
            'title' => $request->title,
            'question' => $request->question,
            'answer_a' => $request->answer_a,
            'answer_b' => $request->answer_b,
            'answer_c' => $request->answer_c,
            'answer_d' => $request->answer_d,
            'correct_answer' => $request->correct_answer,
            'image' => asset($path),
        ]);

        return $this->sendResponse($success, "Successfully saved");
    }

    public function setUpdate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'question' => 'required',
            'answer_a' => 'required',
            'answer_b' => 'required',
            'answer_c' => 'required',
            'answer_d' => 'required',
            'correct_answer' => 'required'
        ]);

        if ($validator->fails()) {
            return $this->sendError('data tidak boleh kosong.', $validator->errors());
        }
        $path = $request->file('image')->store('images');
        $success = Kuis::find($request->id)->update([
            'title' => $request->title,
            'question' => $request->question,
            'answer_a' => $request->answer_a,
            'answer_b' => $request->answer_b,
            'answer_c' => $request->answer_c,
            'answer_d' => $request->answer_d,
            'correct_answer' => $request->correct_answer,
            'image' => asset($path),
        ]);

        return $this->sendResponse($success, "Successfully update");
    }

    public function deleteKuis(Request $request)
    {
        $success = Kuis::find($request->id)->delete();
    
        return $this->sendResponse($success, "Successfully delete kuis");
    }

    public function getDetailKuis(Request $request)
    {
        $id = $request->id;

        $success = Kuis::find($id);

        return $this->sendResponse($success, "Successfully Show Detail");
    }

    public function getAllInputKuis()
    {
        $success = Kuis::all();
        return $this->sendResponse($success, "Successfully show kuis");
    }

    public function getInputKuisById() 
    {
        $user = Auth::user();
        $success = Kuis::where('name', 'like', "%" . $user->name . "%")->get();
        return $this->sendResponse($success, "Successfully show kuis");
    }
}
