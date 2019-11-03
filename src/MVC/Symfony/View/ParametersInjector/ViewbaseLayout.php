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
 * Injects the 'viewBaseLayout' view parameter, set by the container parameter.
 */
class ViewbaseLayout implements EventSubscriberInterface
{
    /**
     * @var string
     */
    private $pageLayout;

    /**
     * @var string
     */
    private $viewbaseLayout;

    public function __construct($viewbaseLayout)
    {
        $this->viewbaseLayout = $viewbaseLayout;
    }

    public function setPageLayout($pageLayout)
    {
        $this->pageLayout = $pageLayout;
    }

    public static function getSubscribedEvents()
    {
        return [ViewEvents::FILTER_VIEW_PARAMETERS => 'injectViewbaseLayout'];
    }

    public function injectViewbaseLayout(FilterViewParametersEvent $event)
    {
        $event->getParameterBag()->set('viewbaseLayout', $this->viewbaseLayout);
        $event->getParameterBag()->set('pagelayout', $this->pageLayout);
    }
}
