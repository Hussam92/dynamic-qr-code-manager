<?php

namespace App\Http\Controllers;

use App\Models\Forward;
use Illuminate\Http\Request;

class ForwardController extends Controller
{
    public function __invoke(Forward $forward)
    {
        return redirect($forward->content);
    }
}
