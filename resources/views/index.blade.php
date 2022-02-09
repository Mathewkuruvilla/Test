@extends('layouts.app')

@section('content')

<div class="container">
@if($errors->any())
<div class="alert alert-danger">
{{$errors->first()}}
</div>
@endif
  <h2>Dynamic Form</h2>
  <div class="col-md-12 pull-right">
    <a class="btn btn-primary" href="{{url('form-create')}}" role="button">Create</a>
  </div>
</br></br></br>
  <form action="{{ route('formStore')}}" method="POST">
 
    <div class="row">
        <table class="table table-bordered" id="dynamicTable">  
            <tr>
                <th>Form Name</th>
                <th>Action</th>
            </tr>
            <tr>  
            @foreach($forms as $form)
                <tr>
                    <td>
                       {{ $form->name}}
                    </td>
                    <td>
                       <a href="{{ route('formEdit',$form->id) }}">EDIT</a> &nbsp;&nbsp;&nbsp;&nbsp;
                       <a href="{{ route('formDelete',$form->id) }}">Delete</a>&nbsp;&nbsp;&nbsp;&nbsp;
                       <a href="{{ route('formShow',$form->id) }}">Show</a>
                    </td>
                </tr>
            @endforeach
            </tr>  
        </table> 
        
    </div>
  </form>
</div>
<script type="text/javascript">
    var i = 0;
    $("#add").click(function(){  
    ++i;   
    $("#dynamicTable").append('<tr><td><input type="text" name="addmore['+i+'][label]" placeholder="Enter your Label" class="form-control" /></td><td> <select name="addmore['+i+'][caption]" class="form-control"><option>--Select--</option><option value="text">Text</option><option value="number">Number</option><option value="select">Select</option></select></td><td><input type="text" name="addmore['+i+'][comments]" placeholder="Enter your Comments" class="form-control" /></td><td><button type="button" class="btn btn-danger remove-tr">Remove</button></td></tr>');
    });

$(document).on('click', '.remove-tr', function(){  
    $(this).parents('tr').remove();
}); 
</script>
@endsection