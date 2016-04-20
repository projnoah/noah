<?php

namespace Noah\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as BaseVerifier;

class VerifyCsrfToken extends BaseVerifier
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [

    ];

    /**
     * @return array
     */
    public function getExcept()
    {
        return noah_installed() ? [
            route('admin.settings.display.upload-logo', [], false),
            route('admin.users.profile.upload-avatar', [], false),
            route('admin.users.profile.resize-avatar', [], false)
        ] : [];
    }

    /**
     * {@inheritdoc}
     */
    protected function shouldPassThrough($request)
    {
        foreach ($this->getExcept() as $except) {
            if ($except !== '/') {
                $except = trim($except, '/');
            }

            if ($request->is($except)) {
                return true;
            }
        }

        return false;
    }
}
