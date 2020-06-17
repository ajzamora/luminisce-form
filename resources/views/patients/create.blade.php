@extends('base')
@section('main')
    <div class="row">
        <div class="col-sm-8 offset-sm-2">
            <h1 class="display-4">I. Patient Information</h1>
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
                <form method="post" action="{{ route('patients.store') }}">
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-md-5">
                            <label for="last_name">Last Name:</label>
                            <input type="text" class="form-control" name="last_name" placeholder="Last Name"/>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="first_name">First Name:</label>
                            <input type="text" class="form-control" name="first_name" placeholder="First Name"/>
                        </div>
                        <div class="form-group col-md-1">
                            <label for="middle_initial">MI:</label>
                            <input type="text" class="form-control" name="middle_initial" placeholder="MI"/>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-1 mr-5">
                            <label for="age">Age:</label>
                            <input type="text" class="form-control p-2" name="age" placeholder="Age"/>
                        </div>
                        <div class="form-group col-md-3 mr-5">
                            <label for="civil_status_id">Civil Status:</label>
                            <select id="civil_status_id" class="form-control">
                                @foreach ($civil_statuses as $civil_status)
                                    <option value="{{ $civil_status->id }}">{{ $civil_status->status }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-3">
                            <legend class="col-form-label pt-0">Sex:</legend>
                            @foreach ($sexes as $sex)
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="{{ $sex->sex }}" name="sex_id" value="{{ $sex->id }}" class="custom-control-input">
                                    <label class="custom-control-label" for="{{ $sex->sex }}">{{ $sex->sex }}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="home_address">Home Address:</label>
                        <input type="text" class="form-control" name="home_address" placeholder="Enter Home Address"/>
                    </div>
                    <div class="form-group">
                        <label for="work_address">Work Address:</label>
                        <input type="text" class="form-control" name="work_address" placeholder="Enter Work Address"/>
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="text" class="form-control" name="email" placeholder="Enter email (e.g. name@example.com)"/>
                    </div>
                    <div class="form-group">
                        <label for="mobile_number">Mobile Number:</label>
                        <input type="text" class="form-control" name="mobile_number" placeholder="Enter mobile number"/>
                    </div>
                    <div class="form-group">
                        <label for="landline_number">Landline Number:</label>
                        <input type="text" class="form-control" name="landline_number" placeholder="Enter landline number"/>
                    </div>
                    <button type="submit" class="btn btn-primary float-right">Add patient</button>
                </form>
            </div>
        </div>
    </div>
@endsection
