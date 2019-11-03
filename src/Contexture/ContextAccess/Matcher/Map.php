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

use Eki\NRW\Mdl\Contexture\ContextAccess\VersatileMatcherInterface;
use Eki\NRW\Mdl\Contexture\ContextAccess\Request;

abstract class Map implements VersatileMatcherInterface
{
    /**
     * String that will be looked up in the map.
     *
     * @var string
     */
    protected $key;

    /**
     * Map used for the matching.
     *
     * @var array
     */
    protected $map;

    /**
     * Map used for reverse matching.
     *
     * @var array
     */
    protected $reverseMap;

    /**
     * @var \Eki\NRW\Mdl\Contexture\ContextAccess\Request
     */
    protected $request;

    /**
     * Constructor.
     *
     * @param array $map Map used for matching.
     */
    public function __construct(array $map)
    {
        $this->map = $map;
    }

    /**
     * Do not serialize the Contextaccess configuration in order to reduce ESI request URL size.
     *
     * @see https://jira.ez.no/browse/EZP-23168
     *
     * @return array
     */
    public function __sleep()
    {
        $this->map = array();
        $this->reverseMap = array();

        return array('map', 'reverseMap', 'key');
    }

    public function setRequest(Request $request)
    {
        $this->request = $request;
    }

    public function getRequest()
    {
        return $this->request;
    }

    /**
     * Injects the key that will be used for matching against the map configuration.
     *
     * @param string $key
     */
    public function setMapKey($key)
    {
        $this->key = $key;
    }

    /**
     * @return string
     */
    public function getMapKey()
    {
        return $this->key;
    }

    /**
     * Returns matching Contextaccess.
     *
     * @return string|false Contextaccess matched or false.
     */
    public function match()
    {
        return isset($this->map[$this->key])
            ? $this->map[$this->key]
            : false;
    }

    /**
     * @param string $contextAccessName
     *
     * @return \Eki\NRW\Component\Core\MVC\Symfony\ContextAccess\MatcherInterface|Map|null
     */
    public function reverseMatch($contextAccessName)
    {
        $reverseMap = $this->getReverseMap($contextAccessName);

        if (!isset($reverseMap[$contextAccessName])) {
            return null;
        }

        $this->setMapKey($reverseMap[$contextAccessName]);

        return $this;
    }

    private function getReverseMap($defaultContextAccess)
    {
        if (!empty($this->reverseMap)) {
            return $this->reverseMap;
        }

        $map = $this->map;
        foreach ($map as &$value) {
            // $value can be true in the case of the use of a Compound matcher
            if ($value === true) {
                $value = $defaultContextAccess;
            }
        }

        return $this->reverseMap = array_flip($map);
    }
}
