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
 * @author Nguyen Tien Hy <ngtienhy@gmail.com>
 */
interface MatcherInterface
{
    /**
     * Injects the request object to match against.
     *
     * @param \Eki\NRW\Mdl\Contexture\ContextAccess\Request $request
     */
    public function setRequest(Request $request);

    /**
     * Returns matched ContextAccess or false if no contextaccess could be matched.
     *
     * @return string|false contextaccess name|no contextaccess could be matched
     */
    public function match();

    /**
     * Returns the matcher's name.
     * This information will be stored in the ContextAccess object itself to quickly be able to identify the matcher type.
     *
     * @return string
     */
    public function getName();
}
