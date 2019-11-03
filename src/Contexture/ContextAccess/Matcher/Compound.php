<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\Contexture\ContextAccess\Matcher;

use Eki\NRW\Mdl\Contexture\ContextAccess\MatcherInterface;
use Eki\NRW\Mdl\Contexture\ContextAccess\MatcherBuilderInterface;
use Eki\NRW\Mdl\Contexture\ContextAccess\Request;

/**
 * Base for Compound contextaccess matchers.
 * All classes extending this one must implement a NAME class constant.
 */
abstract class Compound implements CompoundInterface
{
    /**
     * @var array Collection of rules using the Compound matcher.
     */
    protected $config;

    /**
     * Matchers map.
     * Consists of an array of matchers, grouped by ruleset (so array of array of matchers).
     *
     * @var array
     */
    protected $matchersMap = array();

    /**
     * @var \Eki\NRW\Mdl\Contexture\ContextAccess\MatcherInterface[]
     */
    protected $subMatchers = array();

    /**
     * @var \Eki\NRW\Contexting\ContextAccess\MatcherBuilderInterface
     */
    protected $matcherBuilder;

    /**
     * @var \Eki\NRW\Mdl\Contexture\ContextAccess\Request
     */
    protected $request;

    public function __construct(array $config)
    {
        $this->config = $config;
        $this->matchersMap = array();
    }

    public function setMatcherBuilder(MatcherBuilderInterface $matcherBuilder)
    {
        $this->matcherBuilder = $matcherBuilder;
        foreach ($this->config as $i => $rule) {
            foreach ($rule['matchers'] as $matcherClass => $matchingConfig) {
                $this->matchersMap[$i][$matcherClass] = $matcherBuilder->buildMatcher($matcherClass, $matchingConfig, $this->request);
            }
        }
    }

    public function setRequest(Request $request)
    {
        $this->request = $request;
        foreach ($this->matchersMap as $ruleset) {
            foreach ($ruleset as $matcher) {
                $matcher->setRequest($request);
            }
        }
    }

    public function getRequest()
    {
        return $this->request;
    }

    public function getSubMatchers()
    {
        return $this->subMatchers;
    }

    public function setSubMatchers(array $subMatchers)
    {
        $this->subMatchers = $subMatchers;
    }

    /**
     * Returns the matcher's name.
     * This information will be stored in the ContextAccess object itself to quickly be able to identify the matcher type.
     *
     * @return string
     */
    public function getName()
    {
        return
           'compound:' .
           static::NAME . '(' .
           implode(
               ', ',
               array_keys($this->getSubMatchers())
           ) . ')';
    }

    /**
     * Serialization occurs when serializing the contextaccess for subrequests.
     *
     */
    public function __sleep()
    {
        // We don't need the whole matcher map and the matcher builder once serialized.
        // config property is not needed either as it's only needed for matching.
        return array('subMatchers');
    }
}
