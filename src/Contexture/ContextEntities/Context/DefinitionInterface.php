<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\Contexture\ContextEntities\Context;

use Eki\NRW\Mdl\Contexture\ContextEntities\Definition\DefinitionInterface as BaseDefinitionInterface;

/**
* @author Nguyen Tien Hy <ngtienhy@gmail.com>s
*/
interface DefinitionInterface extends BaseDefinitionInterface
{
	/**
	* Determines accepted boundary
	* 
	* @param mixed $boundary
	* 
	* @return this
	*/
	public function setBoundary($boundary);

	/**
	* Return boundary
	* 
	* @return string
	*/
	public function getBoundary();
		
	/**
	* Determines scopes and levels of the scopes
	* 
	* @param array $scopes
	* 
	* Ex.:
	* $scopes = array(
	* 	'<scope_name>' => array(
	* 		'level_name' => '<level_value>',
	* 		'level_name> => '<level_value>'
	*   ),
	* 	'<scope_name>' => '<scope_value'
	* );
	* 
	* @return this
	*/
	public function setScopes($scopes);
	
	/**
	* Returns all scopes
	* 
	* @return array
	*/
	public function getScopes();
	
	/**
	* Determines the context is applied in the given situations (use cases)
	* 
	* @param array|null $uses
	* 
	* @return this
	*/
	public function setUses($uses);
	
	/**
	* Return all uses
	* 
	* @return array
	*/
	public function getUses();
	
	/**
	* Determines the flows of the context
	* 
	* @param array|\Eki\NRW\Mdl\Contexture\ContextEntities\Flow\DefinitionInterface[] $flows
	* 
	* @return this
	*/
	public function setFlows($flows);
	
	/**
	* Returns all flow definitions
	* 
	* @return array
	*/
	public function getFlows();
	
	/**
	* Return the definition of the given flow
	* 
	* @param string $flowName
	* 
	* @return \Eki\NRW\Mdl\Contexture\ContextEntities\Flow\DefinitionInterface
	*/
	public function getFlow($flowName);
}
