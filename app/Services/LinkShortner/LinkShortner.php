<?php

namespace App\Services\LinkShortner;

use App\Models\ShortUrl;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class LinkShortner
{
    /**
     * @var ShortUrl
     */
    private $shortUrl;

    public function __construct(ShortUrl $shortUrl)
    {
        $this->shortUrl = $shortUrl;
    }

    /**
     * @param array $data
     * @return null
     */
    public function store(array $data = [])
    {
        if (empty($data)) {
            return null;
        }

        $data['slug'] = $this->getRandomSlug();

        return $this->shortUrl->create($data);
    }

    /**
     * @param Request $request
     * @param string $slug
     * @return mixed
     */
    public function openLink(Request $request, string $slug = '')
    {
        $shortUrl = $this->shortUrl->whereSlug($slug)->firstOrFail();

        $shortUrl->trackRedirects()->create([
            'user_agent' => $request->userAgent(),
            'ip'         => $request->ip(),
            'referer'    => $request->server('HTTP_REFERER'),
        ]);

        return $shortUrl->link;
    }

    /**
     * @return string
     */
    private function getRandomSlug()
    {
        $slug = Str::random(config('app.slug_length'));

        if ($this->shortUrl->whereSlug($slug)->exists()) {
            return $this->getRandomSlug();
        }

        return $slug;
    }
}
