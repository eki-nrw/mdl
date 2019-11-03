<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\MVC\Symfony\View\Builder;

use Eki\NRW\Mdl\MVC\Symfony\View\View;

/**
 * Builds View objects based on an array of parameters.
 */
interface ViewBuilder
{
    /**
     * Tests if the builder matches the given argument.
     *
     * @param mixed $argument Anything the builder can decide against. Example: a controller's request string.
     *
     * @return bool true if the ViewBuilder matches the argument, false otherwise.
     */
    public function matches($argument);

    /**
     * Builds the View based on $parameters.
     *
     * @param array $parameters
     *
     * @return \Eki\NRW\Mdl\MVC\Symfony\View\View An implementation of the View interface
     */
    public function buildView(array $parameters);
}
