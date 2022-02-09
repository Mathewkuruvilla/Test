<?php

namespace App\Http\Controllers;
use App\models\Form;
use App\models\FormField;
use App\models\Formelement;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
class DynamicForm extends Controller
{
    public function index(){
        $forms = Form::orderBy('name')->get();
        return view('index',['forms'=> $forms]);
    }
    public function create(){
        return view('form');
    }
    public function Store(Request $request){
        $request->validate([
            'form_name'=>'required',
            'addmore.*.label' => 'required',
            'addmore.*.caption' => 'required',
            'addmore.*.comments' => 'required',
        ]);
        $formName= $request->form_name;
        $data = Form::create(['name'=> strtoupper($formName)]);
        $form_id = $data->id;

        foreach ($request->addmore as $key => $value) { 
            $html_control = $value['caption'];
            $html='';
            $obj = [
                    'form_id' => $form_id,
                    'lable'=> strtoupper($value['label']),
                    'field_type'=> strtoupper($value['caption']),
                    'html'=>$html,
                    'comments'=>strtoupper($value['comments']),
                    'status' => 1,
                ];
                $formfield = $data->formfields()->create($obj);
                
                foreach(Arr::get($value, 'element', []) as  $element){
                    $formfield->formelements()->create(['value'=>$element]); 
                }
                   
                
            }
             return redirect()->route('formindex')->withErrors(['You have Inserted Sucessfully']);
        }
        public function edit($form_id){
            $forms = Form::find($form_id);
            return view('edit',['forms'=> $forms]);
        }
        public function update(Request $request,$form_id){

           $request->validate([
            'form_name'=>'required',
            'addmore.*.label' => 'required',
            'addmore.*.caption' => 'required',
            'addmore.*.comments' => 'required',
            ]);
            $form = Form::find($form_id);
            $form->name = $request->form_name;
            $form->update();
            $fields = Form::find($form_id)->formfields;
            foreach ($fields as $field) {
                $field->formelements()->delete();
            }
            Form::find($form_id)->formfields()->delete();

            foreach ($request->addmore as $key => $value) { 
                $html_control = $value['caption'];
                $html='';
                $obj = [
                        'form_id' => $form_id,
                        'lable'=> strtoupper($value['label']),
                        'field_type'=> strtoupper($value['caption']),
                        'html'=>$html,
                        'comments'=>strtoupper($value['comments']),
                        'status' => 1,
                    ];
                    $formfield = $form->formfields()->create($obj);
                    
                    foreach(Arr::get($value, 'element', []) as  $element){
                        $formfield->formelements()->create(['value'=>$element]); 
                    }                    
            }
            return redirect()->route('formindex')->withErrors(['You have Updated  sucessfully']);
        }
        public function destroy($form_id){
            $fields = Form::find($form_id)->formfields;
            foreach ($fields as $field) {
                $field->formelements()->delete();
            }
            Form::find($form_id)->formfields()->delete();
            Form::find($form_id)->delete();
            
            return redirect()->route('formindex')->withErrors(['You have Deleted Sucessfully']);
        }
        public function show($form_id){
            $forms =  Form::find($form_id);
            return view('show',['forms'=> $forms]);
        }
}
