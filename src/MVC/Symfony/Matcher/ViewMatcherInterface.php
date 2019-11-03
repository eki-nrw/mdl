<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\MVC\Symfony\Matcher;

use Eki\NRW\Mdl\MVC\Symfony\View\View;

/**
 * Matches a View against a set of matchers.
 */
interface ViewMatcherInterface
{
    /**
     * Registers the matching configuration for the matcher.
     * It's up to the implementor to validate $matchingConfig since it can be anything configured by the end-developer.
     *
     * @param mixed $matchingConfig
     *
     * @throws \InvalidArgumentException Should be thrown if $matchingConfig is not valid.
     */
    public function setMatchingConfig($matchingConfig);

    /**
     * Matches the $view against a set of matchers.
     *
     * @param \Eki\NRW\Mdl\MVC\Symfony\View\View $view
     *
     * @return bool
     */
    public function match(View $view);
}
