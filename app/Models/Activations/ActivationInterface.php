<?php

namespace App\Models\Activations;

interface ActivationInterface
{
    /**
     * Return the random string used as activation code.
     *
     * @return mixed
     */
    public function getCode();
}
