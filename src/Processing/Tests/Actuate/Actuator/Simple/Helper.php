<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\Processing\Tests\Actuate\Actuator\Simple;

use stdClass;
use ReflectionClass;
use ReflectionProperty;

/**
* @author Nguyen Tien Hy <ngtienhy@gmail.com>
*/
final class Helper
{
	static public function materialGetterFunc()
	{
		return
			function ($subject) {
				return $subject->material;
			}
		;
	}

	static public function acceptInputSubjectFunc()
	{
		return
			function ($subject) {
				return $subject instanceof stdClass;
			}
		;
	}

	static public function resultGiverFunc()
	{
		return
			function ($result, $subject) {
				$subject->result = $result;
				return $subject;
			}
		;
	}

	static public function acceptOutputSubjectFunc()
	{
		return
			function ($subject) {
				return $subject instanceof stdClass;
			}
		;
	}

	static public function produceFunc()
	{
		return
			function (array $materials, array $contexts = []) {
				$total = 0;
				foreach($materials as $material)
				{
					$total += $material->number;
				}
				
				$product = new stdClass;
				$product->total = $total;
				
				return $product;
			}
		;
	}

	static public function acceptMaterialFunc()
	{
		return
			function ($material) {
				if (!$material instanceof stdClass)
					return false;
					
				$r = new ReflectionClass($material);
				try 
				{
					$p = $r->getProperty('number');
					if (!$p instanceof ReflectionProperty)
						return false;
						
					return true;
				}
				catch(\Exception $e)
				{
					return false;
				}
				
				return false;
			}
		;
	}
}
