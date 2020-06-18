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
                    <div class="form-group">
                        <label for="q1">1. Do you have ANY current or chronic illnesses? ( e.g. dermatologic & medical illnesses including cancer/s )</label>
                        <input type="text" class="form-control" name="q1" placeholder="If yes, please indicate" />
                    </div>

                    <button type="submit" class="btn btn-primary float-right">Next</button>
                    <a type="button" href="/patients/create-step2" class="btn btn-secondary float-right mr-3">Go Back</a>
                </form>
            </div>
        </div>
    </div>
@endsection
