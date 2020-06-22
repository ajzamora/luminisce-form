@extends('base')
@section('main')
    <div class="row">
        <div class="col-sm-10 offset-sm-1">
            <h1 class="display-4">V. Other</h1>
            <h5>All questions contained in this questionnaire are strictly confidential and will become part of your medical record.</h5>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
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
                    <form method="post" action="/patients/create-step5">
                    @csrf
                    <hr/>
                    <table id="d-table" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <td class="text-center" width="10%">Transaction Date</td>
                            <td class="text-center" width="15%">Particulars</td>
                            <td class="text-center" width="10%">Amount Paid</td>
                            <td class="text-center" width="10%">Mode of Payment</td>
                            <td class="text-center" width="10%">Balance</td>
                            <td class="text-center" width="10%">DC</td>
                            <td class="text-center" width="20%">Packages</td>
                            <td class="text-center" width="14%">Remarks</td>
                            <td class="text-center" width="1%"><input type="button" onclick="add('dynamicInput')" class="btn btn-success" value="+"></td>
                        </tr>
                        </thead>
                        <tbody id="dynamicInput">
{{--                        @for ($i = 0; $i < 10; $i++)--}}
{{--                            <tr>--}}
{{--                                <td><input type="text" class="form-control form-control-md" name="trans[date][]" value="{{$i}}"></td>--}}
{{--                                <td><input type="text" class="form-control form-control-md" name="trans[particular][]" value="{{$i}}"></td>--}}
{{--                                <td><input type="text" class="form-control form-control-md" name="trans[paid][]" value="{{$i}}"></td>--}}
{{--                                <td><input type="text" class="form-control form-control-md" name="trans[mode][]" value="{{$i}}"></td>--}}
{{--                                <td><input type="text" class="form-control form-control-md" name="trans[bal][]" value="{{$i}}"></td>--}}
{{--                                <td><input type="text" class="form-control form-control-md" name="trans[dc][]" value="{{$i}}"></td>--}}
{{--                                <td><input type="text" class="form-control form-control-md" name="trans[packages][]" value="{{$i}}"></td>--}}
{{--                                <td><input type="text" class="form-control form-control-md" name="trans[remarks][]" value="{{$i}}"></td>--}}
{{--                                <td class="text-center"><input type="button" class="btn btn-danger remove-row" value="x" onclick="del()"></td>--}}
{{--                            </tr>--}}
{{--                        @endfor--}}
                        @if (isset($transaction['date']) && is_countable($transaction['date']))
                            @for ($i = 0; $i < count($transaction['date']); $i++)
                                <tr>
                                    <td><input type="text" class="form-control form-control-md" name="trans[date][]" value="{{$transaction['date'][$i]}}"></td>
                                    <td><input type="text" class="form-control form-control-md" name="trans[particular][]" value="{{$transaction['particular'][$i]}}"></td>
                                    <td><input type="text" class="form-control form-control-md" name="trans[paid][]" value="{{$transaction['paid'][$i]}}"></td>
                                    <td><input type="text" class="form-control form-control-md" name="trans[mode][]" value="{{$transaction['mode'][$i]}}"></td>
                                    <td><input type="text" class="form-control form-control-md" name="trans[bal][]" value="{{$transaction['bal'][$i]}}"></td>
                                    <td><input type="text" class="form-control form-control-md" name="trans[dc][]" value="{{$transaction['dc'][$i]}}"></td>
                                    <td><input type="text" class="form-control form-control-md" name="trans[packages][]" value="{{$transaction['packages'][$i]}}"></td>
                                    <td><input type="text" class="form-control form-control-md" name="trans[remarks][]" value="{{$transaction['remarks'][$i]}}"></td>
                                    <td class="text-center"><input type="button" class="btn btn-danger remove-row" value="x" onclick="del()"></td>
                                </tr>
                            @endfor
                        @else
                        <tr>
                            <td><input type="text" class="form-control form-control-md" name="trans[date][]"></td>
                            <td><input type="text" class="form-control form-control-md" name="trans[particular][]"></td>
                            <td><input type="text" class="form-control form-control-md" name="trans[paid][]"></td>
                            <td><input type="text" class="form-control form-control-md" name="trans[mode][]"></td>
                            <td><input type="text" class="form-control form-control-md" name="trans[bal][]"></td>
                            <td><input type="text" class="form-control form-control-md" name="trans[dc][]"></td>
                            <td><input type="text" class="form-control form-control-md" name="trans[packages][]"></td>
                            <td><input type="text" class="form-control form-control-md" name="trans[remarks][]"></td>
                            <td class="text-center"><input type="button" class="btn btn-danger remove-row" value="x" onclick="del()"></td>
                        </tr>
                        @endif
                        </tbody>
                    </table>
                    <hr/>
                    <button type="submit" class="btn btn-primary float-right">Next</button>
                    <a type="button" href="/patients/create-step4" class="btn btn-secondary float-right mr-3">Go Back</a>
                </form>
            </div>
        </div>
    </div>

@endsection
<script>
    function add(divName) {
        let newrow = document.createElement('tr');
        newrow.innerHTML =
            '<td><input type="text" class="form-control form-control-md" name="trans[date][]"></td>' +
            '<td><input type="text" class="form-control form-control-md" name="trans[particular][]"></td>' +
            '<td><input type="text" class="form-control form-control-md" name="trans[paid][]"></td>' +
            '<td><input type="text" class="form-control form-control-md" name="trans[mode][]"></td>' +
            '<td><input type="text" class="form-control form-control-md" name="trans[bal][]"></td>' +
            '<td><input type="text" class="form-control form-control-md" name="trans[dc][]"></td>' +
            '<td><input type="text" class="form-control form-control-md" name="trans[packages][]"></td>' +
            '<td><input type="text" class="form-control form-control-md" name="trans[remarks][]"></td>' +
            '<td class="text-center"><input type="button" class="btn btn-danger remove-row" value="x" onclick="del()"></td>';
        document.getElementById(divName).appendChild(newrow);
    }

    function del() {
        $("#d-table").on('click','.remove-row',function(){
            $(this).closest('tr').remove();
        });
    }
</script>
