<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\FormField;
class Form extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];
    public function formfields()
    {
        return $this->hasMany(FormField::class);
    }
}
