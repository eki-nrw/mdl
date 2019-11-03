<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\MVC\Symfony\View\Builder\Subject;

use Eki\NRW\Mdl\MVC\Symfony\View\Configurator;
use Eki\NRW\Mdl\MVC\Symfony\View\ParametersInjector;
use Eki\NRW\Mdl\MVC\Symfony\View\EmbedView;
use Eki\NRW\Mdl\MVC\Symfony\View\Subject\SubjectView;

/**
 * Builds SubjectView objects.
 */
class ViewBuilder implements ViewBuilder
{
    /** @var \Eki\NRW\Mdl\MVC\Symfony\View\Configurator */
    private $viewConfigurator;

    /** @var \Eki\NRW\Mdl\MVC\Symfony\View\ParametersInjector */
    private $viewParametersInjector;
    
    /**
	* @var Loader
	*/
    private $loader;
    
    /**
	* @var string
	*/
    private $name;
    
    public function __construct(
        Configurator $viewConfigurator,
        ParametersInjector $viewParametersInjector,
        Loader $loader,
        $name = "subject"
    ) 
    {
        $this->viewConfigurator = $viewConfigurator;
        $this->viewParametersInjector = $viewParametersInjector;
        $this->loader = $loader;
        $this->name = $name;
    }

    public function matches($argument)
    {
        return strpos($argument, 'eki_' . $this->name . ':') !== false;
    }

    /**
     * @param array $parameters
     *
     * @return \Eki\NRW\Mdl\MVC\Symfony\View\View
     * 
     * @throws
     */
    public function buildView(array $parameters)
    {
    	$viewType = isset($parameters['viewType']) ? $parameters['viewType'] : null;
    	if (!empty($viewType)) 
    		$view = new SubjectView(null, [], $viewType);
    	else
    		$view = new SubjectView(null, []);
        
        $view->setIsEmbed($this->isEmbed($parameters));
        if ($view->isEmbed() && $viewType === null) 
        {
            $view->setViewType(EmbedView::DEFAULT_VIEW_TYPE);
        }
    		
        if (isset($parameters['subject'])) 
        {
            $subject = $parameters['subject'];
		}
		else if (isset($parameters['subjectId']))
		{
			$subject = $this->loadSubject($view, $parameters['subjectId']);
		}
    		
        $view->setSubject($subject);
    		
        $this->viewParametersInjector->injectViewParameters($view, $parameters);
        $this->viewConfigurator->configure($view);
        
        return $view;
    }

    private function isEmbed($parameters)
    {
        if ($parameters['_controller'] === 'eki_' . $this->name . ':embedAction') 
        {
            return true;
        }
        if (in_array($parameters['viewType'], ['embed', 'embed-inline'])) 
        {
            return true;
        }

        return false;
    }
    
    protected function loadSubject(View $view, $subjectId)
    {
		if ($view->isEmbed())
			return $this->loader->loadEmbeddedSubject($subjectId);
		else
			return $this->loader->loadSubject($subjectId);
	}
}
