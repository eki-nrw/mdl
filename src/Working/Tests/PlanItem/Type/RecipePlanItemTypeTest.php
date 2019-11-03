<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\Working\Tests\PlanItem\Type;

use Eki\NRW\Mdl\Working\PlanItem\Type\RecipePlanItemType;

use PHPUnit\Framework\TestCase;

class RecipePlanItemTypeTest extends TestCase
{
	public function testNewInstance()
	{
		$planItemType = new RecipePlanItemType();
		
		$this->assertSame('planitem.recipe', $planItemType->getPlanItemType());
		$this->assertTrue($planItemType->is('recipe'));
		$this->assertFalse($planItemType->is('recipesakjdkasjd'));
	}	
}
