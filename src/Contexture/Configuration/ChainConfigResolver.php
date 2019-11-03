<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\Contexture\Configuration;

/**
 * @author Nguyen Tien Hy <ngtienhy@gmail.com>
*/
class ChainConfigResolver implements ConfigResolverInterface
{
    /**
     * @var \Eki\NRW\Mdl\Contexture\Configuration\ConfigResolverInterface[]
     */
    protected $resolvers = array();

    /**
     * @var \Eki\NRW\Mdl\Contexture\Configuration\ConfigResolverInterface[]
     */
    protected $sortedResolvers;

    /**
     * Registers $mapper as a valid mapper to be used in the configuration mapping chain.
     * When this mapper will be called in the chain depends on $priority. The highest $priority is, the earliest the router will be called.
     *
     * @param \Eki\NRW\Mdl\Contexture\Configuration\ConfigResolverInterface $resolver
     * @param int $priority
     */
    public function addResolver(ConfigResolverInterface $resolver, $priority = 0)
    {
        $priority = (int)$priority;
        if (!isset($this->resolvers[$priority])) {
            $this->resolvers[$priority] = array();
        }

        $this->resolvers[$priority][] = $resolver;
        $this->sortedResolvers = array();
    }

    /**
     * @return \Eki\NRW\Mdl\Contexture\Configuration\ConfigResolverInterface[]
     */
    public function getAllResolvers()
    {
        if (empty($this->sortedResolvers)) {
            $this->sortedResolvers = $this->sortResolvers();
        }

        return $this->sortedResolvers;
    }

    /**
     * Sort the registered mappers by priority.
     * The highest priority number is the highest priority (reverse sorting).
     *
     * @return \Eki\NRW\Mdl\Contexture\Configuration\ConfigResolverInterface[]
     */
    protected function sortResolvers()
    {
        $sortedResolvers = array();
        krsort($this->resolvers);

        foreach ($this->resolvers as $resolvers) {
            $sortedResolvers = array_merge($sortedResolvers, $resolvers);
        }

        return $sortedResolvers;
    }

    /**
     * Returns value for $paramName, in $namespace.
     *
     * @param string $paramName The parameter name, without $prefix and the current scope.
     * @param string $namespace Namespace for the parameter name. If null, the default namespace should be used.
     * @param string $scope The scope you need $paramName value for.
     *
     * @throws \eZ\Publish\Core\MVC\Exception\ParameterNotFoundException
     *
     * @return mixed
     */
    public function getParameter($paramName, $namespace = null, $scope = null)
    {
        foreach ($this->getAllResolvers() as $resolver) {
            try {
                return $resolver->getParameter($paramName, $namespace, $scope);
            } catch (ParameterNotFoundException $e) {
                // Do nothing, just let the next resolver handle it
            }
        }

        throw new \InvalidArgumentException("Parameter $paramName not found in namespace $namespace");
    }

    /**
     * Checks if $paramName exists in $namespace.
     *
     * @param string $paramName
     * @param string $namespace If null, the default namespace should be used.
     * @param string $scope The scope you need $paramName value for.
     *
     * @return bool
     */
    public function hasParameter($paramName, $namespace = null, $scope = null)
    {
        foreach ($this->getAllResolvers() as $resolver) {
            $hasParameter = $resolver->hasParameter($paramName, $namespace, $scope);
            if ($hasParameter) {
                return true;
            }
        }

        return false;
    }

    /**
     * Changes the default namespace to look parameter into.
     *
     * @param string $defaultNamespace
     */
    public function setDefaultNamespace($defaultNamespace)
    {
        foreach ($this->getAllResolvers() as $resolver) {
            $resolver->setDefaultNamespace($defaultNamespace);
        }
    }

    /**
     * Not supported.
     *
     * @throws \LogicException
     */
    public function getDefaultNamespace()
    {
        throw new \LogicException('getDefaultNamespace() is not supported by the ChainConfigResolver');
    }
}
