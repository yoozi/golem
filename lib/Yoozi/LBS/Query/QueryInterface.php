<?php

namespace Yoozi\LBS\Query;

interface QueryInterface
{
    /**
     * Construct and return the final query API URL.
     *
     * @return string
     */
    public function url();
}
