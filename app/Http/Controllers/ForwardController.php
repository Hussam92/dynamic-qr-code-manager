<?php

namespace App\Http\Controllers;

use App\Models\Forward;

class ForwardController extends Controller
{
    public function __invoke(Forward $forward): object|string
    {
        if (filter_var($forward->content, FILTER_VALIDATE_URL)) {
            return redirect($forward->content);
        }

        return $forward->content;
    }
}
