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
use Symfony\Component\Config\Definition\Processor;
use Symfony\Component\Config\Definition\Dumper\XmlReferenceDumper;
use Symfony\Component\Config\Definition\Dumper\YamlReferenceDumper;

/*** @author Nguyen Tien Hy <ngtienhy@gmail.com>
*/
class Definition implements DefinitionInterface
{
	/**
	* @var string
	*/
	private $name;
	
	/**
	* @var ConfigurationInterface;
	*/
	private $configuration;
	
	/**
	* @var Processor
	*/
	private $processor;
	
	/**
	* Constructor
	* 
	* @param string $name
	* @param ConfigurationInterface $configuration
	* 
	*/
	public function __construct($name, ConfigurationInterface $configuration)
	{
		$this->name = $name;
		$this->configuration = $configuration;
	}

	/**
	* The unique name of the definition
	* 
	* @return string
	*/
	public function getName()
	{
		return $this->name;
	}

	/**
	* Returns the meaning of the definition (word, sentence, array, set of symbols, graph, ...). The meaning used to represent the definition.
	* 
	* @return mixed
	*/
	public function getMeaning()
	{
		return $this->configuration;
	}

	/**
	* @inheritdoc
	* 
	*/
	public function getView($format = null)
	{
		if ($format === null)
			$format = 'yaml';
			
		if ($format === 'yaml')
		{
			$dumper = new YamlReferenceDumper();
			return $dumper->dump($this->configuration);
		}
		else if ($format === 'xml')
		{
			$dumper = new XmlReferenceDumper();
			return $dumper->dump($this->configuration);
		}
		else
			throw new \RuntimeException("???");
	}
	
	/**
	* @inheritdoc
	* 
	*/
	public function processMeaning(array $tearms = [])
	{
		if ($this->processor === null)
			$this->processor = new Processor;
			
		return $this->processor->processConfiguration($terms);
	}
}
