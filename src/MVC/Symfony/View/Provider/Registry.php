<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\MVC\Symfony\View\Provider;

use Eki\NRW\Mdl\MVC\Symfony\View\View;

class Registry
{
    /**
     * Array of ViewProvider, indexed by handled type.
     * @var \Eki\NRW\Mdl\MVC\Symfony\View\ViewProvider[][]
     */
    private $viewProviders;

    /**
     * @param \Eki\NRW\Mdl\MVC\Symfony\View\View $view
     *
     * @return \Eki\NRW\Mdl\MVC\Symfony\View\ViewProvider[]
     * @throws \InvalidArgumentException
     */
    public function getViewProviders(View $view)
    {
        foreach (array_keys($this->viewProviders) as $type) {
            if ($view instanceof $type) {
                return $this->viewProviders[$type];
            }
        }
        throw new \InvalidArgumentException("Parameter 'view' is invalid. No compatible ViewProvider found for " . gettype($view));
    }

    /**
     * Sets the complete list of view providers.
     *
     * @param array $viewProviders ['type' => [ViewProvider1, ViewProvider2]]
     */
    public function setViewProviders(array $viewProviders)
    {
        $this->viewProviders = $viewProviders;
    }
}
