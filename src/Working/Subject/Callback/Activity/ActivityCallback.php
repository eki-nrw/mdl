<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\Working\Subject\Callback\Activity;

use Eki\NRW\Mdl\Working\Subject\AbstractCallback;
use Eki\NRW\Mdl\Working\ActivityInterface;

/**
* @author Nguyen Tien Hy <ngtienhy@gmail.com>
*/
class ActivityCallback extends AbstractCallback
{
	/**
	* @inheritdoc
	*/
	public function getCallbackType()
	{
		return 'activity';
	}
	
	/**
	* Get activity
	* 
	* @return ActivityInterface
	*/
	protected function getActivity()
	{
		return $this->getSubject();
	}
}
