<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Patient;
use App\ContactPerson;
use App\Referrer;
use App\Sex;
use App\CivilStatus;
use App\PatientForm;
use App\CosmeticForm;
use App\Transaction;
use Illuminate\Support\Facades\Auth;

class PatientController extends Controller
{
    public function index()
    {
        $patients = Patient::all();
//        $patients = Patient::find(2);
//
//        echo $patients->contactPerson;
//        dd($patients->contactPerson);
        return view('patients.index', compact('patients'));
    }

    public function create()
    {
        $sexes = Sex::all()->sortBy('id');
        $civilStatuses = CivilStatus::all()->sortBy('id');
        return view('patients.create')->with(compact('sexes', 'civilStatuses'));
    }


    public function createStep1(Request $request)
    {
        $patient = $request->session()->get('patient');
        $contactPerson = $request->session()->get('contactPerson');
        $referrer = $request->session()->get('referrer');
        $sexes = Sex::all()->sortBy('id');
        $civilStatuses = CivilStatus::all()->sortBy('id');
        return view('patients.create-step1')->with(compact(
            'patient', 'sexes', 'civilStatuses',
            'contactPerson', 'referrer'
        ));
    }


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
//
//            'contact_person_full_name'=>'nullable',
//            'contact_person_address'=>'nullable',
//            'contact_person_number'=>'nullable',
//            'referrer_full_name'=>'nullable',
//            'patient_contact_person_relationship'=>'nullable',
//        ]);

        $validatedData = $request->validate([
            'first_name'=>'required',
            'last_name'=>'required',
            'middle_initial'=>'nullable',
            'age'=>'nullable|digits_between:1,2',
            'home_address'=>'nullable',
            'work_address'=>'nullable',
            'email'=>'nullable',
            'mobile_number'=>'nullable',
            'landline_number'=>'nullable',
            'sex_id'=>'required',
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

        $contactPerson = (empty($request->session()->get('contactPerson'))) ?
            new ContactPerson : $request->session()->get('contactPerson');
        $contactPerson->full_name = $request->get('contact_person_full_name');
        $contactPerson->home_address = $request->get('contact_person_address');
        $contactPerson->contact_number = $request->get('contact_person_number');
        $contactPerson->relationship = $request->get('patient_contact_person_relationship');
        $request->session()->put('contactPerson', $contactPerson);

        $referrer = (empty($request->session()->get('referrer'))) ?
            new Referrer : $request->session()->get('referrer');
        $referrer->full_name = $request->get('referrer_full_name');
        $referrer->relationship = $request->get('patient_referrer_relationship');
        $request->session()->put('referrer', $referrer);
        return redirect('/patients/create-step2');
    }

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

        $patient_form = $request->session()->get('patient_form');
        return view('patients.create-step2')->with(compact(
            'patient_form', 'data'
        ));
    }

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

        $patient_form = (empty($request->session()->get('patient_form'))) ?
            new PatientForm : $request->session()->get('patient_form');
        $patient_form->fill($validatedData);

        $patient_form->query01 = $request->get('query01') . "|| " . $request->get('query01-extra');
        $patient_form->query04 = $request->get('query04') . "|| " . $request->get('query04-extra');
        $patient_form->query08 = $request->get('query08') . "|| " . $request->get('query08-extra');
        $patient_form->query12 = $request->get('query12') . "|| " . $request->get('query12-extra');
        $patient_form->query13 = $request->get('query13') . "|| " . $request->get('query13-extra');
        $patient_form->query15 = $request->get('query15') . "|| " . $request->get('query15-extra');
        $patient_form->query02 = $this->checkboxHelper($request, 'query02-', 6) . "|| " . $request->get("query02-extra");
        $patient_form->query03 = $this->checkboxHelper($request, 'query03-', 3) . "|| " . $request->get("query03-extra");
        $patient_form->query05 = $this->checkboxHelper($request, 'query05-', 3) . "|| " . $request->get("query05-extra");
        $patient_form->query11 = $this->checkboxHelper($request, 'query11-', 5);
        $patient_form->query19_1 = $request->get('query19-1bool') . "|| " . $request->get('query19-1what') . "|| " . $request->get('query19-1when') . "|| " . $request->get('query19-1where');
        $patient_form->query19_2 = $request->get('query19-2bool') . "|| " . $request->get('query19-2what') . "|| " . $request->get('query19-2when') . "|| " . $request->get('query19-2where');
        $patient_form->query19_3 = $request->get('query19-3bool') . "|| " . $request->get('query19-3what') . "|| " . $request->get('query19-3when') . "|| " . $request->get('query19-3where');
        $patient_form->query19_4 = $request->get('query19-4bool') . "|| " . $request->get('query19-4what') . "|| " . $request->get('query19-4when') . "|| " . $request->get('query19-4where');
        $patient_form->query19_5 = $request->get('query19-5bool') . "|| " . $request->get('query19-5what') . "|| " . $request->get('query19-5when') . "|| " . $request->get('query19-5where');
        $patient_form->query19_6 = $request->get('query19-6bool') . "|| " . $request->get('query19-6what') . "|| " . $request->get('query19-6when') . "|| " . $request->get('query19-6where');

        $request->session()->put('patient_form', $patient_form);
        return redirect('/patients/create-step3');
    }

    // temp hack
    private function checkboxHelper($request, $keyPrefix, $len) {
        if ($len <= 0) return null;
        $defaultValue = '0';
        $separator = ",";
        $result = "";
        for ($x = 1; $x <= $len; $x++) {
            $result = $result .($request->get($keyPrefix. $x) ?? $defaultValue) .$separator;
        }
        return str_replace("0,", "", $result);
    }

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
        $cosmeticForm = $request->session()->get('cosmeticForm');
        return view('patients.create-step3')->with(compact('patient', 'cosmeticForm','data'));
    }

    public function postCreateStep3(Request $request)
    {
        $validatedData = $request->validate([
            'cquery01'=>'nullable', 'cquery02'=>'nullable', 'cquery03'=>'nullable',
        ]);
        $cosmeticForm = (empty($request->session()->get('cosmeticForm'))) ?
            new CosmeticForm : $request->session()->get('cosmeticForm');
        $cosmeticForm->fill($validatedData);
        $request->session()->put('cosmeticForm', $cosmeticForm);
        return redirect('/patients/create-step4');
    }

    public function createStep4(Request $request)
    {
        $data['acne'] = [
            1 => ['id' => 1, 'value' => 'White heads' ],
            2 => ['id' => 2, 'value' => 'Black heads' ],
            3 => ['id' => 3, 'value' => 'Cystic Acne' ],
            4 => ['id' => 4, 'value' => 'Milia' ],
            5 => ['id' => 5, 'value' => 'Syringoma' ],
        ];
        $data['pores'] = [
            1 => ['id' => 1, 'value' => 'Large pores' ],
            2 => ['id' => 2, 'value' => 'Open pores' ],
        ];
        $data['scars'] = [
            1 => ['id' => 1, 'value' => 'Acne Scars' ],
            2 => ['id' => 2, 'value' => 'Facial Redness' ],
            3 => ['id' => 3, 'value' => 'Burn Scars' ],
            4 => ['id' => 4, 'value' => 'Keloid Scars' ],
            5 => ['id' => 5, 'value' => 'Wound Scars' ],
            6 => ['id' => 6, 'value' => 'Stretch Marks' ],
        ];
        $data['spots'] = [
            1 => ['id' => 1, 'value' => 'Birth Mark' ],
            2 => ['id' => 2, 'value' => 'Melasma' ],
            3 => ['id' => 3, 'value' => 'PIH' ],
            4 => ['id' => 4, 'value' => 'Some Body Part' ],
            5 => ['id' => 5, 'value' => 'Sun Spots' ],
            6 => ['id' => 6, 'value' => 'Dark Eye Circles' ],
            7 => ['id' => 7, 'value' => 'Dark Underarm' ],
        ];

        $data['lines'] = [
            1 => ['id' => 1, 'value' => 'Eye Wrinkles' ],
            2 => ['id' => 2, 'value' => 'Forehead Lines' ],
            3 => ['id' => 3, 'value' => 'Neck Lines' ],
            4 => ['id' => 4, 'value' => 'Lip Lines' ],
            5 => ['id' => 5, 'value' => 'Wrinkly Hands' ],
        ];

        $data['shapes'] = [
            1 => ['id' => 1, 'value' => 'Jowls' ],
            2 => ['id' => 2, 'value' => 'Facial Fullness' ],
            3 => ['id' => 3, 'value' => 'Sunken Cheeks' ],
            4 => ['id' => 4, 'value' => 'Square Jaw' ],
            5 => ['id' => 5, 'value' => 'Misshapen Nose' ],
            6 => ['id' => 6, 'value' => 'Double Chin' ],
            7 => ['id' => 7, 'value' => 'Weak Chin' ],
            8 => ['id' => 8, 'value' => 'Sagging Neck' ],
            9 => ['id' => 9, 'value' => 'Drooping Eyelids' ],
        ];

        $data['unwanted'] = [
            1 => ['id' => 1, 'value' => 'Fats' ],
            2 => ['id' => 2, 'value' => 'Cellulite' ],
            3 => ['id' => 3, 'value' => 'Weight Loss' ],
        ];

        $data['skin'] = [
            1 => ['id' => 1, 'value' => 'Damaged Skin' ],
            2 => ['id' => 2, 'value' => 'Eczema' ],
            3 => ['id' => 3, 'value' => 'Uneven Skin Tone' ],
            4 => ['id' => 4, 'value' => 'Warts' ],
            5 => ['id' => 5, 'value' => 'Excessive Hair' ],
            6 => ['id' => 6, 'value' => 'Rosacea' ],
            7 => ['id' => 7, 'value' => 'Sebaceous Cyst' ],
            8 => ['id' => 8, 'value' => 'Excessive Sweating' ],
        ];

        $data['others'] = [
            1 => ['id' => 1, 'value' => 'Tattoo Removal' ],
            2 => ['id' => 2, 'value' => 'Liver Spots / Age Spots' ],
        ];

        $patient = $request->session()->get('patient');
        $cosmeticForm = $request->session()->get('cosmeticForm');
        return view('patients.create-step4')->with(compact('patient', 'data', 'cosmeticForm'));
    }

    public function postCreateStep4(Request $request)
    {
//        $validatedData = $request->validate([
//
//        ]);
        $request->validate([
            'cquery04'=>'nullable', 'cquery05'=>'nullable', 'cquery06'=>'nullable',
            'cquery07'=>'nullable', 'cquery08'=>'nullable', 'cquery09'=>'nullable',
            'cquery10'=>'nullable', 'cquery11'=>'nullable', 'cquery12'=>'nullable',
        ]);
//        'cquery14'=>'nullable', 'cquery15'=>'nullable', 'cquery16'=>'nullable',
//            'cquery17'=>'nullable', 'cquery18'=>'nullable', 'cquery19'=>'nullable',
//            'cquery20'=>'nullable', 'cquery21'=>'nullable',
//        'cquery13'=>'nullable', IMAGE

        $cosmeticForm = (empty($request->session()->get('cosmeticForm'))) ?
            new CosmeticForm : $request->session()->get('cosmeticForm');
        $cosmeticForm->cquery04 = $this->checkboxHelper($request, 'cquery04-', 5) . "|| " . $request->get("cquery04-extra");
        $cosmeticForm->cquery05 = $this->checkboxHelper($request, 'cquery05-', 2) . "|| " . $request->get("cquery05-extra");
        $cosmeticForm->cquery06 = $this->checkboxHelper($request, 'cquery06-', 6) . "|| " . $request->get("cquery06-extra");
        $cosmeticForm->cquery07 = $this->checkboxHelper($request, 'cquery07-', 7) . "|| " . $request->get("cquery07-extra");
        $cosmeticForm->cquery08 = $this->checkboxHelper($request, 'cquery08-', 5) . "|| " . $request->get("cquery08-extra");
        $cosmeticForm->cquery09 = $this->checkboxHelper($request, 'cquery09-', 9) . "|| " . $request->get("cquery09-extra");
        $cosmeticForm->cquery10 = $this->checkboxHelper($request, 'cquery10-', 3) . "|| " . $request->get("cquery10-extra");
        $cosmeticForm->cquery11 = $this->checkboxHelper($request, 'cquery11-', 8) . "|| " . $request->get("cquery11-extra");
        $cosmeticForm->cquery12 = $this->checkboxHelper($request, 'cquery12-', 2) . "|| " . $request->get("cquery12-extra");

//        $cosmeticForm->fill($validatedData);
        $request->session()->put('cosmeticForm', $cosmeticForm);
        return redirect('/patients/create-step5');
    }

    public function createStep5(Request $request)
    {
        $transaction = $request->session()->get('transaction');
//        $transaction = array (
//            "date"=>["date0","1","2","3","4","5","6","7","8","9"],
//            "particular"=>["particular0","1","2","3","4","5","6","7","8","9"],
//            "paid"=>["paid0","1","2","3","4","5","6","7","8","9"],
//            "mode"=>["mode0","1","2","3","4","5","6","7","8","9"],
//            "bal"=>["bal0","1","2","3","4","5","6","7","8","9"],
//            "dc"=>["dc0","1","2","3","4","5","6","7","8","9"],
//            "packages"=>["packages0","1","2","3","4","5","6","7","8","9"],
//            "remarks"=>["remarks0","1","2","3","4","5","6","7","8","9"]
//        );

        return view('patients.create-step5')->with(compact( 'transaction'));
    }

    public function postCreateStep5(Request $request)
    {
        $request->validate([
            'trans.*.*'=>'nullable',
        ]);
        $trans = $request->get("trans");
//        echo $trans['date'][0];
//        $someJSON = json_encode($trans);
//        echo $someJSON;

//        $array = json_decode($someJSON);
//        print $array->date[0];
//        return redirect('/patients/create-step5');
        $transaction = (empty($request->session()->get('transaction'))) ?
            new Transaction : $request->session()->get('transaction');
        $transaction->date = $trans['date'];
        $transaction->particular = $trans['particular'];
        $transaction->paid = $trans['paid'];
        $transaction->mode = $trans['mode'];
        $transaction->bal = $trans['bal'];
        $transaction->dc = $trans['dc'];
        $transaction->packages = $trans['packages'];
        $transaction->remarks = $trans['remarks'];
        $request->session()->put('transaction', $transaction);

        $transaction->date = json_encode($trans['date']);
        $transaction->particular = json_encode($trans['particular']);
        $transaction->paid = json_encode($trans['paid']);
        $transaction->mode = json_encode($trans['mode']);
        $transaction->bal = json_encode($trans['bal']);
        $transaction->dc = json_encode($trans['dc']);
        $transaction->packages = json_encode($trans['packages']);
        $transaction->remarks = json_encode($trans['remarks']);
//        var_dump($trans->toJson());
//        dd($trans);

        $patient = $request->session()->get('patient');
        $contactPerson = $request->session()->get('contactPerson');
        $referrer = $request->session()->get('referrer');
        $patient_form = $request->session()->get('patient_form');
        $cosmeticForm = $request->session()->get('cosmeticForm');

        $patient->encoder_id = auth()->id();
        $patient->save();

        $patient->contactPerson()->save($contactPerson);
        $patient->referrer()->save($referrer);
        $patient->patientForm()->save($patient_form);
        $patient->cosmeticForm()->save($cosmeticForm);
        $patient->transaction()->save($transaction);
        $request->session()->forget(['patient', 'contactPerson', 'referrer', 'patient_form', 'cosmeticForm']);

        return redirect('/patients')->with('success', 'Patients saved!');
    }

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
//        $request->session()->forget('patient');

        $patient = $request->session()->get('patient');
        $contactPerson = $request->session()->get('contactPerson');
        $referrer = $request->session()->get('referrer');
        $patient_form = $request->session()->get('patient_form');
        $cosmeticForm = $request->session()->get('cosmeticForm');
        $transaction = $request->session()->get('transaction');

//        $patient->encoder_id = auth()->id();
        $patient->save();
//        $fetchedPost = Patient::find($patient->id);
//        dd($fetchedPost);

//        $patient->contactPerson =
//        $patient->contactPerson()->save($contactPerson);
//        $patient->save();

//        $contactPerson = $request->session()->get('contactPerson');
//        $contactPerson->save();

        $patient->contactPerson()->save($contactPerson);
        $patient->referrer()->save($referrer);
        $patient->patientForm()->save($patient_form);
        $patient->cosmeticForm()->save($cosmeticForm);
        $patient->transaction()->save($transaction);
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
        $civilStatuses = CivilStatus::all()->sortBy('id');
        return view('patients.edit')->with(compact('patient', 'sexes', 'civilStatuses'));
    }

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

    public function destroy($id)
    {
        $patient = Patient::find($id);
        $patient->delete();
        return redirect('/patients')->with('success', 'Patient deleted!');
    }
}
