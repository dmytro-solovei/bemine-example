<?php

namespace App\Http\Middleware;

use App\Http\Requests\Request;

class HandleInertiaRequests
{
    /**
     * @param Request $request
     * @return array
     */
    public function share(Request $request): array
    {
        return array_merge(parent::share($request), [
            'recaptchav2_sitekey' => config('recaptchav2.sitekey'),
        ]);
    }
}
