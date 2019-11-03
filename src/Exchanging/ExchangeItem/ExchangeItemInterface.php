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

use Eki\NRW\Mdl\Exchanging\Exchange\HasExchangeTypeInterface;
use Eki\NRW\Mdl\Exchanging\ExchangeItem\Type\HasExchangeItemTypeInterface;
use Eki\NRW\Common\Compose\ObjectItem\ObjectItemInterface;
use Eki\NRW\Common\Timing\TimingInterface;
use Eki\NRW\Common\Common\HasPropertiesInterface;
use Eki\NRW\Common\Common\DocumentationInterface;

/**
* @author Nguyen Tien Hy <ngtienhy@gmail.com>
*/
interface ExchangeItemInterface extends 
	HasExchangeItemTypeInterface,
	HasExchangeInterface,
	TimingInterface,
	HasPropertiesInterface,
	DocumentationInterface
{
	/**
	* Sets priority
	* 
	* Priority is negative/positive integer.
	* Exchange Item is processed from lower priority to higher one.
	* Exchange items of the same priority will be able to process paralelly.
	* 
	* @param int $priority
	* 
	* @return this
	*/
	public function setPriority($priority);

	/**
	* Returns priority
	* 
	* @return int
	*/
	public function getPriority();
	
	/**
	* Returns exchange item
	* 
	* @return ObjectItemInterface
	*/
	public function getItem();
	
	/**
	* Sets object item
	* 
	* @param ObjectItemInterface $objectItem
	* 
	* @return this
	*/
	public function setItem(ObjectItemInterface $item);

	/**
	* Returns specifications
	* 
	* @return array
	*/
	public function getSpecifications();
	
	/**
	* Sets sepecifications of exchange item
	* 
	* @param array $specifications
	* 
	* @return this
	*/
	public function setSpecifications(array $specifications);
	
	/**
	* Get all roles of players
	* 
	* @return string[]
	*/
	public function getPlayerRoles();
	
	/**
	* Sets all player roles 
	* 
	* @param string[] $roles
	* 
	* @return void
	*/
	public function setPlayerRoles(array $roles);
}
