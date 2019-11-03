<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\Modeling;

/*** @author Nguyen Tien Hy <ngtienhy@gmail.com>
*/
interface DefinitionInterface
{
	/**
	* The unique name of the definition
	* 
	* @return string
	*/
	public function getName();
	
	/**
	* Returns the meaning of the definition (word, sentence, array, set of symbols, ...)
	* 
	* @return mixed
	*/
	public function getMeaning();

	/**
	* Return the view that represents the definition (diagram, dump result,...)
	* 
	* @param string|null $format
	* 
	* @return mixed
	*/
	public function getView($format = null);

	/**
	* Process a configuration array
	* 
	* @param array $configs Terms for an object that defined by the definition
	* 
	* @return array
	*/
	public function processMeaning(array $terms = []);
}
