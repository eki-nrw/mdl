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

/**
 * A simple registry of ViewBuilders that uses the ViewBuilder's match() method to identify the builder.
 */
interface ViewBuilderRegistry
{
    /**
     * Returns the ViewBuilder matching the argument.
     *
     * @param mixed $argument
     *
     * @return \Eki\NRW\Mdl\MVC\Symfony\View\Builder\ViewBuilder|null The ViewBuilder, or null if there's none.
     */
    public function getFromRegistry($argument);

    /**
     * Adds ViewBuilders from the $objects array to the registry.
     *
     * @param \Eki\NRW\Mdl\MVC\Symfony\View\Builder[] $objects
     */
    public function addToRegistry(array $objects);
}
