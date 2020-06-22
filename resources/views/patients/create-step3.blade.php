@extends('base')
@section('main')
    <div class="row">
        <div class="col-sm-8 offset-sm-2">
            <h1 class="display-4">III. Cosmetic Interest Questionnaire</h1>
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
                <form method="post" action="/patients/create-step3">
                    @csrf
                    <hr/>
                    <div class="form-row">
                        <div class="form-group col-md-5">
                            <label for="last_name">Last Name:</label>
                            <input type="text" class="form-control" name="last_name" value="{{ $patient->last_name ?? '' }}" readonly/>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="first_name">First Name:</label>
                            <input type="text" class="form-control" name="first_name" value="{{ $patient->first_name ?? ''}}" readonly/>
                        </div>
                        <div class="form-group col-md-1">
                            <label for="middle_initial">MI:</label>
                            <input type="text" class="form-control" name="middle_initial" value="{{ $patient->middle_initial ?? '' }}" readonly/>
                        </div>
                    </div>
                    <div class="form-group"><hr/>
                        <label for="query01">What are the reasons for your visit today?</label>
                        <input type="text" class="form-control" id="cquery01" name="cquery01" placeholder="Reason for visit" value="{{ $cosmeticForm->cquery01 ?? ''}}" />
                    </div>
                    <div class="form-group"><hr/>
                        <label for="query02">1. When looking at my face in the mirror, I believe I look younger, the same as, or older than my true age.</label>
                        <div class="row ml-1">
                                @foreach($data['cosmetics'][0] as $cosmetic)
                                    <div class="custom-control custom-radio col-md-12">
                                        <input type="radio" id="cquery02-{{ $cosmetic['value'] }}" name="cquery02" value="{{ $cosmetic['value'] }}" class="custom-control-input" {{(isset($cosmeticForm->cquery02) && ($cosmetic['value']==$cosmeticForm->cquery02)) ? "checked" : "" }}>
                                        <label class="custom-control-label" for="cquery02-{{ $cosmetic['value'] }}">{{ $cosmetic['value'] }}</label>
                                    </div>
                                @endforeach
                        </div>
                    </div>
                    <div class="form-group"><hr/>
                        <label for="query03">2. When you look in the mirror, how concerned are you about your wrinkles?</label>
                        <div class="row ml-1">
                            @foreach($data['cosmetics'][1] as $cosmetic)
                                <div class="custom-control custom-radio col-md-12">
                                    <input type="radio" id="cquery03-{{ $cosmetic['value'] }}" name="cquery03" value="{{ $cosmetic['value'] }}" class="custom-control-input" {{(isset($cosmeticForm->cquery03) && ($cosmetic['value']==$cosmeticForm->cquery03)) ? "checked" : "" }}>
                                    <label class="custom-control-label" for="cquery03-{{ $cosmetic['value'] }}">{{ $cosmetic['value'] }}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <hr/>
                    <button type="submit" class="btn btn-primary float-right">Next</button>
                    <a type="button" href="/patients/create-step2" class="btn btn-secondary float-right mr-3">Go Back</a>
                </form>
            </div>
        </div>
    </div>
@endsection
