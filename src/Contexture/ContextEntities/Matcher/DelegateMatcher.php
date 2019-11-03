<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\Contexture\ContextEntities\Matcher;

/**
* @author Nguyen Tien Hy <ngtienhy@gmail.com>
*/
class DelegateMatcher implements MatcherInterface
{
	/**
	* @var MatcherInterface[]
	*/
	private $matchers;
	
	public function __construct(array $matchers = [])
	{
		foreach($matchers as $matcher)
		{
			if (!$matcher instanceof MatcherInterface)
				throw new \InvalidArgumentException(sprintf(
					"Matcher must be an instance of '%s'.",
					MatcherInterface::class
				));
		}
		
		$this->matchers = $matchers;
	}
	
	/**
	* @inheritdoc
	* 
	*/
	public function match($obj, $arguments = null)
	{
		foreach($this->matchers as $matcher)
		{
			if ($matcher->match($obj, $arguments) === true)
				return true;			
		}
		
		return false;
	}
}
