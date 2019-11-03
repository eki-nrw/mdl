<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\Contexture\ContextEntities\Context\SupportStrategy;

use Eki\NRW\Mdl\Contexture\ContextEntities\Context\ContextInterface;

/**
 * @author Nguyen Tien Hy <ngtienhy@gmail.com>
 */
class InstanceOfSupportStrategy implements SupportStrategyInterface
{
	private $classname;
	
	public function __construct(string $className)
	{
		if (!class_exists($className))
			throw new \InvalidArgumentException("No class $className exists.");
			
        $this->className = $className;
    }	

	/**
	* @inheritdoc
	* 
	*/
    public function supports(ContextInterface $context, $boundary)
    {
		return $boundary instanceof $this->className;		
	}
	
	public function getClassName()
    {
        return $this->className;
    }	
}
