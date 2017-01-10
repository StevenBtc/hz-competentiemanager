<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Student;
use App\Util\StatusCodes;
use Illuminate\Http\Request;

class StudentApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()
            ->json(['students' => Student::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = \Validator::make(
            $request->all(), [
            'name' => 'required|max:255',
            'student_code' => 'required|max:8|unique:students',
            'date_of_birth' => 'sometimes|date',
            'starting_date' => 'sometimes|date',
            'gender' => 'sometimes|max:10'
            ]
        );

        if ($validator->fails()) {
            return response()
                ->json($validator->messages(), StatusCodes::UNPROCESSABLE_ENTITY);
        }

        $student = Student::create($request->all());

        return response()
            ->json($student, StatusCodes::CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()
            ->json(Student::findOrFail($id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int                      $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = \Validator::make(
            $request->all(), [
            'name' => 'required|max:255',
            'student_code' => 'required|max:8|unique:students',
            'date_of_birth' => 'sometimes|date',
            'starting_date' => 'sometimes|date',
            'gender' => 'sometimes|max:10'
            ]
        );

        if ($validator->fails()) {
            return response()
                ->json($validator->messages(), StatusCodes::UNPROCESSABLE_ENTITY);
        }

        $student = Student::findOrFail($id)->change($request->all());

        return response()
            ->json($student);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Student::destroy($id);

        return response()
            ->json([], StatusCodes::NO_CONTENT);
    }
}