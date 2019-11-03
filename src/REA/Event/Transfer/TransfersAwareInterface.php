<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\REA\Exchange\Event\Transfer;

/**
* @author Nguyen Tien Hy <ngtienhy@gmail.com>
*/
interface TransfersAwareInterface
{
	public function getTransfers();
	
	public function setTransfers(array $transfers = []);
	
	public function addTransfer(TransferInterface $transfer, $key);
	
	public function removeTransfer(TransferInterface $transfer);

	public function removeTransferByKey($key);

	public function hasTransfer($key);

	public function getTransfer($key);
}
