<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\FormField;
class Formelement extends Model
{
    use HasFactory;
    protected $fillable = [
        'form_field_id',
        'value'
    ];
    public function formfields()
    {
        return $this->belongsTo(Form::class);
    }
   
}
