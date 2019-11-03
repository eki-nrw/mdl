<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\MVC\Symfony\View\Builder\Registry;

use Eki\NRW\Mdl\MVC\Symfony\View\Builder\ViewBuilderRegistry;

/**
 * A registry of ViewBuilders that uses the ViewBuilder's match() method to identify the builder against
 * a controller string.
 */
class ControllerMatch implements ViewBuilderRegistry
{
    /** @var \Eki\NRW\Mdl\MVC\Symfony\View\Builder\ViewBuilder[] */
    private $registry = [];

    /**
     * @param \Eki\NRW\Mdl\MVC\Symfony\View\Builder\ViewBuilder[] $viewBuilders
     */
    public function addToRegistry(array $viewBuilders)
    {
        $this->registry = array_merge($this->registry, $viewBuilders);
    }

    /**
     * Returns the ViewBuilder that matches the given controller string.
     *
     * @param string $controllerString A controller string to match against. Example: ez_content:viewAction.
     *
     * @return \Eki\NRW\Mdl\MVC\Symfony\View\Builder\ViewBuilder|null
     */
    public function getFromRegistry($controllerString)
    {
        if (!is_string($controllerString)) {
            return null;
        }

        foreach ($this->registry as $viewBuilder) {
            if ($viewBuilder->matches($controllerString)) {
                return $viewBuilder;
            }
        }

        return null;
    }
}
