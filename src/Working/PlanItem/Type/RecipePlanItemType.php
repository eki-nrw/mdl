<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\Working\PlanItem\Type;

use Eki\NRW\Mdl\Working\PlanItemTypeInterface;

/**
* @author Nguyen Tien Hy <ngtienhy@gmail.com>
*/
class RecipePlanItemType extends PlanItemType
{
	/**
	* @inheritdoc
	*/
	public function getPlanItemType()
	{
		return "planitem.recipe";
	}
	
	/**
	* @inheritdoc
	*/
	public function is($thing)
	{
		if ($thing === 'recipe')
			return true;
			
		return parent::is($thing);
	}

	/**
	* @inheritdoc
	*/
	public function accept($thing, $content)
	{
		return parent::accept($thing, $content);
	}
}
