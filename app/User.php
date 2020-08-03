<?php

namespace App;

use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Schema;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'api_token'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'role' => 'string',
    ];

    /**
     * Return the id of the site admin if exists.
     *
     * @return int|null
     */
    public static function adminId() : ?int
    {
        $admin = DB::table('users')->select('id')->where('role', 'admin')->first();

        return (!is_object($admin) || !property_exists($admin, 'id')) ? null : $admin->id;
    }

    /**
     * Does a site admin exist?
     *
     * @return bool
     */
    public static function adminExists() : bool
    {
        if (!Schema::hasTable('users')) {
            return false;
        }

        return (is_numeric(self::adminId())) ? true : false;
    }

    /**
     * Is current user site admin?
     *
     * @return bool
     */
    public function isAdmin() : bool
    {
        $id = $this->getAttribute('id');

        if (!$id || $id !== $this->adminId()) {
            return false;
        }

        return true;
    }
}
