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

use Eki\NRW\Mdl\MVC\Symfony\Matcher\MatcherFactoryInterface;
use Eki\NRW\Mdl\MVC\Symfony\View\View;
use Eki\NRW\Mdl\MVC\Symfony\View\ViewProvider;

/**
 * Base for View Providers.
 */
abstract class Configured implements ViewProvider
{
    /**
     * @var \Eki\NRW\Mdl\MVC\Symfony\Matcher\MatcherFactoryInterface
     */
    protected $matcherFactory;

    /**
     * @param \Eki\NRW\Mdl\MVC\Symfony\Matcher\MatcherFactoryInterface $matcherFactory
     */
    public function __construct(MatcherFactoryInterface $matcherFactory)
    {
        $this->matcherFactory = $matcherFactory;
    }

    public function getView(View $view)
    {
        if (($configHash = $this->matcherFactory->match($view)) === null) {
            return null;
        }

        return $this->buildView($configHash);
    }

    /**
     * Builds a View object from $viewConfig.
     *
     * @param array $viewConfig
     *
     * @return View
     */
    protected function buildView(array $viewConfig)
    {
        $view = $this->newView();
        $view->setConfigHash($viewConfig);
        if (isset($viewConfig['params']) && is_array($viewConfig['params'])) {
            $view->addParameters($viewConfig['params']);
        }

        return $view;
    }
    
    /**
	* New appropriate view
	* 
	* @return View
	*/
    abstract protected function newView();
}
