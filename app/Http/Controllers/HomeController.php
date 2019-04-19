<?php

namespace App\Http\Controllers;

use App\Traits\ApiResponse;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;

class HomeController extends Controller
{
    use ApiResponse;

    /**
     * @return Factory|View
     */
    public function index()
    {
        return view('home');
    }

    /**
     * @return RedirectResponse|Redirector
     */
    public function home()
    {
        return redirect('/');
    }

    /**
     * @return JsonResponse
     */
    public function getAuthUser()
    {
        return $this->respondOK(['user' => auth()->user()]);
    }
}
