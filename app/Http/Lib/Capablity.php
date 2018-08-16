<?php
    /**
     * Created by PhpStorm.
     * User: MSI
     * Date: 5/21/2018
     * Time: 12:46 PM
     */

    namespace App\Http\Lib;


    use Illuminate\Support\Facades\Auth;

    class Capablity
    {
        public static function capablity($role_capa,$data){
            $role=Auth::guard('admin')->user()->role_id;
            if (in_array($role,$role_capa)){
                echo $data;
            }else{
                return false;
            }
        }
    }