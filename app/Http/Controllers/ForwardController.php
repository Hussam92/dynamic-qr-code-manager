<?php

namespace App\Http\Controllers;

use App\Models\Forward;

class ForwardController extends Controller
{
    public function __invoke(Forward $forward)
    {
        return redirect($forward->content);
    }
}
