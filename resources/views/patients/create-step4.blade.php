@extends('base')
@section('main')
    <div class="row">
        <div class="col-sm-8 offset-sm-2">
            <h1 class="display-4">IV. General Appearance or Products of Interest to you</h1>
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
                <form method="post" action="/patients/create-step4">
                    @csrf
                    <div class="form-group"><hr/>
                        <div class="row">
                            <label for="cquery04-extra" class="col-md-5">a. Acne / others (select all that applies)</label>
                            <input type="text" class="form-control col-md-5" name="cquery04-extra" placeholder="Indicate here if not listed" value="{{isset($cosmetic_form->query04) ? explode("|| ", $cosmetic_form->cquery04)[1] : ''}}" />
                        </div>
                        <div class="row mt-2">
                            @foreach($data['acne'] as $acne)
                                <div class="form-check col-md-4 pl-5">
                                    <input class="form-check-input" id="cquery04-{{$acne['id']}}" name="cquery04-{{$acne['id']}}" type="checkbox" value="{{ $acne['value'] }}" {{ (isset($cosmetic_form->cquery04) && (strpos($cosmetic_form->cquery04, $acne['value']) !== false))? "checked" : "" }}>
                                    <label class="form-check-label" for="cquery04-{{$acne['id']}}">{{ $acne['value'] }}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="form-group"><hr/>
                        <div class="row">
                            <label for="cquery05-extra" class="col-md-5">b. Pores (select all that applies)</label>
                            <input type="text" class="form-control col-md-5" name="cquery05-extra" placeholder="Indicate here if not listed" value="{{isset($cosmetic_form->query05) ? explode("|| ", $cosmetic_form->cquery05)[1] : ''}}" />
                        </div>
                        <div class="row mt-2">
                            @foreach($data['pores'] as $pores)
                                <div class="form-check col-md-4 pl-5">
                                    <input class="form-check-input" id="cquery05-{{$pores['id']}}" name="cquery05-{{$pores['id']}}" type="checkbox" value="{{ $pores['value'] }}" {{ (isset($cosmetic_form->cquery05) && (strpos($cosmetic_form->cquery05, $pores['value']) !== false))? "checked" : "" }}>
                                    <label class="form-check-label" for="cquery05-{{$pores['id']}}">{{ $pores['value'] }}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="form-group"><hr/>
                        <div class="row">
                            <label for="cquery06-extra" class="col-md-5">c. Scars / Marks (select all that applies)</label>
                            <input type="text" class="form-control col-md-5" name="cquery06-extra" placeholder="Indicate here if not listed" value="{{isset($cosmetic_form->query06) ? explode("|| ", $cosmetic_form->cquery06)[1] : ''}}" />
                        </div>
                        <div class="row mt-2">
                            @foreach($data['scars'] as $scars)
                                <div class="form-check col-md-4 pl-5">
                                    <input class="form-check-input" id="cquery06-{{$scars['id']}}" name="cquery06-{{$scars['id']}}" type="checkbox" value="{{ $scars['value'] }}" {{ (isset($cosmetic_form->cquery06) && (strpos($cosmetic_form->cquery06, $scars['value']) !== false))? "checked" : "" }}>
                                    <label class="form-check-label" for="cquery06-{{$scars['id']}}">{{ $scars['value'] }}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="form-group"><hr/>
                        <div class="row">
                            <label for="cquery07-extra" class="col-md-5">d. Dark Spots / Dark Circles / Parts (select all that applies)</label>
                            <input type="text" class="form-control col-md-5" name="cquery07-extra" placeholder="Indicate here if not listed" value="{{isset($cosmetic_form->query07) ? explode("|| ", $cosmetic_form->cquery07)[1] : ''}}" />
                        </div>
                        <div class="row mt-2">
                            @foreach($data['spots'] as $spots)
                                <div class="form-check col-md-4 pl-5">
                                    <input class="form-check-input" id="cquery07-{{$spots['id']}}" name="cquery07-{{$spots['id']}}" type="checkbox" value="{{ $spots['value'] }}" {{ (isset($cosmetic_form->cquery07) && (strpos($cosmetic_form->cquery07, $spots['value']) !== false))? "checked" : "" }}>
                                    <label class="form-check-label" for="cquery07-{{$spots['id']}}">{{ $spots['value'] }}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="form-group"><hr/>
                        <div class="row">
                            <label for="cquery08-extra" class="col-md-5">e. Lines / Wrinkles (select all that applies)</label>
                            <input type="text" class="form-control col-md-5" name="cquery08-extra" placeholder="Indicate here if not listed" value="{{isset($cosmetic_form->query08) ? explode("|| ", $cosmetic_form->cquery08)[1] : ''}}" />
                        </div>
                        <div class="row mt-2">
                            @foreach($data['lines'] as $lines)
                                <div class="form-check col-md-4 pl-5">
                                    <input class="form-check-input" id="cquery08-{{$lines['id']}}" name="cquery08-{{$lines['id']}}" type="checkbox" value="{{ $lines['value'] }}" {{ (isset($cosmetic_form->cquery08) && (strpos($cosmetic_form->cquery08, $lines['value']) !== false))? "checked" : "" }}>
                                    <label class="form-check-label" for="cquery08-{{$lines['id']}}">{{ $lines['value'] }}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="form-group"><hr/>
                        <div class="row">
                            <label for="cquery09-extra" class="col-md-5">f. Facial Shape / Structure / Proportion (select all that applies)</label>
                            <input type="text" class="form-control col-md-5" name="cquery09-extra" placeholder="Indicate here if not listed" value="{{isset($cosmetic_form->query09) ? explode("|| ", $cosmetic_form->cquery09)[1] : ''}}" />
                        </div>
                        <div class="row mt-2">
                            @foreach($data['shapes'] as $shapes)
                                <div class="form-check col-md-4 pl-5">
                                    <input class="form-check-input" id="cquery09-{{$shapes['id']}}" name="cquery09-{{$shapes['id']}}" type="checkbox" value="{{ $shapes['value'] }}" {{ (isset($cosmetic_form->cquery09) && (strpos($cosmetic_form->cquery09, $shapes['value']) !== false))? "checked" : "" }}>
                                    <label class="form-check-label" for="cquery09-{{$shapes['id']}}">{{ $shapes['value'] }}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="form-group"><hr/>
                        <div class="row">
                            <label for="cquery10-extra" class="col-md-5">g. Unwanted Fats (select all that applies)</label>
                            <input type="text" class="form-control col-md-5" name="cquery10-extra" placeholder="Indicate here if not listed" value="{{isset($cosmetic_form->query10) ? explode("|| ", $cosmetic_form->cquery10)[1] : ''}}" />
                        </div>
                        <div class="row mt-2">
                            @foreach($data['unwanted'] as $unwanted)
                                <div class="form-check col-md-4 pl-5">
                                    <input class="form-check-input" id="cquery10-{{$unwanted['id']}}" name="cquery10-{{$unwanted['id']}}" type="checkbox" value="{{ $unwanted['value'] }}" {{ (isset($cosmetic_form->cquery10) && (strpos($cosmetic_form->cquery10, $unwanted['value']) !== false))? "checked" : "" }}>
                                    <label class="form-check-label" for="cquery10-{{$unwanted['id']}}">{{ $unwanted['value'] }}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="form-group"><hr/>
                        <div class="row">
                            <label for="cquery11-extra" class="col-md-5">h. Skin Problem (select all that applies)</label>
                            <input type="text" class="form-control col-md-5" name="cquery11-extra" placeholder="Indicate here if not listed" value="{{isset($cosmetic_form->query11) ? explode("|| ", $cosmetic_form->cquery11)[1] : ''}}" />
                        </div>
                        <div class="row mt-2">
                            @foreach($data['skin'] as $skin)
                                <div class="form-check col-md-4 pl-5">
                                    <input class="form-check-input" id="cquery11-{{$skin['id']}}" name="cquery11-{{$skin['id']}}" type="checkbox" value="{{ $skin['value'] }}" {{ (isset($cosmetic_form->cquery11) && (strpos($cosmetic_form->cquery11, $skin['value']) !== false))? "checked" : "" }}>
                                    <label class="form-check-label" for="cquery11-{{$skin['id']}}">{{ $skin['value'] }}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="form-group"><hr/>
                        <div class="row">
                            <label for="cquery12-extra" class="col-md-5">i. Others (select all that applies)</label>
                            <input type="text" class="form-control col-md-5" name="cquery12-extra" placeholder="Indicate here if not listed" value="{{isset($cosmetic_form->query12) ? explode("|| ", $cosmetic_form->cquery12)[1] : ''}}" />
                        </div>
                        <div class="row mt-2">
                            @foreach($data['others'] as $others)
                                <div class="form-check col-md-4 pl-5">
                                    <input class="form-check-input" id="cquery12-{{$others['id']}}" name="cquery12-{{$others['id']}}" type="checkbox" value="{{ $others['value'] }}" {{ (isset($cosmetic_form->cquery12) && (strpos($cosmetic_form->cquery12, $others['value']) !== false))? "checked" : "" }}>
                                    <label class="form-check-label" for="cquery12-{{$others['id']}}">{{ $others['value'] }}</label>
                                </div>
                            @endforeach
                        </div>
                    </div><hr/>
                    <button type="submit" class="btn btn-primary float-right">Next</button>
                    <a type="button" href="/patients/create-step3" class="btn btn-secondary float-right mr-3">Go Back</a>
                </form>
            </div>
        </div>
    </div>

@endsection
