@extends('base')
@section('main')
    <div class="row">
        <div class="col-sm-12">
            @if(session()->get('success'))
                <div class="alert alert-success">
                    {{ session()->get('success') }}
                </div>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <h1 class="display-4">Patients</h1>
            <table class="table table-striped">
                <thead>
                <tr>
                    <td>ID</td>
                    <td>Last Name</td>
                    <td>First Name</td>
                    <td>MI</td>
                    <td>Email</td>
                    <td>Age</td>
                    <td class="text-center" colspan=2>Actions</td>
                </tr>
                </thead>
                <tbody>
                @foreach($patients as $patient)
                    <tr>
                        <td>{{$patient->id}}</td>
                        <td>{{$patient->last_name}}</td>
                        <td>{{$patient->first_name}}</td>
                        <td>{{$patient->middle_initial}}</td>
                        <td>{{$patient->email}}</td>
                        <td>{{$patient->age}}</td>
{{--                        <td class="text-center">--}}
{{--                            <a href="{{ route('patients.edit',$patient->id)}}" class="btn btn-primary">Edit</a>--}}
{{--                        </td>--}}
                        <td class="text-center">
                            <form action="{{ route('patients.destroy', $patient->id)}}" method="post">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger" type="submit">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        <div>
    </div>
    <div class="float-right pr-5 pt-3">
        <a href="{{ route('patients.create-step1')}}" class="btn btn-primary">Add patient</a>
    </div>
@endsection
