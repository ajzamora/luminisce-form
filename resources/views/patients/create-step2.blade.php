@extends('base')
@section('main')
    <div class="row">
        <div class="col-sm-8 offset-sm-2">
            <h1 class="display-4">II. Diseases and Conditions</h1>
            <h5>All questions contained in this questionnaire are strictly confidential and will become part of your medical record.</h5>
            <div>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div><br />
                @endif
                <form method="post" action="/patients/create-step2">
                    @csrf
                    <div class="form-group"><hr/>
                        <label for="query01">1. Do you have ANY current or chronic illnesses? ( e.g. dermatologic & medical illnesses including cancer/s )</label>
                        <div class="row">
                            <div class="col-md-3">
                            @foreach($data['bools'] as $bool)
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="query01-{{ $bool['value'] }}" name="query01" value="{{ $bool['value'] }}" class="custom-control-input" {{ (isset($form->query01) && ($bool['value']==explode("|| ", $form->query01)[0]))? "checked" : "" }}>
                                    <label class="custom-control-label" for="query01-{{ $bool['value'] }}">{{ $bool['value'] }}</label>
                                </div>
                            @endforeach
                            </div>
                            <input type="text" class="form-control col-md-9" name="query01-extra" placeholder="If yes, please indicate" disabled value="{{isset($form->query01) ? explode("|| ", $form->query01)[1] : ''}}"/>
                        </div>
                    </div>
                    <div class="form-group"><hr/>
                        <div class="row">
                            <label for="query02-extra" class="col-md-6 pr-1">2. Do you take/use ANY ws on a regular basis?</label>
                            <input type="text" class="form-control col-md-5" name="query02-extra" placeholder="Indicate here if not listed" value="{{isset($form->query02) ? explode("|| ", $form->query02)[1] : ''}}" />
                        </div>
                        <div class="row mt-2">
                            @foreach($data['medications'][0] as $medication)
                                <div class="form-check col-md-4 pl-5">
                                    <input class="form-check-input" id="query02-{{$medication['id']}}" name="query02-{{$medication['id']}}" type="checkbox" value="{{ $medication['name'] }}" {{ (isset($form->query02) && (strpos($form->query02, $medication['name']) !== false))? "checked" : "" }}>
                                    <label class="form-check-label" for="query02-{{$medication['id']}}">{{ $medication['name'] }}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="form-group"><hr/>
                        <div class="row">
                            <label for="query03-extra" class="col-md-6 pr-1">3. Do you have any implants in your body?</label>
                            <input type="text" class="form-control col-md-5" name="query03-extra" placeholder="Indicate here if not listed" value="{{isset($form->query03) ? explode("|| ", $form->query03)[1] : ''}}" />
                        </div>
                        <div class="row mt-2">
                            @foreach($data['implants'] as $implant)
                                <div class="form-check col-md-4 pl-5">
                                    <input class="form-check-input" id="query03-{{ $implant['id'] }}" name="query03-{{ $implant['id'] }}" type="checkbox" value="{{ $implant['type'] }}" {{ (isset($form->query03) && (strpos($form->query03, $implant['type']) !== false))? "checked" : "" }}>
                                    <label class="form-check-label" for="query03-{{ $implant['id'] }}">{{ $implant['type'] }}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="form-group"><hr/>
                        <label for="query04">4. Have you ever consulted with a psychiatrist / psychologist?</label>
                        <div class="row">
                            <div class="col-md-3">
                                @foreach($data['bools'] as $bool)
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="query04-{{ $bool['value'] }}" name="query04" value="{{ $bool['value'] }}" class="custom-control-input" {{ (isset($form->query04) && ($bool['value']==explode("|| ", $form->query04)[0]))? "checked" : "" }}>
                                        <label class="custom-control-label" for="query04-{{ $bool['value'] }}">{{ $bool['value'] }}</label>
                                    </div>
                                @endforeach
                            </div>
                            <input type="text" class="form-control col-md-9" name="query04-extra" placeholder="If yes, please indicate" disabled value="{{isset($form->query04) ? explode("|| ", $form->query04)[1] : ''}}" />
                        </div>
                    </div>
                    <div class="form-group"><hr/>
                        <div class="row">
                            <label for="query05-extra" class="col-md-6 pr-1">5. Do you have allergies to any of the following:</label>
                            <input type="text" class="form-control col-md-5" name="query05-extra" placeholder="Indicate here if not listed" value="{{isset($form->query05) ? explode("|| ", $form->query05)[1] : ''}}" />
                        </div>
                        <div class="row mt-2">
                            @foreach($data['allergies'] as $allergy)
                                <div class="form-check col-md-4 pl-5">
                                    <input class="form-check-input" id="query05-{{$allergy['id']}}" name="query05-{{$allergy['id']}}" type="checkbox" value="{{ $allergy['type'] }}" {{ (isset($form->query05) && (strpos($form->query05, $allergy['type']) !== false))? "checked" : "" }}>
                                    <label class="form-check-label" for="query05-{{$allergy['id']}}">{{ $allergy['type'] }}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="form-group"><hr/>
                        <legend class="col-form-label pt-0">6. Are you pregnant/lactating?</legend>
                        @foreach($data['bools'] as $bool)
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="query06-{{ $bool['value'] }}" name="query06" value="{{ $bool['value'] }}" class="custom-control-input" {{ (isset($form->query06) && ($bool['value']==$form->query06))? "checked" : "" }}>
                                <label class="custom-control-label" for="query06-{{ $bool['value'] }}">{{ $bool['value'] }}</label>
                            </div>
                        @endforeach
                    </div>
                    <div class="form-group"><hr/>
                        <legend class="col-form-label pt-0">7. Is your menstrual period regular?</legend>
                        @foreach($data['bools'] as $bool)
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="query07-{{ $bool['value'] }}" name="query07" value="{{ $bool['value'] }}" class="custom-control-input" {{ (isset($form->query07) && ($bool['value']==$form->query07))? "checked" : "" }}>
                                <label class="custom-control-label" for="query07-{{ $bool['value'] }}">{{ $bool['value'] }}</label>
                            </div>
                        @endforeach
                    </div>
                    <div class="form-group"><hr/>
                        <label for="query08">8. Do you have herpes I or II (cold sores) in the area to be treated?</label>
                        <div class="row">
                            <div class="col-md-3">
                                @foreach($data['bools'] as $bool)
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="query08-{{ $bool['value'] }}" name="query08" value="{{ $bool['value'] }}" class="custom-control-input" {{ (isset($form->query08) && ($bool['value']==explode("|| ", $form->query08)[0]))? "checked" : "" }}>
                                        <label class="custom-control-label" for="query08-{{ $bool['value'] }}">{{ $bool['value'] }}</label>
                                    </div>
                                @endforeach
                            </div>
                            <input type="text" class="form-control col-md-9" name="query08-extra" placeholder="If yes, when was the last outbreak" disabled value="{{isset($form->query08) ? explode("|| ", $form->query08)[1] : ''}}" />
                        </div>
                    </div>
                    <div class="form-group"><hr/>
                        <legend class="col-form-label pt-0">9. Do you have history of keloid scarring?</legend>
                        @foreach($data['bools'] as $bool)
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="query09-{{ $bool['value'] }}" name="query09" value="{{ $bool['value'] }}" class="custom-control-input" {{ (isset($form->query09) && ($bool['value']==$form->query09))? "checked" : "" }}>
                                <label class="custom-control-label" for="query09-{{ $bool['value'] }}">{{ $bool['value'] }}</label>
                            </div>
                        @endforeach
                    </div>
                    <div class="form-group"><hr/>
                        <legend class="col-form-label pt-0">10. Have you ever had any history of light sensitivity?</legend>
                        @foreach($data['bools'] as $bool)
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="query10-{{ $bool['value'] }}" name="query10" value="{{ $bool['value'] }}" class="custom-control-input" {{ (isset($form->query10) && ($bool['value']==$form->query10))? "checked" : "" }}>
                                <label class="custom-control-label" for="query10-{{ $bool['value'] }}">{{ $bool['value'] }}</label>
                            </div>
                        @endforeach
                    </div>
                    <div class="form-group"><hr/>
                        <legend class="col-form-label pt-0">11. Have you taken these medications for the last 6 months?</legend>
                        <div class="row mt-2">
                            @foreach($data['medications'][1] as $medication)
                                <div class="form-check col-md-4 pl-5">
                                    <input class="form-check-input" id="query11-{{ $medication['id'] }}" name="query11-{{$medication['id']}}" type="checkbox" value="{{ $medication['name'] }}" {{ (isset($form->query11) && (strpos($form->query11, $medication['name']) !== false))? "checked" : "" }}>
                                    <label class="form-check-label" for="query11-{{ $medication['id'] }}">{{ $medication['name'] }}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="form-group"><hr/>
                        <label for="query12">12. Are you currently applying any topical retinoid preparations/prescriptions?</label>
                        <div class="row">
                            <div class="col-md-3">
                                @foreach($data['bools'] as $bool)
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="query12-{{ $bool['value'] }}" name="query12" value="{{ $bool['value'] }}" class="custom-control-input" {{ (isset($form->query12) && ($bool['value']==explode("|| ", $form->query12)[0]))? "checked" : "" }}>
                                        <label class="custom-control-label" for="query12-{{ $bool['value'] }}">{{ $bool['value'] }}</label>
                                    </div>
                                @endforeach
                            </div>
                            <input type="text" class="form-control col-md-9" name="query12-extra" placeholder="If yes, please indicate" disabled value="{{isset($form->query12) ? explode("|| ", $form->query12)[1] : ''}}"/>
                        </div>
                    </div>
                    <div class="form-group"><hr/>
                        <label for="query13">13. Are you applying any other topical medications at this time?</label>
                        <div class="row">
                            <div class="col-md-3">
                                @foreach($data['bools'] as $bool)
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="query13-{{ $bool['value'] }}" name="query13" value="{{ $bool['value'] }}" class="custom-control-input" {{ (isset($form->query13) && ($bool['value']==explode("|| ", $form->query13)[0]))? "checked" : "" }}>
                                        <label class="custom-control-label" for="query13-{{ $bool['value'] }}">{{ $bool['value'] }}</label>
                                    </div>
                                @endforeach
                            </div>
                            <input type="text" class="form-control col-md-9" name="query13-extra" placeholder="If yes, please indicate" disabled value="{{isset($form->query13) ? explode("|| ", $form->query13)[1] : ''}}"/>
                        </div>
                    </div>
                    <div class="form-group"><hr/>
                        <legend class="col-form-label pt-0">14. Do you wear contact lenses?</legend>
                        @foreach($data['bools'] as $bool)
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="query14{{ $bool['value'] }}" name="query14" value="{{ $bool['value'] }}" class="custom-control-input" {{ (isset($form->query14) && ($bool['value']==$form->query14))? "checked" : "" }}>
                                <label class="custom-control-label" for="query14{{ $bool['value'] }}">{{ $bool['value'] }}</label>
                            </div>
                        @endforeach
                    </div>
                    <div class="form-group"><hr/>
                        <label for="query15">15. Do you currently use or receive depilatories or waxing?</label>
                        <div class="row">
                            <div class="col-md-3">
                                @foreach($data['bools'] as $bool)
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="query15-{{ $bool['value'] }}" name="query15" value="{{ $bool['value'] }}" class="custom-control-input" {{ (isset($form->query15) && ($bool['value']==explode("|| ", $form->query15)[0]))? "checked" : "" }}>
                                        <label class="custom-control-label" for="query15-{{ $bool['value'] }}">{{ $bool['value'] }}</label>
                                    </div>
                                @endforeach
                            </div>
                            <input type="text" class="form-control col-md-9" name="query15-extra" placeholder="If yes, please indicate last treatement" disabled value="{{isset($form->query15) ? explode("|| ", $form->query15)[1] : ''}}"/>
                        </div>
                    </div>
                    <div class="form-group"><hr/>
                        <label for="query16">16. Do you use skin whitening or bleaching products?</label>
                        <textarea class="form-control" name="query16" placeholder="Please enumerate them separated by a comma and a space">{{ $form->query16 ?? '' }}</textarea>
                    </div>
                    <div class="form-group"><hr/>
                        <legend class="col-form-label pt-0">17. Have you had any unprotected sun exposure, used tanning creams or tanning beds in the last 4-6 weeks?</legend>
                        @foreach($data['bools'] as $bool)
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="query17-{{ $bool['value'] }}" name="query17" value="{{ $bool['value'] }}" class="custom-control-input" {{ (isset($form->query17) && ($bool['value']==$form->query17))? "checked" : "" }}>
                                <label class="custom-control-label" for="query17-{{ $bool['value'] }}">{{ $bool['value'] }}</label>
                            </div>
                        @endforeach
                    </div>
                    <div class="form-group"><hr/>
                        <label for="query18">18. Please enumerate your present skin care regiment products.</label>
{{--                        <input type="text" class="form-control" name="query18" placeholder="Please enumerate them separated by a comma and a space" value="try">--}}
                        <textarea class="form-control" name="query18" placeholder="Please enumerate them separated by a comma and a space">{{ $form->query18 ?? '' }}</textarea>
                    </div>
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <td class="text-center">Have you ever had this procedure?</td>
                            <td class="text-center"></td>
                            <td class="text-center">What type / part</td>
                            <td class="text-center">When</td>
                            <td class="text-center">Where</td>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($data['procedures'] as $procedure)
                            <tr>
                                <td class="ml-2">{{$procedure['id']}}. {{$procedure['type']}}</td>
                                <td class="text-center">
                                    @foreach($data['bools'] as $bool)
                                        <div class="custom-control custom-radio custom-control-inline">
{{--                                            <input type="radio" id="query19-{{ $procedure['id'] }}{{ $bool['value'] }}" name="query19-{{$procedure['id']}}bool" value="{{ $bool['value'] }}" class="custom-control-input" {{ (isset($form->{"query19_".$procedure['id']}) && $bool['value']==$form->{"query19_".$procedure['id']})? "checked" : "" }}>--}}
                                            <input type="radio" id="query19-{{ $procedure['id'] }}{{ $bool['value'] }}" name="query19-{{$procedure['id']}}bool" value="{{ $bool['value'] }}" class="custom-control-input" {{ (isset($form->{"query19_".$procedure['id']}) && ($bool['value']==explode("|| ", $form->{"query19_".$procedure['id']})[0]))? "checked" : "" }}>
                                            <label class="custom-control-label" for="query19-{{ $procedure['id'] }}{{ $bool['value'] }}">{{ $bool['value'] }}</label>
                                        </div>
                                    @endforeach
                                </td>
                                <td><input type="text" class="form-control" name="query19-{{$procedure['id']}}what" disabled value="{{isset($form->{"query19_".$procedure['id']}) ? explode("|| ", $form->{"query19_".$procedure['id']})[1] : ''}}"></td>
                                <td><input type="text" class="form-control" name="query19-{{$procedure['id']}}when" disabled value="{{isset($form->{"query19_".$procedure['id']}) ? explode("|| ", $form->{"query19_".$procedure['id']})[2] : ''}}"></td>
                                <td><input type="text" class="form-control" name="query19-{{$procedure['id']}}where" disabled value="{{isset($form->{"query19_".$procedure['id']}) ? explode("|| ", $form->{"query19_".$procedure['id']})[3] : ''}}"></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <hr/>
                    <button type="submit" class="btn btn-primary float-right">Next</button>
                    <a type="button" href="/patients/create-step1" class="btn btn-secondary float-right mr-3">Go Back</a>
                </form>
            </div>
        </div>
    </div>
@endsection
