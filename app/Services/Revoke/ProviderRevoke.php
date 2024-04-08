<?php

namespace App\Services\Revoke;

interface ProviderRevoke
{
    /**
     * Apply a given search value to the builder instance.
     * 
     * @param Builder $builder
     * @param mixed $value
     * @return Builder $builder
     */
    public function apply();
}