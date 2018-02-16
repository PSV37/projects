<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name','last_name', 'email', 'password','role_id','image',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $appends = ['name_initials', 'full_name'];

    public function role()
    {
        return $this->belongsTo('App\Role');
    }

    public function post()
    {
        return $this->belongsTo('App\Post');
    }

    /**
     * Name Initials of user
     * @param string $strReturnValue
     */
    public function getNameInitialsAttribute() {
        $strReturnValue = '';
        $firstChar = '';
        $lastChar = '';
        try {
            $lenRemaining=2;
            $firstName=$this->attributes['first_name'];
            $last_name=$this->attributes['last_name'];
            if ($last_name && strlen($last_name)>0) {
                $lastChar=substr($last_name,0,1);
                $lenRemaining--;
            }
            if ($firstName && strlen($firstName)>0) {
                $firstChar=substr($firstName,0,$lenRemaining);
            }

            $strReturnValue = strtoupper($firstChar.$lastChar);
        } catch (Exception $e) {
            $strReturnValue='';
        }
        return $strReturnValue;
    } //Function ends

     /**
     * Name Full Name of user
     * @param string $strReturnValue
     */
    public function getFullNameAttribute() {
        $strReturnValue = '';
        $firstPart = '';
        $lastPart = '';
        $spacer = '';
        try {
            $lenRemaining=2;
            $firstName=$this->attributes['first_name'];
            $lastName=$this->attributes['last_name'];
            if ($lastName && strlen($lastName)>0) {
                $lastPart=$lastName;
            }
            if ($firstName && strlen($firstName)>0) {
                $firstPart=$firstName;
            }

            //Set dilimiter value
            if(strlen($firstPart)>0 && strlen($lastPart)>0) {$spacer=' ';}

            $strReturnValue = $firstPart.$spacer.$lastPart;
        } catch (Exception $e) {
            $strReturnValue='';
        }
        return $strReturnValue;
  }
}
