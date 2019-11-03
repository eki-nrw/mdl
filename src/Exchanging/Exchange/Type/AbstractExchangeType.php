<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\Exchanging\Exchange\Type;

/**
* @author Nguyen Tien Hy <ngtienhy@gmail.com>
*/
abstract class AbstractExchangeType implements ExchangeTypeInterface
{
	/**
	* @inheritdoc
	*/
	public function is($thing)
	{
		return false;
	}

	/**
	* @inheritdoc
	*/
	public function accept($thing, $content)
	{
		return false;
	}
}
