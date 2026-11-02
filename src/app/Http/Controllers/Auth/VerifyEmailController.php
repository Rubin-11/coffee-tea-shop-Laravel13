<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class VerifyEmailController extends Controller
{
    /**
     * Подтверждение почты на этом этапе не включаем.
     */
    public function __invoke(Request $request): RedirectResponse
    {
        return redirect()->route('home');
    }
}
