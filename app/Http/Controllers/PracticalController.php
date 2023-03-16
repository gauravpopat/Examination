<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Practical;
use App\Http\Trait\ResponseTrait;

class PracticalController extends Controller
{
    use ResponseTrait;
    public function list($id)
    {
        $practical = Practical::with('questions')->where('id', $id)->first();
        if ($practical)
            return $this->returnResponse(true, 'Practical Detail',$practical);
        else
            return $this->returnResponse(false, 'No Record Found');
    }

    public function create(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'subject_name'   => 'required|max:40|string'
        ]);

        if ($validation->fails())
            return $this->validationErrorsResponse($validation);

        $practical = Practical::create($request->only(['subject_name']));

        return $this->returnResponse(true, 'Practical Subject Inserted Successfully', $practical);
    }

    public function addQuestion(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'subject_name'  => 'required|exists:practicals,subject_name',
            'question'      => 'required'
        ]);

        if ($validation->fails())
            return $this->validationErrorsResponse($validation);

        $practical = Practical::where('subject_name',$request->subject_name)->first();
        $practical->question()->create(['question'=>$request->question]);

        return $this->returnResponse(true, 'Practical Question Inserted Successfully');

    }

    public function update(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'id'            => 'required|exists:practicals,id',
            'subject_name'  => 'max:40|string',
        ]);

        if ($validation->fails())
            return $this->validationErrorsResponse($validation);

        $practical = Practical::where('id', $request->id)->first();

        $practical->update([
            'subject_name'  => $request->subject_name
        ]);

        return $this->returnResponse(true, 'Practical Subject Updated Successfully');
    }

    public function delete($id)
    {
        $practical = Practical::where('id', $id)->first();
        $practical->delete();

        return $this->returnResponse(true, 'Record Deleted Successfully');
    }

    public function show($id)
    {
        $practical = Practical::where('id', $id)->first();
        return $this->returnResponse(true, 'Practical Subject Detail', $practical);
    }
}
