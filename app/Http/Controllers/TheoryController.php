<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Theory;
use App\Http\Trait\ResponseTrait;
use App\Models\Question;

class TheoryController extends Controller
{
    use ResponseTrait;
    public function list($id)
    {
        $theory = Theory::with('questions',)->where('id', $id)->first();
        if ($theory)
            return $this->returnResponse(true, 'Theory Detail', $theory);
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

        $theory = Theory::create($request->only(['subject_name']));
            
        return $this->returnResponse(true, 'Theory Subject Inserted Successfully', $theory);
    }

    public function update(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'id'            => 'required|exists:theories,id',
            'subject_name'  => 'max:40|string',
        ]);

        if ($validation->fails())
            return $this->validationErrorsResponse($validation);

        $theory = Theory::where('id', $request->id)->first();

        $theory->update([
            'subject_name'  => $request->subject_name
        ]);

        return $this->returnResponse(true, 'Theory Subject Updated Successfully');
    }

    public function delete($id)
    {
        $theory = Theory::where('id', $id)->first();
        $theory->delete();

        return $this->returnResponse(true, 'Record Deleted Successfully');
    }

    public function show($id)
    {
        $theory = Theory::where('id', $id)->first();
        return $this->returnResponse(true, 'Theory Subject Detail', $theory);
    }
}
