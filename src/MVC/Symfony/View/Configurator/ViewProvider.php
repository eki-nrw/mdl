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

use Eki\NRW\Mdl\MVC\Symfony\View\View;

/**
 * Configures a view based on the ViewProviders.
 *
 * Typically, the Configured ViewProvider will be included, meaning that Views will be customized based on the
 * view rules defined in the siteaccess aware configuration (content_view, block_view, ...).
 */
class ViewProvider extends BaseProvider
{
	/**
	* @inheritdoc
	* 
	*/
    protected function configureFromProviderView(View $view, View $providerView)
    {
        if (($templateIdentifier = $providerView->getTemplateIdentifier()) !== null) {
            $view->setTemplateIdentifier($templateIdentifier);
        }

        if (($controllerReference = $providerView->getControllerReference()) !== null) {
            $view->setControllerReference($controllerReference);
        }
	}
}
