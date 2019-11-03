<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\Working\Tests\Plan\Type;

use Eki\NRW\Mdl\Working\Plan\Type\RecipePlanType;

use PHPUnit\Framework\TestCase;

class RecipePlanTypeTest extends TestCase
{
	public function testNewInstance()
	{
		$planType = new RecipePlanType();
		
		$this->assertSame('plan.recipe', $planType->getPlanType());
		$this->assertTrue($planType->is('recipe'));
		$this->assertFalse($planType->is('recipesakjdkasjd'));
	}	
}
