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

use Eki\NRW\Common\Common\ValuesObject;

/**
 * Base structure for a contextaccess representation.
 */
class ContextAccess extends ValueObject
{
    /**
     * Name of the contextaccess.
     *
     * @var string
     */
    public $name;

    /**
     * The matching type that has been used to discover the contextaccess.
     * Contains the matcher class FQN, or 'default' if fell back to the default contextaccess.
     *
     * @var string
     */
    public $matchingType;

    /**
     * The matcher instance that has been used to discover the contextaccess.
     *
     * @var \Eki\NRW\Mdl\Contexture\ContextAccess\MatcherInterface
     */
    public $matcher;

    public function __construct($name = null, $matchingType = null, $matcher = null)
    {
        $this->name = $name;
        $this->matchingType = $matchingType;
        $this->matcher = $matcher;
    }

    public function __toString()
    {
        return "$this->name (matched by '$this->matchingType')";
    }
}
