<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\MVC\Symfony\View\Configurator;

use Eki\NRW\Mdl\MVC\Symfony\View\Configurator;
use Eki\NRW\Mdl\MVC\Symfony\View\Provider\Registry;

/**
 * Configures a view based on the ViewProviders.
 *
 * Typically, the Configured ViewProvider will be included, meaning that Views will be customized based on the
 * view rules defined in the siteaccess aware configuration (content_view, block_view, ...).
 */
abstract class BaseProvider implements Configurator
{
    /** @var Registry */
    private $providerRegistry;

    /**
     * ViewProvider constructor.
     *
     * @param \Eki\NRW\Mdl\MVC\Symfony\View\Provider\Registry $providersRegistry
     */
    public function __construct(Registry $providersRegistry)
    {
        $this->providerRegistry = $providersRegistry;
    }

	/**
	* @inheritdoc
	* 
	*/
    public function configure(View $view)
    {
        foreach ($this->providerRegistry->getViewProviders($view) as $viewProvider) 
        {
            if ($providerView = $viewProvider->getView($view)) 
            {
                $view->setConfigHash($providerView->getConfigHash());
                
                $this->configureFromProviderView($view, $providerView);
                
                $view->addParameters($providerView->getParameters());

                return;
            }
        }
    }
    
    abstract protected function configureFromProviderView(View $view, View $providerView);
}
