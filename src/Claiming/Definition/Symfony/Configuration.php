<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\Claiming\Definition\Symfony;

use Eki\NRW\Mdl\Model\Definition\Symfony\Configuration as BaseConfiguration;
use Eki\NRW\Mdl\Claiming\Claim;
use Eki\NRW\Mdl\Claiming\ClaimType;
use Eki\NRW\Mdl\Claiming\Claimable\Subjectable;
use Eki\NRW\Mdl\Claiming\Claimable\Originable;
use Eki\NRW\Mdl\Claiming\Claimable\Delivery;
use Eki\NRW\Mdl\Claiming\Set\ClaimSet;

use Eki\NRW\Common\Participating\Participant;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\Builder\NodeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;
//use Symfony\Component\Config\Definition\ArrayNode;

/**
* @author Nguyen Tien Hy <ngtienhy@gmail.com>
*/
class Configuration extends BaseConfiguration
{
	public function __construct()
	{
		$sections = array(
		
			// Base
			function() {
				$nodeBuilder = new NodeBuilder();
				$node = $nodeBuilder->getRootNode()
					->scalarNode('name')->isRequired()->cannotBeEmpty()->end()
					->arrayNode('type')
						->children()
							->scalarNode('class')->defaultValue(ClaimType::class)->end()
						->end()
				;
				
				return $node;
			},
						
			// Participants
			function() {
				$treeBuilder = new TreeBuilder('participants');
				$node = $treeBuilder->getRootNode()
					->isRequired()
					->children()
						->isRequired()
						->useAttributeAsKey('name')
						->arrayPrototype()
							->children()
								->scalarNode('name')
									->info("Description of the participant. Not the key name.")
									->end()
								->scalarNode('class')->defaultValue(Participant::class)->end()
							->end()
						->end()
					->end()
				;
				
				return $node;
			},
			
			// Claim
			function() {
				$treeBuilder = new TreeBuilder('claim');
				$node = $treeBuilder->getRootNode()
					->isRequired()
					->children()
						->scalarNode('class')->defaultValue(Claim::class)->end()
						->arrayNode('attributes')
							->cannotBeEmpty()
							->children()
								->useAttributeAsKey('name')
								->prototype('array')
									->children()
										->enumNode('type')
											->isRequired()
											->cannotBeEmpty()
											->values('string', 'boolean', 'int', 'float', 'array')
											->defaultValue('string')
										->end()
									->end()
								->end()
							->end()
						->end()
						->arrayNode('properties')
							->children()
								->useAttributeAsKey('name')
								->arrayPrototype()
									->children()
										->enumNode('type')
											->isRequired()
											->cannotBeEmpty()
											->values('string', 'boolean', 'int', 'float', 'array', 'object')
											->defaultValue('string')
										->end()
										->scalarNode('implementation')->end()
									->end()
	                                ->validate()
	                                    ->ifTrue(function ($v) {
	                                        return $v['type'] !== 'object' && isset($v['implementation']);
	                                    })
	                                    ->thenInvalid('type is not "object" cannot used together "implementation".')
	                                ->end()
	                                ->validate()
	                                    ->ifTrue(function ($v) {
	                                        return $v['type'] === 'object' && !isset($v['implementation']);
	                                    })
	                                    ->thenInvalid('type "object" must be used together "implementation".')
	                                ->end()
								->end()
							->end()
						->end()
					->end()
				;
				
				return $node;
			},
			
			// Operations
			function() {
				$treeBuilder = new TreeBuilder('claimable');
				$node
					->arrayNode('actions')
						->cannotBeEmpty()
						->children()
							->useAttributeAsKey('name')
							->prototype('array')
								->children()
									->arrayNode('from')
                                        ->beforeNormalization()
                                            ->ifString()
                                            ->then(function ($v) { return array($v); })
                                        ->end()
                                        ->requiresAtLeastOneElement()
                                        ->prototype('scalar')
                                            ->cannotBeEmpty()
                                        ->end()
                                    ->end()
									->scalarNode('to')->end
									->arrayNode('participants')
                                        ->beforeNormalization()
                                            ->ifString()
                                            ->then(function ($v) { return array($v); })
                                        ->end()
				                        ->isRequired()
				                        ->requiresAtLeastOneElement()
										->prototype('scalar')
											->cannotBeEmpty()
										->end()
								->end()
							->end()
						->end()
						
					->arrayNode('states')
                        ->isRequired()
                        ->requiresAtLeastOneElement()
						->prototype('scalar')
							->cannotBeEmpty()
						->end()
				;
				
				return $node;
			},
			
			// Claimable
			function() {
				$treeBuilder = new TreeBuilder('claimable');
				$node
					->isRequired()
					->children()
						->addDefaultsIfNotSet()
						->arrayNode('subjectable')
							->children()
								->scalarNode('class')->defaultValue(Subjectable::class)->end()
							->end()
						->end()
						->arrayNode('originable')
							->children()
								->scalarNode('class')->defaultValue(Originable::class)->end()
							->end()
						->end()
						->arrayNode('deliverable')
							->children()
								->scalarNode('class')->defaultValue(Deliverable::class)->end()
							->end()
						->end()
					->end()
				;
				
				return $node;
			},
			
			// Set
			function() {
				$treeBuilder = new TreeBuilder('set');
				$node
					->children()
						->scalarNode('class')->defaultValue(ClaimSet::class)->end()
						->intergerNode('max')->defaultValue(-1)->end()
					->end()
				;
				
				return $node;
			},
			
			// Extensions
			function() {
				$treeBuilder = new TreeBuilder('extensions');
				$node = $treeBuilder->getRootNode()
					->children()
						->isRequired()
						->useAttributeAsKey('name')
						->arrayPrototype()
							->children()
								->arrayNode('attributes')
									->cannotBeEmpty()
									->children()
										->useAttributeAsKey('name')
										->prototype('array')
											->children()
												->enumNode('type')
													->isRequired()
													->cannotBeEmpty()
													->values('string', 'boolean', 'int', 'float', 'array')
													->defaultValue('string')
												->end()
											->end()
										->end()
									->end()
								->end()
								->arrayNode('properties')
									->children()
										->useAttributeAsKey('name')
										->arrayPrototype()
											->children()
												->enumNode('type')
													->isRequired()
													->cannotBeEmpty()
													->values('string', 'boolean', 'int', 'float', 'array')
													->defaultValue('string')
												->end()
											->end()
										->end()
									->end()
								->end()
							->end()
						->end()
					->end()
				;
				
				return $node;
			},
		);
		
		parent::__construct('claiming', $sections);
	}
}
