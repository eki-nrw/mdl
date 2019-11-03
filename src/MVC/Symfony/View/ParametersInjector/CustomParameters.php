<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\MVC\Symfony\View\ParametersInjector;

use Eki\NRW\Mdl\MVC\Symfony\View\Event\FilterViewParametersEvent;
use Eki\NRW\Mdl\MVC\Symfony\View\ViewEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Injects the contents of the 'params' array passed to the controller as view parameters.
 */
class CustomParameters implements EventSubscriberInterface
{
    public static function getSubscribedEvents()
    {
        return [ViewEvents::FILTER_VIEW_PARAMETERS => 'injectCustomParameters'];
    }

    public function injectCustomParameters(FilterViewParametersEvent $event)
    {
        $builderParameters = $event->getBuilderParameters();

        if (isset($builderParameters['params']) && is_array($builderParameters['params'])) {
            $customParameters = $builderParameters['params'];
            $event->getParameterBag()->add($customParameters);
        }
    }
}
