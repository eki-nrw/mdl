<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\REA\Relationship;

use Eki\NRW\Common\Relations\TypeMeaningHelper as BaseTypeMeaningHelper;

/**
* TypeMeaning Helper for REA relationships
* 
* @author Nguyen Tien Hy <ngtienhy@gmail.com>
*/
class TypeMeaningHelper extends BaseTypeMeaningHelper
{
	const DEF_DOMAIN = Constants::REA_DOMAIN;
	
	public function setReaType($reaType)
	{
		$this->setRestType($reaType, TypeMeaningInterface::INDEX_CATEGORIZATION_TYPE);
		
		return $this;		
	}

	public function getReaType()
	{
		$this->getRestType(TypeMeaningInterface::INDEX_CATEGORIZATION_TYPE);
	}
}
