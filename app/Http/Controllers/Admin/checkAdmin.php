<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\Auth;

    class checkAdmin{
        public function check()
        {
            if(Auth::user()->role == 0){
                return view('404');
            } 
        }
    }

?>