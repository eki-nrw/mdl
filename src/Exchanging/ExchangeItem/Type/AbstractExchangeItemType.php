<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\Exchanging\ExchangeItem\Type;

use Eki\NRW\Common\Common\TypeCheckingInterface;

/**
* @author Nguyen Tien Hy <ngtienhy@gmail.com>
*/
abstract class AbstractExchangeItemType implements ExchangeItemTypeInterface
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
		if ($thing === 'role_player')
		{
			if (is_string($content))
				if (in_array($content, $this->getAvailablePlayerRoles(), true))
					return true;
		}
		
		return false;
	}
}

