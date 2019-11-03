<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\Claiming\Repository\General;

use Eki\NRW\Mdl\Claiming\ClaimInterface;
use Eki\NRW\Common\Particpating\ParticipantInterface;

/**
* @author Nguyen Tien Hy <ngtienhy@gmail.com>
*/
interface DispatcherInterface
{
	const DISPATCH_CLAIM_TYPE_REGISTER = "claim_type_register";
	const DISPATCH_CLAIM_REGISTER = "claim_register";
	const DISPATCH_CLAIM_DO = "claim_operates";
	
	/**
	* Dispatch event
	* 
	* @param string $eventName
	* @param string $operation
	* @param ClaimInterface $claim
	* @param ParticipantInterface $participant
	* @param array $options
	* 
	* @return void
	*/
	public function dispatch(
		$eventName,
		$operation,
		ClaimInterface $claim = null,
		ParticipantInterface $participant = null,
		array $options = []		
	);
}
