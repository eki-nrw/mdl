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
 * Interface for ContextAccess matchers.
 *
 * VersatileMatcher makes it possible to do a reverse match (e.g. "Is this matcher knows provided ContextAccess name?").
 * Versatile matchers enable cross-contextaccess linking.
 * 
 * @author Nguyen Tien Hy <ngtienhy@gmail.com>
 */
interface VersatileMatcherInterface extends MatcherInterface
{
    /**
     * Returns matcher object corresponding to $contextaccessName or null if non applicable.
     *
     * Note: VersatileMatcher objects always receive a request with cleaned up pathinfo (i.e. no ContextAccess part inside).
     *
     * @param string $contextaccessName
     *
     * @return \Eki\NRW\Mdl\Contexture\ContextAccess\VersatileMatcherInterface|null Typically the current matcher, with updated request.
     */
    public function reverseMatch($contextaccessName);

    /**
     * Returns the request object corresponding to the reverse match.
     * This request object can then be used to build a link to the "reverse matched" ContextAccess.
     *
     * @see reverseMatch()
     *
     * @return \Eki\NRW\Mdl\Contexture\ContextAccess\Request
     */
    public function getRequest();
}
