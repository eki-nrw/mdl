<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\Modeling\Definition\Symfony;

use Eki\NRW\Mdl\Modeling\DefinitionInterface;

use Symfony\Component\Config\Definition\ConfigurationInterface;

use Closure;

/*** @author Nguyen Tien Hy <ngtienhy@gmail.com>
*/
class Configuration implements ConfigurationInterface
{
	private $rootName;
	
	/**
	* @var \Closure
	*/
	private $sections;
	
	public function __construct($rootName, array $sections = [])
	{
		$this->rootName = $rootName;
		
		foreach($sections as $section)
		{
			if (!$section instanceof Closure)
				throw new \InvalidArgumentException("???");
		}
		
		$this->sections = $sections;
	}
	
	public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder($this->rootName);
		$rootNode = $this->getRootNode($treeBuilder);
		
		foreach($this->sections as $section)
		{
			$node = $this->$section();
			$rootNode->append($node);
		}
		
        return $treeBuilder;
    }
}
