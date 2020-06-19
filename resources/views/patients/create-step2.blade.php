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
                    <div class="form-group">
                        <label for="query01">1. Do you have ANY current or chronic illnesses? ( e.g. dermatologic & medical illnesses including cancer/s )</label>
                        <div class="row">
                            <div class="col-md-3">
                            @foreach($data['bools'] as $bool)
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="query01-{{ $bool['value'] }}" name="query01" value="{{ $bool['id'] }}" class="custom-control-input">
                                    <label class="custom-control-label" for="query01-{{ $bool['value'] }}">{{ $bool['value'] }}</label>
                                </div>
                            @endforeach
                            </div>
                            <input type="text" class="form-control col-md-9" name="query01" placeholder="If yes, please indicate" disabled/>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <label for="query02-extra" class="col-md-6 pr-1">2. Do you take/use ANY medications on a regular basis?</label>
                            <input type="text" class="form-control col-md-5" name="query02-extra" placeholder="Indicate here if not listed" />
                        </div>
                        <div class="row mt-2">
                        @foreach($data['medications'][0] as $medication)
                            <div class="form-check col-md-4 pl-5">
                                <input class="form-check-input" name="query02" type="checkbox" id="inlineCheckbox{{ $medication['id'] }}" value="{{ $medication['name'] }}">
                                <label class="form-check-label" for="query02">{{ $medication['name'] }}</label>
                            </div>
                        @endforeach
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <label for="query03-extra" class="col-md-6 pr-1">3. Do you have any implants in your body?</label>
                            <input type="text" class="form-control col-md-5" name="query03-extra" placeholder="Indicate here if not listed" />
                        </div>
                        <div class="row mt-2">
                            @foreach($data['implants'] as $implant)
                                <div class="form-check col-md-4 pl-5">
                                    <input class="form-check-input" name="query03" type="checkbox" id="inlineCheckbox{{ $implant['id'] }}" value="{{ $implant['type'] }}">
                                    <label class="form-check-label" for="query03">{{ $implant['type'] }}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="query04">4. Have you ever consulted with a psychiatrist / psychologist?</label>
                        <div class="row">
                            <div class="col-md-3">
                                @foreach($data['bools'] as $bool)
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="query04-{{ $bool['value'] }}" name="query04" value="{{ $bool['id'] }}" class="custom-control-input">
                                        <label class="custom-control-label" for="query04-{{ $bool['value'] }}">{{ $bool['value'] }}</label>
                                    </div>
                                @endforeach
                            </div>
                            <input type="text" class="form-control col-md-9" name="query04" placeholder="If yes, please indicate" disabled/>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <label for="query05-extra" class="col-md-6 pr-1">5. Do you have allergies to any of the following:</label>
                            <input type="text" class="form-control col-md-5" name="query05-extra" placeholder="Indicate here if not listed" />
                        </div>
                        <div class="row mt-2">
                            @foreach($data['allergies'] as $allergy)
                                <div class="form-check col-md-4 pl-5">
                                    <input class="form-check-input" name="query05" type="checkbox" id="inlineCheckbox{{ $allergy['id'] }}" value="{{ $allergy['type'] }}">
                                    <label class="form-check-label" for="query05">{{ $allergy['type'] }}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="form-group">
                        <legend class="col-form-label pt-0">6. Are you pregnant/lactating?</legend>
                        @foreach($data['bools'] as $bool)
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="query06-{{ $bool['value'] }}" name="query06" value="{{ $bool['id'] }}" class="custom-control-input">
                                <label class="custom-control-label" for="query06-{{ $bool['value'] }}">{{ $bool['value'] }}</label>
                            </div>
                        @endforeach
                    </div>
                    <div class="form-group">
                        <legend class="col-form-label pt-0">7. Is your menstrual period regular?</legend>
                        @foreach($data['bools'] as $bool)
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="query07-{{ $bool['value'] }}" name="query07" value="{{ $bool['id'] }}" class="custom-control-input">
                                <label class="custom-control-label" for="query07-{{ $bool['value'] }}">{{ $bool['value'] }}</label>
                            </div>
                        @endforeach
                    </div>
                    <div class="form-group">
                        <label for="query08">8. Do you have herpes I or II (cold sores) in the area to be treated?</label>
                        <div class="row">
                            <div class="col-md-3">
                                @foreach($data['bools'] as $bool)
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="query08-{{ $bool['value'] }}" name="query08" value="{{ $bool['id'] }}" class="custom-control-input">
                                        <label class="custom-control-label" for="query08-{{ $bool['value'] }}">{{ $bool['value'] }}</label>
                                    </div>
                                @endforeach
                            </div>
                            <input type="text" class="form-control col-md-9" name="query08" placeholder="If yes, when was the last outbreak" disabled/>
                        </div>
                    </div>
                    <div class="form-group">
                        <legend class="col-form-label pt-0">9. Do you have history of keloid scarring?</legend>
                        @foreach($data['bools'] as $bool)
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="query09-{{ $bool['value'] }}" name="query09" value="{{ $bool['id'] }}" class="custom-control-input">
                                <label class="custom-control-label" for="query09-{{ $bool['value'] }}">{{ $bool['value'] }}</label>
                            </div>
                        @endforeach
                    </div>
                    <div class="form-group">
                        <legend class="col-form-label pt-0">10. Have you ever had any history of light sensitivity?</legend>
                        @foreach($data['bools'] as $bool)
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="query10-{{ $bool['value'] }}" name="query10" value="{{ $bool['id'] }}" class="custom-control-input">
                                <label class="custom-control-label" for="query10-{{ $bool['value'] }}">{{ $bool['value'] }}</label>
                            </div>
                        @endforeach
                    </div>
                    <div class="form-group">
                        <legend class="col-form-label pt-0">11. Have you taken these medications for the last 6 months?</legend>
                        <div class="row mt-2">
                            @foreach($data['medications'][1] as $medication)
                                <div class="form-check col-md-4 pl-5">
                                    <input class="form-check-input" name="query11" type="checkbox" id="inlineCheckbox{{ $medication['id'] }}" value="{{ $medication['name'] }}">
                                    <label class="form-check-label" for="query11">{{ $medication['name'] }}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="query12">12. Are you currently applying any topical retinoid preparations/prescriptions?</label>
                        <div class="row">
                            <div class="col-md-3">
                                @foreach($data['bools'] as $bool)
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="query12-{{ $bool['value'] }}" name="query12" value="{{ $bool['id'] }}" class="custom-control-input">
                                        <label class="custom-control-label" for="query12-{{ $bool['value'] }}">{{ $bool['value'] }}</label>
                                    </div>
                                @endforeach
                            </div>
                            <input type="text" class="form-control col-md-9" name="query12" placeholder="If yes, please indicate" disabled/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="query13">13. Are you applying any other topical medications at this time?</label>
                        <div class="row">
                            <div class="col-md-3">
                                @foreach($data['bools'] as $bool)
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="query13-{{ $bool['value'] }}" name="query13" value="{{ $bool['id'] }}" class="custom-control-input">
                                        <label class="custom-control-label" for="query13-{{ $bool['value'] }}">{{ $bool['value'] }}</label>
                                    </div>
                                @endforeach
                            </div>
                            <input type="text" class="form-control col-md-9" name="query13" placeholder="If yes, please indicate" disabled/>
                        </div>
                    </div>
                    <div class="form-group">
                        <legend class="col-form-label pt-0">14. Do you wear contact lenses?</legend>
                        @foreach($data['bools'] as $bool)
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="query14{{ $bool['value'] }}" name="query14" value="{{ $bool['id'] }}" class="custom-control-input">
                                <label class="custom-control-label" for="query14{{ $bool['value'] }}">{{ $bool['value'] }}</label>
                            </div>
                        @endforeach
                    </div>
                    <div class="form-group">
                        <label for="query15">15. Do you currently use or receive depilatories or waxing?</label>
                        <div class="row">
                            <div class="col-md-3">
                                @foreach($data['bools'] as $bool)
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="query15-{{ $bool['value'] }}" name="query15" value="{{ $bool['id'] }}" class="custom-control-input">
                                        <label class="custom-control-label" for="query15-{{ $bool['value'] }}">{{ $bool['value'] }}</label>
                                    </div>
                                @endforeach
                            </div>
                            <input type="text" class="form-control col-md-9" name="query15" placeholder="If yes, please indicate last treatement" disabled/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="query16">16. Do you use skin whitening or bleaching products?</label>
                        <textarea class="form-control" name="query16" placeholder="Please enumerate them separated by commas"></textarea>
                    </div>
                    <div class="form-group">
                        <legend class="col-form-label pt-0">17. Have you had any unprotected sun exposure, used tanning creams or tanning beds in the last 4-6 weeks?</legend>
                        @foreach($data['bools'] as $bool)
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="query17-{{ $bool['value'] }}" name="query17" value="{{ $bool['id'] }}" class="custom-control-input">
                                <label class="custom-control-label" for="query17-{{ $bool['value'] }}">{{ $bool['value'] }}</label>
                            </div>
                        @endforeach
                    </div>
                    <div class="form-group">
                        <label for="query18">18. Please enumerate your present skin care regiment products.</label>
                        <textarea class="form-control" name="query18" placeholder="Please enumerate them separated by commas"></textarea>
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
                                            <input type="radio" id="query19-{{ $procedure['id'] }}{{ $bool['value'] }}" name="query19-{{$procedure['id']}}bool" value="{{ $bool['id'] }}" class="custom-control-input">
                                            <label class="custom-control-label" for="query19-{{ $procedure['id'] }}{{ $bool['value'] }}">{{ $bool['value'] }}</label>
                                        </div>
                                    @endforeach
                                </td>
                                <td><input type="text" class="form-control" name="query19-{{$procedure['id']}}what" disabled></td>
                                <td><input type="text" class="form-control" name="query19-{{$procedure['id']}}when" disabled></td>
                                <td><input type="text" class="form-control" name="query19-{{$procedure['id']}}where" disabled></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <button type="submit" class="btn btn-primary float-right">Next</button>
                    <a type="button" href="/patients/create-step1" class="btn btn-secondary float-right mr-3">Go Back</a>
                </form>
            </div>
        </div>
    </div>
@endsection
