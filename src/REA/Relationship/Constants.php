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
final class Constants
{
	const REA_DOMAIN = 'rea';

	const REA_RELATIONSHIP_CUSTODY = 'c';
	const REA_RELATIONSHIP_LINKAGE = 'l';
	const REA_RELATIONSHIP_DUALITY = 'd';
	const REA_RELATIONSHIP_PARTICIPATION = 'p';
	const REA_RELATIONSHIP_STOCKFLOW = 's';
	const REA_RELATIONSHIP_ASSOCIATION = 'a';
	
	const REA_RELATIONSHIP_MAIN_TYPE_DEFAULT = '';
	const REA_RELATIONSHIP_SUB_TYPE_DEFAULT = '';
}
