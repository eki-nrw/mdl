<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\Exchanging\ExchangeItem;

use Eki\NRW\Mdl\Exchanging\Exchange\HasExchangeTrait;
use Eki\NRW\Mdl\Exchanging\ExchangeItem\Type\HasExchangeItemTypeTrait;
use Eki\NRW\Common\Compose\ObjectItem\ObjectItemInterface;
use Eki\NRW\Common\Timing\TimingTrait;
use Eki\NRW\Common\Common\HasPropertiesTrait;
use Eki\NRW\Common\Common\DocumentationTrait;

/**
* @author Nguyen Tien Hy <ngtienhy@gmail.com>
*/
abstract class AbstractExchangeItem implements ExchangeItemInterface
{
	use
		HasExchangeItemTypeTrait,
		HasExchangeTrait,
		TimingTrait,
		HasPropertiesTrait,
		DocumentationTrait
	;
	
	/**
	* @var int
	*/
	protected $priority = ExchangeItemInterface::EXCHANGE_PRIORITY_DEFAULT;

	/**
	* @var string[]
	*/
	protected $roles = [];
	
	/**
	* @var ObjectItemInterface
	*/
	protected $item;
	
	/**
	* @var array
	*/
	protected $specifications = [];
	
	/**
	* Constructor
	* 
	* @param ExchangeItemTypeInterface $exchangeItemType
	* 
	* @throws
	*/
	public function __construct(ExchangeItemTypeInterface $exchangeItemType = null)
	{
		$this->setExchangeItemType($exchangeItemType);
	}

	/**
	* @inheritdoc
	*/
	protected function matchExchangeItemType(ExchangeItemTypeInterface $exchangeItemType)
	{
		//...
	}
	
	/**
	* @inheritdoc
	*/
	public function getPriority()
	{
		return $this->priority;
	}
	
	/**
	* @inheritdoc
	*/
	public function setPriority($priority)
	{
		$this->priority = $priority;
		
		return $this;
	}
	
	/**
	* @inheritdoc
	*/
	public function getItem()
	{
		return $this->item;
	}
	
	/**
	* @inheritdoc
	*/
	public function setItem(ObjectItemInterface $item)
	{
		$this->item = $item;
		
		return $this;
	}
	
	/**
	* @inheritdoc
	*/
	public function getSpecifications()
	{
		return $this->specifications;		
	}
	
	/**
	* @inheritdoc
	*/
	public function setSpecifications(array $specifications)
	{
		$this->specifications = $specifications;
		
		return $this;
	}

	/**
	* @inheritdoc
	*/
	public function getPlayerRoles()
	{
		return $this->roles;	
	}
	
	/**
	* @inheritdoc
	*/
	public function setPlayerRoles(array $roles)
	{
		foreach($roles as $role)
		{
			if (!is_string($role))
				throw new \InvalidArgumentException(sprintf("Role must be string. Given %s.", gettype($role)));	
		}
		
		$this->roles = $roles;
	}

}
