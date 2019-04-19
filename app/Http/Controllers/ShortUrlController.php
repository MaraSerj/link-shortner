<?php

namespace App\Http\Controllers;

use App\Services\LinkShortner\LinkShortner;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class ShortUrlController extends Controller
{
    use ApiResponse;

    /**
     * @var LinkShortner
     */
    protected $linkShortner;

    /**
     * ShortUrlController constructor.
     * @param LinkShortner $linkShortner
     */
    public function __construct(LinkShortner $linkShortner)
    {
        $this->linkShortner = $linkShortner;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'link' => 'required|url|min:5'
        ]);

        $data = $request->only(['link']);
        if (auth()->check()) {
            $data['user_id'] = auth()->id();
        }

        $link = $this->linkShortner->store($data);
        if (empty($link)) {
            return $this->respondBadRequest();
        }

        return $this->respondCreated([
            'link' => route('redirect', ['any' => $link->slug])
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @param $slug
     * @return void
     */
    public function show(Request $request, $slug)
    {
        if (empty($slug)) {
            return view('home');
        }

        $link = $this->linkShortner->openLink($request, $slug);

        if (!empty($link)) {
            return redirect($link, 301, [
                'HTTP_REFERER' => $request->server('HTTP_REFERER'),
            ]);
        }
    }
}
