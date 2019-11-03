<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\MVC\Symfony\View;

use Eki\NRW\Mdl\MVC\Symfony\MVCEvents;
use Eki\NRW\Mdl\MVC\Symfony\Event\PreViewEvent;
use Eki\NRW\Common\Configuration\ConfigResolverInterface;

use Psr\Log\LoggerInterface;
use Symfony\Component\Templating\EngineInterface as TemplateEngineInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use RuntimeException;

abstract class AbstractViewManager implements ViewManagerInterface
{
    /**
     * @var \Psr\Log\LoggerInterface
     */
    protected $logger;

    /**
     * @var \Symfony\Component\Templating\EngineInterface
     */
    protected $templateEngine;

    /**
     * The base layout template to use when the view is requested to be generated
     * outside of the pagelayout.
     *
     * @var string
     */
    protected $viewBaseLayout;

    /**
     * @var ConfigResolverInterface
     */
    protected $configResolver;

    /** @var \Eki\NRW\Mdl\MVC\Symfony\View\Configurator */
    private $viewConfigurator;

    /**
     * @var \Symfony\Component\EventDispatcher\EventDispatcherInterface
     */
    protected $eventDispatcher;

    public function __construct(
        TemplateEngineInterface $templateEngine,
        EventDispatcherInterface $eventDispatcher,
        ConfigResolverInterface $configResolver,
        $viewBaseLayout,
        $viewConfigurator,
        LoggerInterface $logger = null
    ) {
        $this->templateEngine = $templateEngine;
        $this->eventDispatcher = $eventDispatcher;
        $this->configResolver = $configResolver;
        $this->viewBaseLayout = $viewBaseLayout;
        $this->viewConfigurator = $viewConfigurator;
        $this->logger = $logger;
        
        parent::__construct($eventDispatcher, $logger);
    }

    /**
     * Renders passed View object via the template engine.
     * If $view's template identifier is a closure, then it is called directly and the result is returned as is.
     *
     * @param \Eki\NRW\Mdl\MVC\Symfony\View\View $view
     * @param array $defaultParams
     *
     * @return string
     */
    public function renderView(View $view, array $defaultParams = array())
    {
        $defaultParams['viewbaseLayout'] = $this->viewBaseLayout;
        $view->addParameters($defaultParams);
        $this->eventDispatcher->dispatch(
            MVCEvents::PRE_SUBJECT_VIEW,
            new PreViewEvent($view)
        );
        
        $templateIdentifier = $view->getTemplateIdentifier();
        $params = $view->getParameters();
        if ($templateIdentifier instanceof \Closure) {
            return $templateIdentifier($params);
        }

        return $this->templateEngine->render($templateIdentifier, $params);
    }

	/**
	* @inheritdoc
	* 
	*/
    public function renderSubject($subject, $viewType = ViewManagerInterface::VIEW_TYPE_FULL, $parameters = array())
    {
        $view = $this->newView($subject, $parameters, $viewType);
        
        $this->viewConfigurator->configure($view);

        if ($view->getTemplateIdentifier() === null) 
        {
            throw new RuntimeException('Unable to find a template for subject #' . (method_exists($subject, 'getId') ? $subject->getId() : ''));
        }

        return $this->renderView($view, $parameters);
    }

	/**
	* Create a new view
	* 
	* @param object $subject
	* @param string $viewType
	* @param array $parameters
	* 
	* @return \Eki\NRW\Mdl\MVC\Symfony\View\View Implentation of this class
	*/    
    abstract protected function newView($subject, $viewType, array $parameters);
}

