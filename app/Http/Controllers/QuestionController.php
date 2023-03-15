<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Question;
use App\Http\Trait\ResponseTrait;
use App\Models\Practical;

class QuestionController extends Controller
{
    use ResponseTrait;
    public function list($id)
    {
        $question = Question::where('id', $id)->first();
        if ($question)
            return $this->returnResponse(true, 'Question Detail', $question);
        else
            return $this->returnResponse(false, 'No Record Found');
    }

    public function create(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'question'          => 'required',
            'questionable_id'   => 'required|numeric',
            'questionable_type' => 'required|in:Practical,Theory'
        ]);

        if ($validation->fails())
            return $this->validationErrorsResponse($validation);

        $question = Question::create($request->only(['question','questionable_id'])+[
            'questionable_type' => "App\Models\\".$request->questionable_type
        ]);

        return $this->returnResponse(true, 'Question Inserted Successfully', $question);
    }

    public function update(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'id'            => 'required|exists:theories,id',
            'subject_name'  => 'max:40|string',
        ]);

        if ($validation->fails())
            return $this->validationErrorsResponse($validation);

        $question = Question::where('id', $request->id)->first();

        $question->update([
            'subject_name'  => $request->subject_name
        ]);

        return $this->returnResponse(true, 'Question Updated Successfully');
    }

    public function delete($id)
    {
        $question = Question::where('id', $id)->first();
        $question->delete();

        return $this->returnResponse(true, 'Record Deleted Successfully');
    }

    public function show($id)
    {
        $question = Question::where('id', $id)->first();
        return $this->returnResponse(true, 'Question Detail', $question);
    }
}
