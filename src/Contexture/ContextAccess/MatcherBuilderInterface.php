<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\Contexture\ContextAccess;

/**
 * 
 * @author Nguyen Tien Hy <ngtienhy@gmail.com>
 */
interface MatcherBuilderInterface
{
    /**
     * Builds contextaccess matcher.
     *
     * @param string $matcherIdentifier "Identifier" of the matcher to build (i.e. its FQ class name).
     * @param mixed $matchingConfiguration Configuration to pass to the matcher. Can be anything the matcher supports.
     * @param \Eki\NRW\Mdl\Contexture\ContextAccess\Request $request The request to match against.
     *
     * @return \Eki\NRW\Mdl\Contexture\ContextAccess\ContextAccess\MatcherInterface
     *
     * @throws \RuntimeException
     */
    public function buildMatcher($matcherIdentifier, $matchingConfiguration, Request $request);
}
