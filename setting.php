<?php 
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = ['application_period', 'confirmation_period'];
    public $timestamps = false;
}
