<?php
/**
 * Created by PhpStorm.
 * User: taras.kostiuk
 * Date: 10/25/2018
 * Time: 3:02 PM
 */

namespace App\Http\Controllers\Api\Auth;

interface LoginUserListener
{
    public function userHasAuthenticate($token);
}
