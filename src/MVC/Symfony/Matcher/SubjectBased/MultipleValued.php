<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\MVC\Symfony\Matcher\SubjectBased;

/**
 * Abstract class for basic matchers, accepting multiple values to match against.
 */
abstract class MultipleValued implements MatcherInterface
{
    /**
     * @var array Values to test against with isset(). Key is the actual value.
     */
    protected $values;

    /**
     * Registers the matching configuration for the matcher.
     * $matchingConfig can have single (string|int...) or multiple values (array).
     *
     * @param mixed $matchingConfig
     *
     * @throws \InvalidArgumentException Should be thrown if $matchingConfig is not valid.
     */
    public function setMatchingConfig($matchingConfig)
    {
        $matchingConfig = !is_array($matchingConfig) ? array($matchingConfig) : $matchingConfig;
        $this->values = array_fill_keys($matchingConfig, true);
    }

    /**
     * Returns matcher's values.
     *
     * @return array
     */
    public function getValues()
    {
        return array_keys($this->values);
    }
}
