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

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Controller\ControllerReference;

abstract class BaseView implements View
{
    /**
     * @var string|\Closure
     */
    protected $templateIdentifier;

    /**
     * @var array
     */
    protected $parameters = [];

    /**
     * @var array
     */
    protected $configHash = [];

    /**
     * @var string
     */
    private $viewType = ViewManagerInterface::VIEW_TYPE_FULL;

    /** @var ControllerReference */
    private $controllerReference;

    /** @var \Symfony\Component\HttpFoundation\Response */
    private $response;

    /** @var bool */
    private $isCacheEnabled = true;

    /**
     * @param string|\Closure $templateIdentifier Valid path to the template. Can also be a closure.
     * @param string $viewType
     * @param array $parameters Hash of parameters to pass to the template/closure.
     *
     * @throws \InvalidArgumentException
     */
    public function __construct($templateIdentifier = null, array $parameters = [], $viewType = 'full')
    {
        if (isset($templateIdentifier)) {
            $this->setTemplateIdentifier($templateIdentifier);
        }

        $this->viewType = $viewType;
        $this->parameters = $parameters;
    }

    /**
     * @param array $parameters Hash of parameters to pass to the template/closure
     */
    public function setParameters(array $parameters)
    {
        $this->parameters = $parameters;
    }

    /**
     * Adds a hash of parameters to the existing parameters.
     *
     * @param array $parameters
     */
    public function addParameters(array $parameters)
    {
        $this->parameters = array_replace($this->parameters, $parameters);
    }

    /**
     * @return array
     */
    public function getParameters()
    {
        return $this->getInternalParameters() + $this->parameters;
    }

    /**
     * Checks if $parameterName exists.
     *
     * @param string $parameterName
     *
     * @return bool
     */
    public function hasParameter($parameterName)
    {
        return isset($this->parameters[$parameterName]);
    }

    /**
     * Returns parameter value by $parameterName.
     * Throws an \InvalidArgumentException if $parameterName is not set.
     *
     * @param string $parameterName
     *
     * @throws \InvalidArgumentException
     *
     * @return mixed
     */
    public function getParameter($parameterName)
    {
        if ($this->hasParameter($parameterName)) {
            return $this->parameters[$parameterName];
        }

        throw new InvalidArgumentException("Parameter '$parameterName' is not set.");
    }

    /**
     * @param string|\Closure $templateIdentifier
     *
     * @throws \InvalidArgumentException
     */
    public function setTemplateIdentifier($templateIdentifier)
    {
        if (!is_string($templateIdentifier) && !$templateIdentifier instanceof \Closure) {
            throw new \InvalidArgumentException(sprintf("Parameter 'templateIdentifier' must be string or \Closure. Given %s.", get_type($templateIdentifier)));
        }

        $this->templateIdentifier = $templateIdentifier;
    }

    /**
     * @return string|\Closure
     */
    public function getTemplateIdentifier()
    {
        return $this->templateIdentifier;
    }

    /**
     * Injects the config hash that was used to match and generate the current view.
     * Typically, the hash would have as keys:
     *  - template : The template that has been matched
     *  - match : The matching configuration, including the matcher "identifier" and what has been passed to it.
     *  - matcher : The matcher object.
     *
     * @param array $config
     */
    public function setConfigHash(array $config)
    {
        $this->configHash = $config;
    }

    /**
     * Returns the config hash.
     *
     * @return array|null
     */
    public function getConfigHash()
    {
        return $this->configHash;
    }

    public function setViewType($viewType)
    {
        $this->viewType = $viewType;
    }

    public function getViewType()
    {
        return $this->viewType;
    }

    public function setControllerReference(ControllerReference $controllerReference)
    {
        $this->controllerReference = $controllerReference;
    }

    /**
     * @return \Symfony\Component\HttpKernel\Controller\ControllerReference
     */
    public function getControllerReference()
    {
        return $this->controllerReference;
    }

    /**
     * Override to return internal parameters that will be added to the ones returned by getParameter().
     *
     * @return array
     */
    protected function getInternalParameters()
    {
        return [];
    }

    public function setResponse(Response $response)
    {
        $this->response = $response;
    }

    public function getResponse()
    {
        return $this->response;
    }

    public function setCacheEnabled($cacheEnabled)
    {
        $this->isCacheEnabled = (bool)$cacheEnabled;
    }

    public function isCacheEnabled()
    {
        return $this->isCacheEnabled;
    }
}
