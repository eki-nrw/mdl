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

abstract class BaseManager
{
    /**
     * @var array Array indexed by priority.
     *            Each priority key is an array of View Provider objects having this priority.
     *            The highest priority number is the highest priority
     */
    protected $viewProviders = array();

    /**
     * @var array(\Eki\NRW\Mdl\MVC\Symfony\View\ViewProvider[])
     */
    protected $sortedViewProviders = array();

    /**
     * Registers $viewProvider as a valid subject view provider.
     * When this view provider will be called in the chain depends on $priority. The highest $priority is, the earliest the router will be called.
     *
     * @param \Eki\NRW\Mdl\MVC\Symfony\View\ViewProvider $viewProvider
     * @param string $subjectKind
     * @param int $priority
     */
    public function addViewProvider(ViewProvider $viewProvider, $subjectKind, $priority = 0)
    {
    	if (!isset($this->viewProviders[$subjectKind]))
    		$this->viewProviders[$subjectKind] = array();
    		
        $this->__addViewProvider($this->viewProviders[$subjectKind], $viewProvider, $priority);
    }

    /**
     * Helper 
     *
     * @param array $property
     * @param \Eki\NRW\Mdl\MVC\Symfony\View\ViewProvider $viewProvider
     * @param int $priority
     */
    protected function __addViewProvider(&$property, $viewProvider, $priority)
    {
        $priority = (int)$priority;
        if (!isset($property[$priority])) {
            $property[$priority] = array();
        }

        $property[$priority][] = $viewProvider;
    }

    /**
     * @return \Eki\NRW\Mdl\MVC\Symfony\View\ViewProvider[]
     * 
     * @param string $subjectKind Kind of subject
     */
    public function getAllViewProviders($subjectKind)
    {
    	if (!isset($this->sortedViewProviders[$subjectKind]))
    		$this->sortedViewProviders[$subjectKind] = array();

    	if (!isset($this->viewProviders[$subjectKind]))
    		$this->viewProviders[$subjectKind] = array();
    	
        if (empty($this->sortedViewProviders[$subjectKind])) {
            $this->sortedViewProviders[$subjectKind] = $this->sortViewProviders($this->viewProviders[$subjectKind]);
        }

        return $this->sortedViewProviders[$subjectKind];
    }

    /**
     * Sort the registered view providers by priority.
     * The highest priority number is the highest priority (reverse sorting).
     *
     * @param array $property view providers to sort
     *
     * @return \Eki\NRW\Mdl\MVC\Symfony\View\ViewProvider[]
     */
    protected function sortViewProviders($property)
    {
        $sortedViewProviders = array();
        krsort($property);

        foreach ($property as $viewProvider) {
            $sortedViewProviders = array_merge($sortedViewProviders, $viewProvider);
        }

        return $sortedViewProviders;
    }
}
