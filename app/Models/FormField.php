<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Form;
use App\Models\Formelement;
class FormField extends Model
{
    use HasFactory;
    protected $fillable = [
        'form_id',
        'lable',
        'html',
        'field_type',
        'comments',
        'status',
    ];
    public function forms()
    {
        return $this->belongsTo(Form::class);
    }
    public function formelements()
    {
        return $this->hasMany(Formelement::class);
    }
}
