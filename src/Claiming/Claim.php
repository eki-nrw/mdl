<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\Claiming;

use Eki\NRW\Common\Common\HasAttributesTrait;
use Eki\NRW\Common\Common\HasPropertiesTrait;
use Eki\NRW\Common\Participating\ParticipantsAwareTrait;

/**
* @author Nguyen Tien Hy <ngtienhy@gmail.com>
*/
class Claim implements ClaimInterface
{
	use
		HasAttributesTrait,
		HasPropertiesTrait,
		ParticipantsAwareTrait
	;

	/**
	* @var string
	*/	
	private $code;
	
	/**
	* @var ClaimTypeInterface
	*/
	private $claimType;
	
	/**
	* @var ClaimableInterface
	*/
	private $claimable;

	public function getCode()
	{
		return $this->code;
	}
	
	public function setCode($code)
	{
		$this->code = $code;
	}
	
	public function getClaimType()
	{
		return $this->claimType;
	}
	
	public function setClaimType(ClaimTypeInterface $claimType = null)
	{
		$this->claimType = $claimType;
		
		if ($claimType !== null)
		{
			$claimType->fullfillClaim($this);
		}
	}
	
	public function getClaimable()
	{
		return $this->claimable;
	}
	
	public function setClaimable(ClaimableInterface $claimable = null)
	{
		$this->claimable = $claimable;
	}
}
