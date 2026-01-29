<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that's loaded on the first page visit.
     *
     * @see https://inertiajs.com/server-side-setup#root-template
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determines the current asset version.
     *
     * @see https://inertiajs.com/asset-versioning
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @see https://inertiajs.com/shared-data
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {
        $segments = $request->segments();
        $breadcrumbs = [];
        $url = '';

        // Always add Home
        $breadcrumbs[] = [
            'label' => 'Home',
            'url' => url('/'),
        ];

        foreach ($segments as $segment) {
            $url .= '/'.$segment;
            $label = ucwords(str_replace('-', ' ', $segment));
            $breadcrumbs[] = [
                'label' => $label,
                'url' => url($url),
            ];
        }

        // Set last item URL to null
        if (count($breadcrumbs) > 0) {
            $breadcrumbs[count($breadcrumbs) - 1]['url'] = null;
        }

        return [
            ...parent::share($request),
            'auth' => [
                'user' => $request->user(),
            ],
            'breadcrumbs' => $breadcrumbs,
        ];
    }
}
