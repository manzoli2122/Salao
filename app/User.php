<?php

namespace App;

use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Manzoli2122\AAL\Traits\AALUsuarioTrait;
use Manzoli2122\Pacotes\Contracts\Models\DataTableJson;
use DB;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;
    use AALUsuarioTrait;
    

    public function getDatatable() {
        $teste = DB::table('users')
        ->where('ativo', 1) 
        ->select('users.id', 'users.name' )      ;
        return $teste;
    }


    public function findModelJson($id){
        return $this->select(['name', 'apelido'])->find($id);
    }


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];




    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
}
