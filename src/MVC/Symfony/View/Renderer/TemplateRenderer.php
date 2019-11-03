<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\MVC\Symfony\View\Renderer;

use Eki\NRW\Mdl\MVC\Symfony\View\Renderer;
use Eki\NRW\Mdl\MVC\Symfony\View\View;
use Eki\NRW\Mdl\MVC\Exception\NoViewTemplateException;
use Eki\NRW\Mdl\MVC\Symfony\MVCEvents;
use Eki\NRW\Mdl\MVC\Symfony\Event\PreViewEvent;

use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\Templating\EngineInterface as TemplateEngine;
use Closure;

class TemplateRenderer implements Renderer
{
    /**
     * @var \Symfony\Component\Templating\EngineInterface
     */
    protected $templateEngine;

    /**
     * @var \Symfony\Component\EventDispatcher\EventDispatcherInterface
     */
    protected $eventDispatcher;

    public function __construct(TemplateEngine $templateEngine, EventDispatcherInterface $eventDispatcher)
    {
        $this->templateEngine = $templateEngine;
        $this->eventDispatcher = $eventDispatcher;
    }

    /**
     * @param \Eki\NRW\Mdl\MVC\Symfony\View\View $view
     *
     * @throws NoViewTemplateException
     *
     * @return string
     */
    public function render(View $view)
    {
        $this->eventDispatcher->dispatch(
            MVCEvents::PRE_SUBJECT_VIEW,
            new PreViewEvent($view)
        );

        $templateIdentifier = $view->getTemplateIdentifier();
        if ($templateIdentifier instanceof Closure) {
            return $templateIdentifier($view->getParameters());
        }

        if ($view->getTemplateIdentifier() === null) {
            throw new NoViewTemplateException($view);
        }

        return $this->templateEngine->render(
            $view->getTemplateIdentifier(),
            $view->getParameters()
        );
    }
}
