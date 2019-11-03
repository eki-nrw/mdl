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

interface ContextAccessRouterInterface
{
    /**
     * Performs ContextAccess matching given the $request.
     *
     * @param \Eki\NRW\Mdl\Contexture\ContextAccess\Request $request
     *
     * @throws \InvalidArgumentException
     *
     * @return \Eki\NRW\Mdl\Contexture\ContextAccess
     */
    public function match(Request $request);

    /**
     * Matches a ContextAccess by name.
     * Returns corresponding ContextAccess object, according to configuration, with corresponding matcher.
     * If no matcher can be found (e.g. non versatile), matcher property will be "default".
     *
     * @param string $contextAccessName
     *
     * @throws \InvalidArgumentException If $contextaccessName is invalid (i.e. not present in configured list).
     *
     * @return \Eki\NRW\Mdl\Contexture\ContextAccess\ContextAccess
     */
    public function matchByName($contextAccessName);
}
