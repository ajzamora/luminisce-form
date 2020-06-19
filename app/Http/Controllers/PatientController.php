<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Patient;
use App\ContactPerson;
use App\PatientContactPerson;
use App\Referrer;
use App\PatientReferrer;
use App\Sex;
use App\CivilStatus;
use App\Form;
use App\CosmeticForm;

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
        $contact_person = $request->session()->get('contact_person');
        $patient_contact_person = $request->session()->get('patient_contact_person');
        $referrer = $request->session()->get('referrer');
        $patient_referrer = $request->session()->get('patient_referrer');

        $sexes = Sex::all()->sortBy('id');
        $civil_statuses = CivilStatus::all()->sortBy('id');
        return view('patients.create-step1')->with(compact(
            'patient', 'sexes', 'civil_statuses',
            'contact_person', 'patient_contact_person',
            'referrer', 'patient_referrer'
        ));
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
            'middle_initial'=>'nullable',
            'age'=>'nullable',
            'home_address'=>'nullable',
            'work_address'=>'nullable',
            'email'=>'nullable',
            'mobile_number'=>'nullable',
            'landline_number'=>'nullable',
            'sex_id'=>'nullable',
            'civil_status_id'=>'nullable',
            'contact_person_full_name'=>'nullable',
            'contact_person_address'=>'nullable',
            'contact_person_number'=>'nullable',
            'referrer_full_name'=>'nullable',
            'patient_contact_person_relationship'=>'nullable',
        ]);

        $patient = (empty($request->session()->get('patient'))) ?
                new Patient : $request->session()->get('patient');
        $patient->fill($validatedData);
        $patient->sex_id = $request->get('sex_id');
        $patient->civil_status_id = $request->get('civil_status_id');
        $request->session()->put('patient', $patient);

        $contact_person = (empty($request->session()->get('contact_person'))) ?
            new ContactPerson : $request->session()->get('contact_person');
        $contact_person->full_name = $request->get('contact_person_full_name');
        $contact_person->home_address = $request->get('contact_person_address');
        $contact_person->contact_number = $request->get('contact_person_number');
        $request->session()->put('contact_person', $contact_person);

        $patient_contact_person = (empty($request->session()->get('patient_contact_person'))) ?
            new PatientContactPerson : $request->session()->get('patient_contact_person');
        $patient_contact_person->relationship = $request->get('patient_contact_person_relationship');
        $request->session()->put('patient_contact_person', $patient_contact_person);

        $referrer = (empty($request->session()->get('referrer'))) ?
            new Referrer : $request->session()->get('referrer');
        $referrer->full_name = $request->get('referrer_full_name');
        $request->session()->put('referrer', $referrer);

        $patient_referrer = (empty($request->session()->get('patient_referrer'))) ?
            new PatientReferrer : $request->session()->get('patient_referrer');
        $patient_referrer->relationship = $request->get('patient_referrer_relationship');
        $request->session()->put('patient_referrer', $patient_referrer);

        return redirect('/patients/create-step2');
    }

    /**
     * Show the step 2 Form for creating a new patient.
     *
     * @return \Illuminate\Http\Response
     */
    public function createStep2(Request $request)
    {
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
            1 => ['id' => 1, 'type' => 'Medications' ],
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

        $form = $request->session()->get('form');
        return view('patients.create-step2')->with(compact(
            'form', 'data'
        ));
    }

    /**
     * Post Request to store step2 info in session
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postCreateStep2(Request $request)
    {

        $validatedData = $request->validate([
            'query06'=>'nullable', 'query07'=>'nullable', 'query09'=>'nullable',
            'query10'=>'nullable', 'query14'=>'nullable', 'query17'=>'nullable',
            'query16'=>'nullable', 'query18'=>'nullable',
        ]);

        $request->validate([
            'query01'=>'nullable', 'query02'=>'nullable', 'query03'=>'nullable',
            'query04'=>'nullable', 'query05'=>'nullable',
            'query08'=>'nullable',
            'query11'=>'nullable', 'query12'=>'nullable',
            'query13'=>'nullable', 'query15'=>'nullable',
            'query19_1'=>'nullable', 'query19_2'=>'nullable', 'query19_3'=>'nullable',
            'query19_5'=>'nullable', 'query19_4'=>'nullable', 'query19_6'=>'nullable',
        ]);
        $form = (empty($request->session()->get('form'))) ?
            new Form : $request->session()->get('form');
        $form->fill($validatedData);

        $form->query01 = $request->get('query01') . "|| " . $request->get('query01-extra');
        $form->query04 = $request->get('query04') . "|| " . $request->get('query04-extra');
        $form->query08 = $request->get('query08') . "|| " . $request->get('query08-extra');
        $form->query12 = $request->get('query12') . "|| " . $request->get('query12-extra');
        $form->query13 = $request->get('query13') . "|| " . $request->get('query13-extra');
        $form->query15 = $request->get('query15') . "|| " . $request->get('query15-extra');
        $form->query02 = $this->checkboxHelper($request, 'query02-', 6) . "|| " . $request->get("query02-extra");
        $form->query03 = $this->checkboxHelper($request, 'query03-', 3) . "|| " . $request->get("query03-extra");
        $form->query05 = $this->checkboxHelper($request, 'query05-', 3) . "|| " . $request->get("query05-extra");
        $form->query11 = $this->checkboxHelper($request, 'query11-', 5);
        $form->query19_1 = $request->get('query19-1bool') . "|| " . $request->get('query19-1what') . "|| " . $request->get('query19-1when') . "|| " . $request->get('query19-1where');
        $form->query19_2 = $request->get('query19-2bool') . "|| " . $request->get('query19-2what') . "|| " . $request->get('query19-2when') . "|| " . $request->get('query19-2where');
        $form->query19_3 = $request->get('query19-3bool') . "|| " . $request->get('query19-3what') . "|| " . $request->get('query19-3when') . "|| " . $request->get('query19-3where');
        $form->query19_4 = $request->get('query19-4bool') . "|| " . $request->get('query19-4what') . "|| " . $request->get('query19-4when') . "|| " . $request->get('query19-4where');
        $form->query19_5 = $request->get('query19-5bool') . "|| " . $request->get('query19-5what') . "|| " . $request->get('query19-5when') . "|| " . $request->get('query19-5where');
        $form->query19_6 = $request->get('query19-6bool') . "|| " . $request->get('query19-6what') . "|| " . $request->get('query19-6when') . "|| " . $request->get('query19-6where');

        $request->session()->put('form', $form);
        return redirect('/patients/create-step3');

    }

    // temp hack
    private function checkboxHelper($request, $key_prefix, $len) {
        if ($len <= 0) return null;
        $default_value = '0';
        $separator = ", ";
        $result = "";
        for ($x = 1; $x <= $len; $x++) {
            $result = $result .($request->get($key_prefix. $x) ?? $default_value) .$separator;
        }
        return str_replace("0,", "", $result);
    }
    /**
     * Show the step 3 Form for creating a new patient.
     *
     * @return \Illuminate\Http\Response
     */
    public function createStep3(Request $request)
    {
        $data['cosmetics'][0] = [
            1 => ['id' => 1, 'value' => '1 - Younger than' ],
            2 => ['id' => 2, 'value' => '2 - In between younger than and true age' ],
            3 => ['id' => 3, 'value' => '3 - True age' ],
            4 => ['id' => 4, 'value' => '4 - In between true age and  older than' ],
            5 => ['id' => 5, 'value' => '5 - Older than' ],
        ];

        $data['cosmetics'][1] = [
            1 => ['id' => 1, 'value' => '1 - Not concerned' ],
            2 => ['id' => 2, 'value' => '2 - In between not concerned and somewhat concerned' ],
            3 => ['id' => 3, 'value' => '3 - Somewhat concerned' ],
            4 => ['id' => 4, 'value' => '4 - In between somewhat concerned and very concerned' ],
            5 => ['id' => 5, 'value' => '5 - Very concerned' ],
        ];

        $patient = $request->session()->get('patient');;
        $contact_form = $request->session()->get('contact_form');
        return view('patients.create-step3')->with(compact('patient', 'contact_form','data'));
    }

    /**
     * Post Request to store step3 info in session
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postCreateStep3(Request $request)
    {
        $validatedData = $request->validate([
            'cquery01'=>'nullable', 'cquery02'=>'nullable', 'cquery03'=>'nullable',
        ]);
        $contact_form = (empty($request->session()->get('contact_form'))) ?
            new CosmeticForm : $request->session()->get('contact_form');
        $contact_form->fill($validatedData);
        $request->session()->put('contact_form', $contact_form);
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
        return view('patients.create-step4')->with(compact('patient'));
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
