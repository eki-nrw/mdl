<?php

use Eki\NRW\Mdl\Claiming\Repository\Simple\Repository;

use Eki\NRW\Common\Participating\Partner;
use Eki\NRW\Common\Participating\Participant;

use Eki\NRW\Mdl\Claiming\Repository\General\InMemory\Repository;

$claimType = "thu_tien";
$claimTypeForSet = "claim_set";

$reposition = new Repository();

$claimTypeService = $repository->getClaimTypeService();
$claimService = $repository->getClaimService();
$findService = $repository->getFindService();

// System prepares,...


//=== On the desk A,
$partnerA = new Partner('cashier', "Cashier A", "Tran Thi Chan Dai");
$cashierA = new Participant(
	'receiver', 
	'cashier A', 
	$partnerA
);
$reporterA = new Pariticipant(
	'deliverer',
	'cashier A',
	$partnerA
);

$claimSetA = $claimService->createClaim($claimTypeForSet);
$claimSetA->addParticipant($reporterA);
$claimService->registerClaim($claimSetA);

// Payer 1 pays money`
$payer1 = new Participant(
	'deliverer', 
	'Payer 1', 
	new Partner('payer', "Payer 1", "Nguyen Thi Be Bu")
);
$claim1 = $claimService->createClaim($claimType);
$claim1->getClaimable()->getDeliverable()->setDelivery(
	new Delivery(100)   // Payer 1, Nguyen Thi Be Bu, pays 100 
);
$claimService->register($claim1);   // the claim is registered

$claimService->do('payment', $claim1, $payer1);		// payment
$claimService->do('collect', $claim1, $cashierA);	// collect money
$claimService->do('invoice', $claim1, $cashierA);  	// print invoice
$claimService->do('invoice', $claim1, $payer1);  	// receive invoice
$claimService->do('finish', $claim1, $cashierA);  	// Finish claim

$claimService->do('add', $claimSetA, $cashierA, array('claim'=>$claim1));  	// write claim to claim set

// Payer 2 pays money
$payer2 = new Participant(
	'deliverer', 
	'Payer 2', h
	new Partner('payer', "Payer 2", "Ly Van Phuc")
);
$claim2 = $claimService->createClaim($claimType);
$claim2->getClaimable()->getDeliverable()->setDelivery(
	new Delivery(200)   // Payer 2, Ly Van Phuc, pays 200
);
$claimService->register($claim2);   // the claim is registered

$claimService->do('payment', $claim2, $payer2);   	// payment
$claimService->do('collect', $claim2, $cashierA);		// collect money
$claimService->do('invoice', $claim2, $cashierA);  // print invoice
$claimService->do('invoice', $claim2, $payer1);  // receive invoice
$claimService->do('finish', $claim2, $cashierA);  // Finish claim

$claimService->do('add', $claimSetA, $cashierA, array('claim'=>$claim2));  	// write claim to claim set

// Reporter A reports in the end of the day
$claimService->do('close', $claimSetA, $cashierA));

//=== On the desk B,
$partnerB = new Partner('cashier', "Cashier B", "Cong Tang Ton Nu Ta Thi Ao Dai");
$cashierB = new Participant(
	'receiver', 
	'cashier B', 
	$partnerB
);
$reporterB = new Pariticipant(
	'deliverer',
	'cashier B',
	$partnerB
);

$claimSetB = $claimService->createClaim($claimTypeForSet);
$claimSetB->addParticipant($reporterB);
$claimService->registerClaim($claimSetB);

// Payer 3 pays money`
$payer3 = new Participant(
	'deliverer', 
	'Payer 3', 
	new Partner('payer', "Payer 3", "Henry")
);
$claim3 = $claimService->createClaim($claimType);
$claim3->getClaimable()->getDeliverable()->setDelivery(
	new Delivery(300)   // Payer 3, Henry, pays 300
);
$claimService->register($claim3);   // the claim is registered

$claimService->do('payment', $claim3, $payer3);		// payment
$claimService->do('collect', $claim3, $cashierB);		// collect money
$claimService->do('invoice', $claim3, $cashierB);  // print invoice
$claimService->do('invoice', $claim3, $payer3);  // receive invoice
$claimService->do('finish', $claim3, $cashierB);  // Finish claim

$claimService->do('add', $claimSetB, $cashierB, array('claim'=>$claim3));  	// write claim to claim set

// Payer 4 pays money
$payer4 = new Participant(
	'deliverer', 
	'Payer 4', 
	new Partner('payer', "Payer 4", "Ekaterina")
);
$claim4 = $claimService->createClaim($claimType);
$claim4->getClaimable()->getDeliverable()->setDelivery(
	new Delivery(400)   // Payer 4, Ekaterina, pays 400
);
$claimService->register($claim4);   // the claim is registered

$claimService->do('payment', $claim4, $payer4);		// payment
$claimService->do('collect', $claim4, $cashierB);		// collect money
$claimService->do('invoice', $claim4, $cashierB);  // print invoice
$claimService->do('invoice', $claim4, $payer4);  // receive invoice
$claimService->do('finish', $claim4, $cashierB);  // Finish claim

$claimService->do('add', $claimSetB, $cashierB, array('claim'=>$claim4));  	// write claim to claim set

// Reporter B reports in the end of the week
$claimService->do('close', $claimSetB, $cashierB));

//=== At publisher
$publisher = new Participant(
	'publisher', 
	'Publisher', 
	new Partner('publisher', "Publisher", "Company ABC")
);

$doneClaims = $findService->findClaims(
	array(
		'state' => 'finished'
	), 
	$publisher
);
$total = 0;
foreach($doneClaims as $cl)
{
	$total += $cl->getClaimable()->getDeliverable()->getDelivery()->getValue();
}

if ($total !== 1000)
	throw new \Exception("Lost money");

$doneClaimSets = $findService->findClaims(
	array(
		'is_set' => true,
		'state' => 'finished', 
	)
	$publisher
);
$setTotal = 0;
foreach($doneClaimSets as $cls)
{
	$setTotal += $cls->getSummary();
}

if ($setTotal !== 1000)
	throw new \Exception("Lost money");

?>