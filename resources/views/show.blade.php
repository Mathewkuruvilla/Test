@extends('layouts.app')

@section('content')

<div class="container">
@if($errors->any())
<div class="alert alert-danger">
{{$errors->first()}}
</div>
@endif
  <div class="col-md-12 pull-right">
    <a class="btn btn-primary" href="/form" role="button">LIST FORMS</a>
  </div></br></br>
  <form action="{{ route('formStore')}}" method="POST">
 
    <div class="row">
        <h2>{{$forms->name}}</h2>
        <table class="table table-bordered" id="dynamicTable">
        @foreach(Arr::get($forms, 'formfields', []) as $key => $formfield)
            <tr>
                <th>{{$formfield->lable}}</th>
                @if ($formfield->field_type == 1)
                    <th><input type="text" name="{{$key}}" class="form-control"></th>
                @elseif($formfield->field_type == 2)
                    <th><input type="number" name="{{$key}}" class="form-control"></th>
                 @elseif($formfield->field_type == 3)
                    <th>
                    <select name="$key" class="form-control  field-type">
                        <option value="">--Select--</option> 
                        @foreach($formfield->formelements as $elementkey =>   $formelement )
                        <option value="{{ $elementkey}}">{{$formelement->value}}</option>
                        @endforeach         
                    </select>
                    </th>
                @endif
            </tr>
        @endforeach
        </table> 
        
    </div>
  </form>
</div>

@endsection