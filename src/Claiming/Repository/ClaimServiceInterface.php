<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\Claiming\Repository;

use Eki\NRW\Mdl\Claiming\ClaimInterface;
use Eki\NRW\Mdl\Claiming\ClaimSetInterface;
use Eki\NRW\Common\Particpating\ParticipantInterface;

/**
* @author Nguyen Tien Hy <ngtienhy@gmail.com>
*/
interface ClaimServiceInterface
{
	/**
	* Create an empty claim of claim type
	* 
	* @param string $claimType
	* 
	* @return ClaimInterface
	* 
	* @throw
	*/
	public function createClaim($claimType);

	/**
	* Register a claim to system
	* 
	* @param ClaimInterface $claim
	* 
	* @return void
	* 
	* @throws
	*/	
	public function registerClaim(ClaimInterface $claim);
	
	/**
	* Do action to a claim on behalf of participant role
	* 
	* @param string $action
	* @param ClaimInterface $claim
	* @param ParticipantInterface|null $participant
	* @param array $options
	* 
	* @return void
	* @throws
	*/
	public function operate($action, ClaimInterface $claim, ParticipantInterface $participant, array $options = []);

	/**
	* Find claims by criteria on behalf of given participant
	*  
	* @param array $criteria
	* $criteria = array(
	* 	'is_set' => <true for claim set; false for claim>,
	* 	'id' => <state_id>,
	* 	'code' => <state_code>,
	* 	'state' => <claim_state>,
	* 	'participant' => array(
	* 		'role' => <participant_role>,
	* 		'name' => <paritipant_name>,
	* 		'partner' => array(
	* 			'index' => <partner_index>,
	* 			'name' => <partner_name>,
	* 			'actor' => <partner_actor>
	* 		),
	* 	),
	* 	'subject' => <subjectCode>
	* 	'origin' => <originCode>
	* 	'delivery' => <deliveryCode>
	* );
	* @param ParticipantInterface $participant
	* 
	* @return ClaimInterface[]
	*/
	public function findClaims(array $criteria, ParticipantInterface $participant);
}
