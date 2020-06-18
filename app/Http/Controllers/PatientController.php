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
     * Show the step 1 Form for creating a new patient.
     *
     * @return \Illuminate\Http\Response
     */
    public function createStep1(Request $request)
    {
        $patient = $request->session()->get('patient');
        $sexes = Sex::all()->sortBy('id');
        $civil_statuses = CivilStatus::all()->sortBy('id');
        return view('patients.create-step1')->with(compact('patient', 'sexes', 'civil_statuses'));
    }

    /**
     * Post Request to store step1 info in session
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postCreateStep1(Request $request)
    {
//        $validatedData = $request->validate([
//            'first_name'=>'required',
//            'last_name'=>'required',
//            'middle_initial'=>'string|nullable',
//            'age'=>'required|digits_between:1,2',
//            'home_address'=>'string|required',
//            'work_address'=>'string|nullable',
//            'email'=>'required',
//            'mobile_number'=>'required|digits_between:11,15',
//            'landline_number'=>'integer|nullable',
//            'sex_id'=>'required|between:0,2',
//            'civil_status_id'=>'required|between:0,5',
//        ]);
        $validatedData = $request->validate([
            'first_name'=>'required',
            'last_name'=>'required',
            'middle_initial'=>'string|nullable',
            'age'=>'required',
            'home_address'=>'required',
            'work_address'=>'string|nullable',
            'email'=>'required',
            'mobile_number'=>'required',
            'landline_number'=>'integer|nullable',
            'sex_id'=>'required',
            'civil_status_id'=>'required',
        ]);

        if(empty($request->session()->get('patient'))){
            $patient = new Patient();
            $patient->fill($validatedData);
            $patient->sex_id = $request->get('sex_id');
            $patient->civil_status_id = $request->get('civil_status_id');
            $request->session()->put('patient', $patient);
        }else{
            $patient = $request->session()->get('patient');
            $patient->fill($validatedData);
            $patient->sex_id = $request->get('sex_id');
            $patient->civil_status_id = $request->get('civil_status_id');
            $request->session()->put('patient', $patient);
        }
        return redirect('/patients/create-step2');
    }

    /**
     * Show the step 2 Form for creating a new patient.
     *
     * @return \Illuminate\Http\Response
     */
    public function createStep2(Request $request)
    {
//        $patient = $request->session()->get('patient');
//        return view('patients.create-step2',compact('patient'));
        $data['medications'][0] = [
            1 => ['id' => 1, 'name' => 'Oral Contraceptive Pills' ],
            2 => ['id' => 2, 'name' => 'Hormones' ],
            3 => ['id' => 3, 'name' => 'Herbal/Natural supplements' ],
            4 => ['id' => 4, 'name' => 'Stem Cells' ],
            5 => ['id' => 5, 'name' => 'Aspirin' ],
            6 => ['id' => 6, 'name' => 'Vitamin E' ],
        ];
        $data['implants'] = [
            1 => ['id' => 1, 'type' => 'Metal' ],
            2 => ['id' => 2, 'type' => 'Silicone' ],
            3 => ['id' => 3, 'type' => 'Collagen' ],
        ];
        $data['allergies'] = [
            1 => ['id' => 1, 'type' => 'medications' ],
            2 => ['id' => 2, 'type' => 'Foods' ],
            3 => ['id' => 3, 'type' => 'Latex' ],
        ];
        $data['bools'] = [
            1 => ['id' => 1, 'value' => 'yes' ],
            2 => ['id' => 2, 'value' => 'no' ],
        ];
        $data['medications'][1] = [
            1 => ['id' => 1, 'name' => 'Accutane' ],
            2 => ['id' => 2, 'name' => 'Roaccutane' ],
            3 => ['id' => 3, 'name' => 'Acnetrex' ],
            4 => ['id' => 4, 'name' => 'Acnotin' ],
            5 => ['id' => 5, 'name' => 'Anticoagulants' ],
        ];
        $data['procedures'] = [
            1 => ['id' => 1, 'type' => 'Chemical Peel' ],
            2 => ['id' => 2, 'type' => 'Facial Surgery' ],
            3 => ['id' => 3, 'type' => 'Botox Injections' ],
            4 => ['id' => 4, 'type' => 'Collagen / Filler injections' ],
            5 => ['id' => 5, 'type' => 'Body Slimming Treatment' ],
            6 => ['id' => 6, 'type' => 'Permanent Implant Tattoo' ],
        ];
        $patient = $request->session()->get('patient');
        $sexes = Sex::all()->sortBy('id');
        $civil_statuses = CivilStatus::all()->sortBy('id');
        return view('patients.create-step2')->with(compact('patient', 'sexes', 'civil_statuses', 'data'));
    }

    /**
     * Post Request to store step2 info in session
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postCreateStep2(Request $request)
    {
//        $patient = $request->session()->get('patient');
//        if(!isset($patient->patientImg)) {
//            $request->validate([
//                'patientimg' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
//            ]);
//
//            $fileName = "patientImage-" . time() . '.' . request()->patientimg->getClientOriginalExtension();
//
//            $request->patientimg->storeAs('patientimg', $fileName);
//
//            $patient = $request->session()->get('patient');
//
//            $patient->patientImg = $fileName;
//            $request->session()->put('patient', $patient);
//        }
        return redirect('/patients/create-step3');

    }

    /**
     * Show the step 3 Form for creating a new patient.
     *
     * @return \Illuminate\Http\Response
     */
    public function createStep3(Request $request)
    {
        $patient = $request->session()->get('patient');
        $sexes = Sex::all()->sortBy('id');
        $civil_statuses = CivilStatus::all()->sortBy('id');
        return view('patients.create-step3')->with(compact('patient', 'sexes', 'civil_statuses', 'data'));
    }

    /**
     * Post Request to store step3 info in session
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postCreateStep3(Request $request)
    {

        return redirect('/patients/create-step4');
    }

    /**
     * Show the step 4 Form for creating a new patient.
     *
     * @return \Illuminate\Http\Response
     */
    public function createStep4(Request $request)
    {
        $patient = $request->session()->get('patient');
        $sexes = Sex::all()->sortBy('id');
        $civil_statuses = CivilStatus::all()->sortBy('id');
        return view('patients.create-step4')->with(compact('patient', 'sexes', 'civil_statuses', 'data'));
    }

    /**
     * Post Request to store step4 info in session
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postCreateStep4(Request $request)
    {
        $patient = $request->session()->get('patient');
        dd($patient);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        $request->validate([
//            'first_name'=>'required',
//            'last_name'=>'required',
//            'middle_initial'=>'string|nullable',
//            'age'=>'required',
//            'home_address'=>'required',
//            'work_address'=>'string|nullable',
//            'email'=>'required',
//            'mobile_number'=>'required',
//            'landline_number'=>'integer|nullable',
//            'sex_id'=>'required',
//            'civil_status_id'=>'required',
//        ]);
//
//        $patient = new Patient([
//            'first_name' => $request->get('first_name'),
//            'last_name' => $request->get('last_name'),
//            'middle_initial' => $request->get('middle_initial'),
//            'age' => $request->get('age'),
//            'home_address' => $request->get('home_address'),
//            'work_address' => $request->get('work_address'),
//            'email' => $request->get('email'),
//            'mobile_number' => $request->get('mobile_number'),
//            'landline_number' => $request->get('landline_number'),
//        ]);
//        $patient->sex_id = $request->get('sex_id');
//        $patient->civil_status_id = $request->get('civil_status_id');
//        $patient->save();

        $patient = $request->session()->get('patient');
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
