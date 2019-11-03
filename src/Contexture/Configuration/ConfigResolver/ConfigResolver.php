<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\Contexture\Configuration\ConfigResolver;

use Eki\NRW\Mdl\Contexture\ContextAccess\ContextAccess;
use Eki\NRW\Mdl\Contexture\ContextAccess\ContextAccessAware;

/**
 * This class will help you get settings for a specific scope.
 * This is useful to get a setting for a specific contextaccess for example.
 *
 * It will check the different scopes available for a given namespace to find the appropriate parameter.
 * To work, the dynamic setting must comply internally to the following name format : "<namespace>.<scope>.parameter.name".
 *
 * - <namespace> is the namespace for your dynamic setting. Defaults to eg. "settings", but can be anything.
 * - <scope> is basically the contextaccess name you want your parameter value to apply to.
 *   Can also be "global" for a global override.
 *   Another scope is used internally: "default". This is the generic fallback.
 *
 * The resolve scope order is the following:
 * 1. "global"
 * 2. "current" name
 * 3. "default"
 * 
 * @author Nguyen Tien Hy <ngtienhy@gmail.com>
 */
class ConfigResolver implements VersatileScopeInterface, ContextAccessAware
{
    const SCOPE_GLOBAL = 'global';
    const SCOPE_DEFAULT = 'default';

    const UNDEFINED_STRATEGY_EXCEPTION = 1;
    const UNDEFINED_STRATEGY_NULL = 2;

    /**
	* @var ScopeGroupingInterface
	*/
    protected $scopeGrouping;

    /**
     * @var string
     */
    protected $defaultNamespace;

    /**
     * @var string
     */
    protected $defaultScope;

    /**
     * @var int
     */
    protected $undefinedStrategy;
    
    /**
	* @var ParametersGetterInterface
	*/
    protected $parametersGetter;

    /**
     * @param ScopeGroupingInterface $scopeGrouping scope groups, indexed by scope.
     * @param string $defaultNamespace The default namespace
     * @param int $undefinedStrategy Strategy to use when encountering undefined parameters.
     *                               Must be one of
     *                                  - ConfigResolver::UNDEFINED_STRATEGY_EXCEPTION (throw an exception)
     *                                  - ConfigResolver::UNDEFINED_STRATEGY_NULL (return null)
     */
    public function __construct(
        ScopeGroupingInterface $scopeGrouping,
        $defaultNamespace,
        ParametersGetterInterface $parametersGetter,
        $undefinedStrategy = self::UNDEFINED_STRATEGY_EXCEPTION
    ) {
        $this->scopeGrouping = $scopeGrouping;
        $this->defaultNamespace = $defaultNamespace;
        $this->undefinedStrategy = $undefinedStrategy;
    }

    /**
     * Sets the strategy to use if an undefined parameter is being asked.
     * Can be one of:
     *  - ConfigResolver::UNDEFINED_STRATEGY_EXCEPTION (throw an exception)
     *  - ConfigResolver::UNDEFINED_STRATEGY_NULL (return null).
     *
     * Defaults to ConfigResolver::UNDEFINED_STRATEGY_EXCEPTION.
     *
     * @param int $undefinedStrategy
     */
    public function setUndefinedStrategy($undefinedStrategy)
    {
        $this->undefinedStrategy = $undefinedStrategy;
    }

    /**
     * @return int
     */
    public function getUndefinedStrategy()
    {
        return $this->undefinedStrategy;
    }

    /**
     * Checks if $paramName exists in $namespace.
     *
     * @param string $paramName
     * @param string $namespace If null, the default namespace should be used.
     * @param string $scope The scope you need $paramName value for. It's typically the contextaccess name.
     *                      If null, the current contextaccess name will be used.
     *
     * @return bool
     */
    public function hasParameter($paramName, $namespace = null, $scope = null)
    {
        $namespace = $namespace ?: $this->defaultNamespace;
        $scope = $scope ?: $this->getDefaultScope();

        $defaultScopeParamName = "$namespace." . self::SCOPE_DEFAULT . ".$paramName";
        $globalScopeParamName = "$namespace." . self::SCOPE_GLOBAL . ".$paramName";
        $relativeScopeParamName = "$namespace.$scope.$paramName";

        // Relative scope, contextaccess group wise
        $groupScopeHasParam = false;
        if (null !== ($groupNames = $this->scopeGrouping->getGroupNames()))
            foreach ($groupNames as $groupName) {
                $groupScopeParamName = "$namespace.$groupName.$paramName";
                if ($this->parametersGetter->hasParameter($groupScopeParamName)) {
                    $groupScopeHasParam = true;
                    break;
                }
            }
        }

        return
            $this->parametersGetter->hasParameter($defaultScopeParamName)
            || $groupScopeHasParam
            || $this->parametersGetter->hasParameter($relativeScopeParamName)
            || $this->parametersGetter->hasParameter($globalScopeParamName);
    }

    /**
     * Returns value for $paramName, in $namespace.
     *
     * @param string $paramName The parameter name, without $prefix and the current scope (i.e. contextaccess name).
     * @param string $namespace Namespace for the parameter name. If null, the default namespace will be used.
     * @param string $scope The scope you need $paramName value for. It's typically the contextaccess name.
     *                      If null, the current contextaccess name will be used.
     *
     * @throws \InvalidArgumentException
     *
     * @return mixed
     */
    public function getParameter($paramName, $namespace = null, $scope = null)
    {
        $namespace = $namespace ?: $this->defaultNamespace;
        $scope = $scope ?: $this->getDefaultScope();
        $triedScopes = array();

        // Global scope
        $globalScopeParamName = "$namespace." . self::SCOPE_GLOBAL . ".$paramName";
        if ($this->parametersGetter->hasParameter($globalScopeParamName)) {
            return $this->parametersGetter->getParameter($globalScopeParamName);
        }
        $triedScopes[] = self::SCOPE_GLOBAL;
        unset($globalScopeParamName);

        // Relative scope, contextaccess wise
        $relativeScopeParamName = "$namespace.$scope.$paramName";
        if ($this->parametersGetter->hasParameter($relativeScopeParamName)) {
            return $this->parametersGetter->getParameter($relativeScopeParamName);
        }
        $triedScopes[] = $scope;
        unset($relativeScopeParamName);

        // Relative scope, contextaccess group wise
        if (null !== ($groupNames = $this->scopeGrouping->getGroupNames()))
            foreach ($groupNames as $groupName) {
                $relativeScopeParamName = "$namespace.$groupName.$paramName";
                if ($this->parametersGetter->hasParameter($relativeScopeParamName)) {
                    return $this->parametersGetter->getParameter($relativeScopeParamName);
                }
            }
        }

        // Default scope
        $defaultScopeParamName = "$namespace." . self::SCOPE_DEFAULT . ".$paramName";
        if ($this->parametersGetter->hasParameter($defaultScopeParamName)) {
            return $this->parametersGetter->getParameter($defaultScopeParamName);
        }
        $triedScopes[] = $this->defaultNamespace;
        unset($defaultScopeParamName);

        // Undefined parameter
        switch ($this->undefinedStrategy) {
            case self::UNDEFINED_STRATEGY_NULL:
                return null;

            case self::UNDEFINED_STRATEGY_EXCEPTION:
            default:
                throw new \InvalidArgumentException(sprintf("Parameter $paramName in namespace $namespace not found trying scopes [%s]", implode(", ", $triedScopes)));
        }
    }

    /**
     * Changes the default namespace to look parameter into.
     *
     * @param string $defaultNamespace
     */
    public function setDefaultNamespace($defaultNamespace)
    {
        $this->defaultNamespace = $defaultNamespace;
    }

    /**
     * @return string
     */
    public function getDefaultNamespace()
    {
        return $this->defaultNamespace;
    }

    public function getDefaultScope()
    {
        return $this->defaultScope;
    }

    public function setDefaultScope($scope)
    {
        $this->defaultScope = $scope;
    }
}
