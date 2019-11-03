<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\MVC\Symfony\Matcher;

use Eki\NRW\Mdl\MVC\Symfony\View\View;
use SplObjectStorage;
use InvalidArgumentException;

/**
 * A matcher factory based on namespaces: matchers will be searched for as classes.
 *
 * A relative namespace can be defined. If so, getMatcher() will search for the requested matcher
 * inside this namespace if a relative namespace (not starting with '\') is passed.
 */
class ClassNameMatcherFactory implements MatcherFactoryInterface
{
    /**
     * The view configuration this matcher should use for matching.
     * Typically, one of the *_view siteaccess aware settings array.
     *
     * @var array
     */
    protected $matchConfig;

    /**
     * @var \Eki\NRW\Mdl\MVC\Symfony\Matcher\MatcherInterface[]
     */
    protected $matchers = [];

    /**
     * Namespace built-in matchers are relative to.
     *
     * @var string
     */
    protected $matcherRelativeNamespace;

    /**
     * Already matched value objects with their config hash.
     * Key is the view type.
     *
     * @var \SplObjectStorage[]
     */
    protected $alreadyMatched = [];

    public function __construct($relativeNamespace = null, array $matchConfig = [])
    {
        $this->matcherRelativeNamespace = $relativeNamespace;
        $this->matchConfig = $matchConfig;
    }

    /**
     * Returns the matcher object.
     *
     * @param string $matcherIdentifier The matcher identifier.
     *                                  If it begins with a '\' it means it's a FQ class name.
     *                                  If it does not and a relative namespace is set, it is searched inside the
     *                                  relative namespace if set.
     *
     * @throws InvalidArgumentException
     *
     * @return \Eki\NRW\Mdl\MVC\Symfony\Matcher\MatcherInterface|\Eki\NRW\Mdl\MVC\Symfony\Matcher\ViewMatcherInterface
     */
    protected function getMatcher($matcherIdentifier)
    {
        // Not a FQ class name, so take the relative namespace.
        if ($matcherIdentifier[0] !== '\\' && $this->matcherRelativeNamespace !== null) {
            $matcherIdentifier = $this->matcherRelativeNamespace . "\\$matcherIdentifier";
        }

        // Retrieving the matcher instance from in-memory cache
        if (isset($this->matchers[$matcherIdentifier])) {
            return $this->matchers[$matcherIdentifier];
        }

        if (!class_exists($matcherIdentifier)) {
            throw new InvalidArgumentException("Invalid matcher class '$matcherIdentifier'");
        }
        $this->matchers[$matcherIdentifier] = new $matcherIdentifier();

        return $this->matchers[$matcherIdentifier];
    }

    /**
     * Checks if $valueObject has a usable configuration for $viewType.
     * If so, the configuration hash will be returned.
     * $valueObject can be for example a Location or a Content object.
     *
     * @param \Eki\NRW\Mdl\MVC\Symfony\View\View $view
     *
     * @return array|null The matched configuration as a hash, containing template or controller to use, or null if not matched.
     */
    public function match(View $view)
    {
        $viewType = $view->getViewType();

        if (!isset($this->matchConfig[$viewType])) {
            return null;
        }

        if (!isset($this->alreadyMatched[$viewType])) {
            $this->alreadyMatched[$viewType] = new SplObjectStorage();
        }

        // If we already matched, just returned the matched value.
        if (isset($this->alreadyMatched[$viewType][$view])) {
            return $this->alreadyMatched[$viewType][$view];
        }

        foreach ($this->matchConfig[$viewType] as $configHash) {
            $hasMatched = true;
            $matcher = null;
            foreach ($configHash['match'] as $matcherIdentifier => $value) {
                $matcher = $this->getMatcher($matcherIdentifier);
                $matcher->setMatchingConfig($value);
                if (!$matcher->match($view)) {
                    $hasMatched = false;
                }
            }

            if ($hasMatched) {
                return $this->alreadyMatched[$viewType][$view] = $configHash + array('matcher' => $matcher);
            }
        }

        return $this->alreadyMatched[$viewType][$view] = null;
    }

    /**
     * @param array $matchConfig
     *
     * @return AbstractMatcherFactory
     */
    public function setMatchConfig($matchConfig)
    {
        $this->matchConfig = $matchConfig;

        return $this;
    }
}
