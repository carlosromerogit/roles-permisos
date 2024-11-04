<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that is loaded on the first page visit.
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determine the current asset version.
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {
        return [
            ...parent::share($request),
            'auth' => [
                'user' => $request->user(),
            ],
            'can' => [
                'users.index' =>  $request->user() ? $request->user()->can('users.index') : null,

                'roles.index' =>  $request->user() ? $request->user()->can('roles.index') : null,

                'posts.create' =>  $request->user() ? $request->user()->can('posts.create') : null,

                'posts.edit' =>  $request->user() ? $request->user()->can('posts.edit') : null,

                'posts.destroy' =>  $request->user() ? $request->user()->can('posts.destroy') : null,
            ],
        ];
    }
}
