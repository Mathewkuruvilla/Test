@extends('layouts.app')

@section('content')

<div class="container">
  <h2>Dynamic Form</h2>
  @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
  <form action="{{ route('formStore')}}" method="POST">
  @csrf
    <div class="row">
        <div class="form-group col-md-3">
        <label for="form_name">Form:</label>
        <input type="text" class="form-control" id="form_name" placeholder="Form Name" name="form_name">
        </div>
    </div>
    <div class="row">
        <table class="table table-bordered" id="dynamicTable">  
            <tr>
                <th>Label</th>
                <th>Field Type</th>
                <th>Element values</th>
                <th>Comments</th>
                <th>Action</th>
            </tr>
            <tr id ="0">  
                <td><input type="text" name="addmore[0][label]" placeholder="Enter Label Name" class="form-control" /></td>  
                <td>
                    <select name="addmore[0][caption]" class="form-control  field-type">
                        <option value="">--Select--</option>
                        <option value="1">Text</option>
                        <option value="2">Number</option>
                        <option value="3">select</option>
                    </select>
                </td>  
                <td>

                </td>
                <td><input type="text" name="addmore[0][comments]" placeholder="Enter your comments" class="form-control" /></td>  
                <td><button type="button" name="add" id="add" class="btn btn-success">Add More</button></td>  
            </tr>  
        </table> 
        
    </div>
    <button type="submit" class="btn btn-default">Save</button>
  </form>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        var i = 0;
        $("#add").click(function(){  
        ++i;   
        $("#dynamicTable").append('<tr id='+i+'><td><input type="text" name="addmore['+i+'][label]" placeholder="Enter your Label" class="form-control" /></td><td> <select name="addmore['+i+'][caption]" class="form-control field-type"><option>--Select--</option><option value="1">Text</option><option value="2">Number</option><option value="3">Select</option></select></td><td> </td><td><input type="text" name="addmore['+i+'][comments]" placeholder="Enter your Comments" class="form-control" /></td><td><button type="button" class="btn btn-danger remove-tr">Remove</button></td></tr>');
        });

        $(document).on('click', '.remove-tr', function(){  
            $(this).parents('tr').remove();
        }); 
        $("#dynamicTable").on('change', '.field-type', function(){
            if($(this).val() === "3"){
                let row_id = $(this).parents('tr').prop('id');
                $(this).closest('td').next('td').append('<div id=0><input type="text" name="addmore['+row_id+'][element][0]"> <button type="button" class="btn btn-success add-element">ADD</button></td></tr></div>');
            }else{
                $(this).closest('td').next('td').find('div').remove();
            }
        });
        $("#dynamicTable").on('click',".add-element", function(){ 
            let row_id = $(this).parents('tr').prop('id');
            //let div_id = parseInt($(this).closest('div').prop('id'));
            let div_id = parseInt($(this).parents('td').find('div').last().attr('id'));
            console.log($(this).parents('td').find('div').last().attr('id'));
            div_id = div_id +1;
            $(this).parents('td').append('<div id='+div_id+'><input type="text" name="addmore['+row_id+'][element]['+div_id+']"> <button type="button" class="btn btn-danger remove-element">REMOVE</button></td></tr></div>');
        }); 
        $("#dynamicTable").on('click',".remove-element", function(){ 
            $(this).parent('div').remove();
        });
    });
</script>
@endsection