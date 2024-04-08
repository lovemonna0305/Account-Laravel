<?php

namespace App\Services;

use Illuminate\Http\Request;

class SocialRevoke {

    public function apply($provider)
    {
        $provider_class = __NAMESPACE__ . '\\Revoke\\' . str_replace(' ', '', ucwords(str_replace('_', ' ', $provider.'Revoke')));

        if (class_exists($provider_class)) {
            return (new $provider_class)->apply();
        }
        $revoke = new $provider_class();
        return $revoke->apply();
    }

}