@extends('base')
@section('main')
    <div class="row">
        <div class="col-sm-8 offset-sm-2">
            <h1 class="display-4">Update Patient Information</h1>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                <br />
            @endif
            <form method="post" action="{{ route('patients.update', $patient->id) }}">
                @method('PATCH')
                @csrf
                <div class="form-row">
                    <div class="form-group col-md-5">
                        <label for="last_name">Last Name:</label>
                        <input type="text" class="form-control" name="last_name" placeholder="Last Name" value="{{ $patient->last_name }}" />
                    </div>
                    <div class="form-group col-md-6">
                        <label for="first_name">First Name:</label>
                        <input type="text" class="form-control" name="first_name" placeholder="First Name" value="{{ $patient->first_name }}" />
                    </div>
                    <div class="form-group col-md-1">
                        <label for="middle_initial">MI:</label>
                        <input type="text" class="form-control" name="middle_initial" placeholder="MI" value="{{ $patient->middle_initial }}" />
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-1 mr-5">
                        <label for="age">Age:</label>
                        <input type="text" class="form-control p-2" name="age" placeholder="Age" value="{{ $patient->age }}" />
                    </div>
                    <div class="form-group col-md-3 mr-5">
                        <label for="civil_status_id">Civil Status:</label>
                        <select id="civil_status_id" name="civil_status_id" class="form-control custom-select" value="{{ $patient->civil_status_id }}" >
                            @foreach ($civil_statuses as $civil_status)
                                <option value="{{ $civil_status->id }}" {{ ($civil_status->id==$patient->civil_status_id)? "selected" : "" }} >{{ $civil_status->status }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <legend class="col-form-label pt-0">Sex:</legend>
                        @foreach ($sexes as $sex)
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="{{ $sex->sex }}" name="sex_id" value="{{ $sex->id }}" class="custom-control-input" {{ ($sex->id==$patient->sex_id)? "checked" : "" }} >
                                <label class="custom-control-label" for="{{ $sex->sex }}">{{ $sex->sex }}</label>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="email">Email:</label>
                        <input type="text" class="form-control" name="email" placeholder="Email (e.g. name@example.com)" value="{{ $patient->email }}" />
                    </div>
                    <div class="form-group col-md-3">
                        <label for="mobile_number">Mobile Number:</label>
                        <input type="text" class="form-control" name="mobile_number" placeholder="Mobile number" value="{{ $patient->mobile_number }}" />
                    </div>
                    <div class="form-group col-md-3">
                        <label for="landline_number">Landline Number:</label>
                        <input type="text" class="form-control" name="landline_number" placeholder="Landline number" value="{{ $patient->landline_number }}" />
                    </div>
                </div>
                <div class="form-group">
                    <label for="home_address">Home Address:</label>
                    <input type="text" class="form-control" name="home_address" placeholder="Home Address" value="{{ $patient->home_address }}" />
                </div>
                <div class="form-group">
                    <label for="work_address">Work Address:</label>
                    <input type="text" class="form-control" name="work_address" placeholder="Work Address" value="{{ $patient->work_address }}" />
                </div>
                <button type="submit" class="btn btn-primary float-right">Update</button>
            </form>
        </div>
    </div>
@endsection
