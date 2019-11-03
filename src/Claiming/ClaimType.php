<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\Claiming;

use Eki\NRW\Mdl\Model\HasDefinitionTrait;

/**
* @author Nguyen Tien Hy <ngtienhy@gmail.com>
*/
class ClaimType implements ClaimTypeInterface
{
	use
		HasDefinitionTrait
	;
	
	/**
	* @var string
	*/
	protected $type;
	
	public function __construct($type)
	{
		$this->type = $type;
	}
	
	/**
	* Returns claim type
	* 
	* @return string
	*/
	public function getType()
	{
		return $this->type;
	}
	
	/**
	* @inheritdoc
	* 
	*/
	public function fullfill(ClaimInterface $claim)
	{
		$processedTerms = $this->getDefinition()->processMeaning();
		
		foreach($processedTerms['claim']['attributes'] as $attrName => $attrValue)
		{
			$claim->setAttribute($attrName, $attrValue);
		}
		
		foreach($processedTerms['properties'] as $propName => $propValue)
		{
			$claim->setProperty($propName, $propValue);
		}
	}
}
