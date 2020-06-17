<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Patient;
use App\Sex;
use App\CivilStatus;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $patients = Patient::all();
        return view('patients.index', compact('patients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sexes = Sex::all()->sortBy('id');
        $civil_statuses = CivilStatus::all()->sortBy('id');
        return view('patients.create')->with(compact('sexes', 'civil_statuses'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'first_name'=>'required',
            'last_name'=>'required',
            'age'=>'required',
            'home_address'=>'required',
            'email'=>'required',
            'mobile_number'=>'required',
            'sex_id'=>'required',
            'civil_status_id'=>'required',
        ]);

        $patient = new Patient([
            'first_name' => $request->get('first_name'),
            'last_name' => $request->get('last_name'),
            'middle_initial' => $request->get('middle_initial'),
            'age' => $request->get('age'),
            'home_address' => $request->get('home_address'),
            'work_address' => $request->get('work_address'),
            'email' => $request->get('email'),
            'mobile_number' => $request->get('mobile_number'),
            'landline_number' => $request->get('landline_number'),
            'sex_id' => $request->get('sex_id'),
            'civil_status_id' => $request->get('civil_status_id'),
        ]);
        $patient->sex_id = $request->get('sex_id');
        $patient->civil_status_id = $request->get('civil_status_id');
        $patient->save();

        return redirect('/patients')->with('success', 'Patients saved!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $patient = Patient::find($id);
        $sexes = Sex::all()->sortBy('id');
        $civil_statuses = CivilStatus::all()->sortBy('id');
        return view('patients.edit')->with(compact('patient', 'sexes', 'civil_statuses'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'first_name'=>'required',
            'last_name'=>'required',
            'age'=>'required',
            'home_address'=>'required',
            'email'=>'required',
            'mobile_number'=>'required',
            'sex_id'=>'required',
            'civil_status_id'=>'required',
        ]);

        $patient = Patient::find($id);
        $patient->first_name = $request->get('first_name');
        $patient->last_name = $request->get('last_name');
        $patient->middle_initial = $request->get('middle_initial');
        $patient->age = $request->get('age');
        $patient->home_address = $request->get('home_address');
        $patient->work_address = $request->get('work_address');
        $patient->email = $request->get('email');
        $patient->mobile_number = $request->get('mobile_number');
        $patient->landline_number = $request->get('landline_number');
        $patient->sex_id = $request->get('sex_id');
        $patient->civil_status_id = $request->get('civil_status_id');
        $patient->save();
        return redirect('/patients')->with('success', 'Patient updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $patient = Patient::find($id);
        $patient->delete();
        return redirect('/patients')->with('success', 'Patient deleted!');
    }
}
