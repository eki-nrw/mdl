<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\MVC\Symfony\View\Event;

use Symfony\Component\EventDispatcher\Event;
use Symfony\Component\HttpFoundation\ParameterBag;
use Symfony\Component\HttpFoundation\Request;

/**
 * An event that collects the parameters the ViewBuilder will be provided to build View objects.
 */
class FilterViewBuilderParametersEvent extends Event
{
    /**
     * @var \Symfony\Component\HttpFoundation\Request
     */
    private $request;

    /**
     * Parameters the ViewBuilder will use.
     * @var ParameterBag
     */
    private $parameters;

    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->parameters = new ParameterBag();
    }

    /**
     * @return Request
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * Returns the ParameterBag that holds the ViewBuilder's parameters.
     * @return \Symfony\Component\HttpFoundation\ParameterBag
     */
    public function getParameters()
    {
        return $this->parameters;
    }
}
