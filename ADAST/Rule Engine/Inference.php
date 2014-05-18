<?php
    require_once('phprules/phprules.php');
    require_once('fact.php');

    


    	//$cap = simplexml_load_string($xml);
    	$wm = new WorkingMemory();
        //$wm->insert( new Parameter("valueName", 5 ));
    		
    	// foreach ( $cap->info as $capinfo ) { # each cap message may have multiple <info>
    	// 	foreach ( $capinfo->parameter as $param ) {
    	// 		$wm->insert( new Parameter($param->valueName, $param->value ));
    	// 	}
    	// }

        print("Start ");

        $mag        = 'Magnitude';
        $scale      = 10;
        
        $RecvCountry    = 'Taiwan';
        $RecvTown       = 'Hualien';
        $RecvVill       = 'Vill';
        $RecvDebriesNo  = 'DF025';
        $RecvAlertValue = 11;
        $RecvAlertType  = 'Y';
        $RecvTimeStamp  = '2012/08/22 17:00:00';

        //print_r(new Parameter($mag,$scale,$RecvCountry, $RecvTown, $RecvVill, $RecvDebriesNo, $RecvAlertValue, $RecvAlertType, $RecvTimeStamp));
        //$wm->insert( new Parameter('Magnitude',7) );
    	$wm->insert( new Parameter($mag,$scale,$RecvCountry, $RecvTown, $RecvVill, $RecvDebriesNo, $RecvAlertValue, $RecvAlertType, $RecvTimeStamp));
        //print_r ($wm);
        //$wm->insert( new DebriesAlert($Country, $Town, $Vill, $DebriesNo, $AlertValue, $AlertType, $TimeStamp));

        //$wm->insertActionFassade('LED', new LED());
        //$wm->insertActionFassade('LED2', new LED2());
	    $wm->insertActionFassade('ResponseComponent', new ResponseComponent());
	
    	$rr = new RuleReader();
    	$rs = new RuleSession($rr->parseFile("rule.srl"),$wm);
    	$rs->maxFiringPerRule = 1;
    	$rs->verbosity = 1;
    	$rs->fireAll();
    
?>
