<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\MVC\Symfony\View;

/**
 * A view that can be cached over HTTP.
 *
 * Should allow
 */
interface CachableView
{
    /**
     * Sets the cache as enabled/disabled.
     *
     * @param bool $cacheEnabled
     */
    public function setCacheEnabled($cacheEnabled);

    /**
     * Indicates if cache is enabled or not.
     *
     * @return bool
     */
    public function isCacheEnabled();
}
