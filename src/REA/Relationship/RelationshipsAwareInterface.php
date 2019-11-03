<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\REA\Relationship;

/**
* @author Nguyen Tien Hy <ngtienhy@gmail.com>
*/
interface RelationshipsAwareInterface
{
	public function addRelationship(Relationship $relationship, $key = null);
	public function removeRelationship(Relationship $relationship, $key = null);
	public function getRelationship($key);
	public function getRelationships();
	public function setRelationships(array $relationships = []);
}
