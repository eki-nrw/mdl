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
use Eki\NRW\Mdl\MVC\Symfony\View\ParametersInjector;
use Eki\NRW\Mdl\MVC\Symfony\View\View;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

/**
 * Injects into a View parameters that were collected via the EventDispatcher.
 */
class EventDispatcherInjector implements ParametersInjector
{
    /**
     * @var \Symfony\Component\EventDispatcher\EventDispatcherInterface
     */
    private $eventDispatcher;

    public function __construct(EventDispatcherInterface $eventDispatcher)
    {
        $this->eventDispatcher = $eventDispatcher;
    }

    public function injectViewParameters(View $view, array $parameters)
    {
        $event = new FilterViewParametersEvent($view, $parameters);
        $this->eventDispatcher->dispatch(ViewEvents::FILTER_VIEW_PARAMETERS, $event);
        $view->addParameters($event->getViewParameters());
    }
}
