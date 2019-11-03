<?php
/**
 * This file is part of the Eki-NRW package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\NRW\Mdl\Processing\Pipeline;

class FrameToFrameProcessor extends InjectableProcessor
{
    /**
     * FrameToFrameProcessor constructor.
     *
     */
    public function __construct(Closure $materialGetter, Closure, $materialSetter, $nextSubject)
    {
    	$injector = function ($payload) use ($materialGetter, $nextSubject) {
    		if ($payload['stage_name'] === FromFrameStage::NAME)
    		{
				return $payload;
			}
    		else if ($payload['stage_name'] === ToFrameStage::NAME)
    		{
				$inputToPipeline = $payload['inputToPipeline'];
				$material = $materialGetter($inputToPipeline->getSubject());
				$nextSubject = $materialSetter($material, $nextSubject);
				$inputToPipeline->setSubject($nextSubject);
				$payload['inputToPipeline'] = $inputToPipeline;
				
				return $payload;
			}
		};
		
		parent::__construct($injector);
    }
}
