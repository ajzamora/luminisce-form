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
                        <label for="q1">1. Do you have ANY current or chronic illnesses? ( e.g. dermatologic & medical illnesses including cancer/s )</label>
                        <input type="text" class="form-control" name="q1" placeholder="If yes, please indicate" />
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <label for="q2-extra" class="col-md-6 pr-1">2. Do you take/use ANY medications on a regular basis?</label>
                            <input type="text" class="form-control col-md-5" name="q2-extra" placeholder="Indicate here if not listed" />
                        </div>
                        <div class="row mt-2">
                        @foreach($data['medications'][0] as $medication)
                            <div class="form-check col-md-4 pl-5">
                                <input class="form-check-input" name="q2" type="checkbox" id="inlineCheckbox{{ $medication['id'] }}" value="{{ $medication['name'] }}">
                                <label class="form-check-label" for="q2">{{ $medication['name'] }}</label>
                            </div>
                        @endforeach
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <label for="q3-extra" class="col-md-6 pr-1">3. Do you have any implants in your body?</label>
                            <input type="text" class="form-control col-md-5" name="q3-extra" placeholder="Indicate here if not listed" />
                        </div>
                        <div class="row mt-2">
                            @foreach($data['implants'] as $implant)
                                <div class="form-check col-md-4 pl-5">
                                    <input class="form-check-input" name="q3" type="checkbox" id="inlineCheckbox{{ $implant['id'] }}" value="{{ $implant['type'] }}">
                                    <label class="form-check-label" for="q3">{{ $implant['type'] }}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="q4">4. Have you ever consulted with a psychiatrist / psychologist?</label>
                        <input type="text" class="form-control" name="q4" placeholder="If yes, please state reason" />
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <label for="q5-extra" class="col-md-6 pr-1">5. Do you have allergies to any of the following:</label>
                            <input type="text" class="form-control col-md-5" name="q5-extra" placeholder="Indicate here if not listed" />
                        </div>
                        <div class="row mt-2">
                            @foreach($data['allergies'] as $allergy)
                                <div class="form-check col-md-4 pl-5">
                                    <input class="form-check-input" name="q5" type="checkbox" id="inlineCheckbox{{ $allergy['id'] }}" value="{{ $allergy['type'] }}">
                                    <label class="form-check-label" for="q5">{{ $allergy['type'] }}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="form-group">
                        <legend class="col-form-label pt-0">6. Are you pregnant/lactating?</legend>
                        @foreach($data['bools'] as $bool)
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="{{ $bool['value'] }}" name="q6" value="{{ $bool['id'] }}" class="custom-control-input">
                                <label class="custom-control-label" for="{{ $bool['value'] }}">{{ $bool['value'] }}</label>
                            </div>
                        @endforeach
                    </div>
                    <div class="form-group">
                        <legend class="col-form-label pt-0">7. Is your menstrual period regular?</legend>
                        @foreach($data['bools'] as $bool)
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="{{ $bool['value'] }}" name="q7" value="{{ $bool['id'] }}" class="custom-control-input">
                                <label class="custom-control-label" for="{{ $bool['value'] }}">{{ $bool['value'] }}</label>
                            </div>
                        @endforeach
                    </div>
                    <div class="form-group">
                        <label for="q8">8. Do you have herpes I or II (cold sores) in the area to be treated?</label>
                        <input type="text" class="form-control" name="q8e" placeholder="If yes, when was the last outbreak" />
                    </div>
                    <div class="form-group">
                        <legend class="col-form-label pt-0">9. Do you have history of keloid scarring?</legend>
                        @foreach($data['bools'] as $bool)
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="{{ $bool['value'] }}" name="q9" value="{{ $bool['id'] }}" class="custom-control-input">
                                <label class="custom-control-label" for="{{ $bool['value'] }}">{{ $bool['value'] }}</label>
                            </div>
                        @endforeach
                    </div>
                    <div class="form-group">
                        <legend class="col-form-label pt-0">10. Have you ever had any history of light sensitivity?</legend>
                        @foreach($data['bools'] as $bool)
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="{{ $bool['value'] }}" name="q10" value="{{ $bool['id'] }}" class="custom-control-input">
                                <label class="custom-control-label" for="{{ $bool['value'] }}">{{ $bool['value'] }}</label>
                            </div>
                        @endforeach
                    </div>
                    <div class="form-group">
                        <legend class="col-form-label pt-0">11. Have you taken these medications for the last 6 months?</legend>
                        <div class="row mt-2">
                            @foreach($data['medications'][1] as $medication)
                                <div class="form-check col-md-4 pl-5">
                                    <input class="form-check-input" name="q11" type="checkbox" id="inlineCheckbox{{ $medication['id'] }}" value="{{ $medication['name'] }}">
                                    <label class="form-check-label" for="q11">{{ $medication['name'] }}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="q12">12. Are you currently applying any topical retinoid preparations/prescriptions?</label>
                        <input type="text" class="form-control" name="q12" placeholder="If yes, please indicate" />
                    </div>
                    <div class="form-group">
                        <label for="q13">13. Are you applying any other topical medications at this time?</label>
                        <input type="text" class="form-control" name="q13" placeholder="If yes, please indicate" />
                    </div>
                    <div class="form-group">
                        <legend class="col-form-label pt-0">14. Do you wear contact lenses?</legend>
                        @foreach($data['bools'] as $bool)
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="{{ $bool['value'] }}" name="q10" value="{{ $bool['id'] }}" class="custom-control-input">
                                <label class="custom-control-label" for="{{ $bool['value'] }}">{{ $bool['value'] }}</label>
                            </div>
                        @endforeach
                    </div>
                    <div class="form-group">
                        <label for="q15">15. Do you currently use or receive depilatories or waxing?</label>
                        <input type="text" class="form-control" name="q15" placeholder="If yes, please indicate last treatement" />
                    </div>
                    <div class="form-group">
                        <label for="q16">16. Do you use skin whitening or bleaching products?</label>
                        <textarea class="form-control" name="q16" placeholder="Please enumerate them separated by commas"></textarea>
                    </div>
                    <div class="form-group">
                        <legend class="col-form-label pt-0">17. Have you had any unprotected sun exposure, used tanning creams or tanning beds in the last 4-6 weeks?</legend>
                        @foreach($data['bools'] as $bool)
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="{{ $bool['value'] }}" name="q17" value="{{ $bool['id'] }}" class="custom-control-input">
                                <label class="custom-control-label" for="{{ $bool['value'] }}">{{ $bool['value'] }}</label>
                            </div>
                        @endforeach
                    </div>
                    <div class="form-group">
                        <label for="q18">18. Please enumerate your present skin care regiment products.</label>
                        <textarea class="form-control" name="q18" placeholder="Please enumerate them separated by commas"></textarea>
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
                                            <input type="radio" id="{{ $bool['value'] }}" name="q19bool-{{$procedure['id']}}" value="{{ $bool['id'] }}" class="custom-control-input">
                                            <label class="custom-control-label" for="{{ $bool['value'] }}">{{ $bool['value'] }}</label>
                                        </div>
                                    @endforeach
                                </td>
                                <td><input type="text" class="form-control" name="q19what-{{$procedure['id']}}"></td>
                                <td><input type="text" class="form-control" name="q19when-{{$procedure['id']}}"></td>
                                <td><input type="text" class="form-control" name="q19where-{{$procedure['id']}}"></td>
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
