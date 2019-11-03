<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\MVC\Symfony\View\Builder\ParametersFilter;

use Eki\NRW\Mdl\MVC\Symfony\View\Event\FilterViewBuilderParametersEvent;
use Eki\NRW\Mdl\MVC\Symfony\View\ViewEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Collects parameters for the ViewBuilder from the Request.
 */
class RequestAttributes implements EventSubscriberInterface
{
    public static function getSubscribedEvents()
    {
        return [ViewEvents::FILTER_BUILDER_PARAMETERS => 'addRequestAttributes'];
    }

    /**
     * Adds all the request attributes to the parameters.
     *
     * @param \Eki\NRW\Mdl\MVC\Symfony\View\Event\FilterViewBuilderParametersEvent $e
     */
    public function addRequestAttributes(FilterViewBuilderParametersEvent $e)
    {
        $parameterBag = $e->getParameters();
        $parameterBag->add($e->getRequest()->attributes->all());

        // maybe this should be in its own listener ? The ViewBuilder needs it.
        if (!$parameterBag->has('viewType')) {
            $parameterBag->add(['viewType' => null]);
        }
    }
}
