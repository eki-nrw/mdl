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
use Eki\NRW\Mdl\Contexture\ContextAccess\VersatileMatcherInterface;

interface CompoundInterface extends VersatileMatcherInterface
{
    /**
     * Injects the matcher builder, to allow the Compound matcher to properly build the underlying matchers.
     *
     * @param \Eki\NRW\Mdl\Contexture\ContextAccess\MatcherBuilderInterface $matcherBuilder
     */
    public function setMatcherBuilder(MatcherBuilderInterface $matcherBuilder);

    /**
     * Returns all used sub-matchers.
     *
     * @return \Eki\NRW\Mdl\Contexture\ContextAccess\MatcherInterface[]
     */
    public function getSubMatchers();

    /**
     * Replaces sub-matchers.
     *
     * @param \Eki\NRW\Mdl\Contexture\ContextAccess\MatcherInterface[] $subMatchers
     */
    public function setSubMatchers(array $subMatchers);
}
