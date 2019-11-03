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
use Eki\NRW\Mdl\Contexture\ContextAccess\Request;

abstract class Regex implements MatcherInterface
{
    /**
     * Element that will be matched against the regex.
     *
     * @var string
     */
    protected $element;

    /**
     * Regular expression used for matching.
     *
     * @var string
     */
    protected $regex;

    /**
     * Item number to pick in regex.
     *
     * @var string
     */
    protected $itemNumber;

    /**
     * @var \Eki\NRW\Mdl\Contexture\ContextAccess\Request
     */
    protected $request;

    /**
     * @var string
     */
    protected $matchedContextAccess;

    /**
     * Constructor.
     *
     * @param string $regex Regular Expression to use.
     * @param int $itemNumber Item number to pick in regex.
     */
    public function __construct($regex, $itemNumber)
    {
        $this->regex = $regex;
        $this->itemNumber = $itemNumber;
    }

    public function __sleep()
    {
        return array('regex', 'itemNumber', 'matchedContextAccess');
    }

    public function match()
    {
        return $this->getMatchedContextAccess();
    }

    /**
     * Returns matched ContextAccess.
     *
     * @return string|bool
     */
    protected function getMatchedContextAccess()
    {
        if (isset($this->matchedContextAccess)) {
            return $this->matchedContextAccess;
        }

        preg_match(
            "@{$this->regex}@",
            $this->element,
            $match
        );

        $this->matchedContextAccess = isset($match[$this->itemNumber]) ? $match[$this->itemNumber] : false;

        return $this->matchedContextAccess;
    }

    /**
     * Injects the request object to match against.
     *
     * @param \Eki\NRW\Mdl\Contexture\ContextAccess\Request $request
     */
    public function setRequest(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Injects element to match against with the regexp.
     *
     * @param string $element
     */
    public function setMatchElement($element)
    {
        $this->element = $element;
    }
}
