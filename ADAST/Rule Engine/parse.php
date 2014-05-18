<?php

    ## Capture Publish and Subscribe Keys from Command Line
    $publish_key   = isset($argv[1]) ? $argv[1] : false;
    $subscribe_key = isset($argv[2]) ? $argv[2] : false;
    $channel_name  = isset($argv[3]) ? $argv[3] : 'hello_world2';

    # Print usage if missing info.
    if (!($publish_key && $subscribe_key)) {
echo("
    ==============
    EXAMPLE USAGE:
    ==============
    php ./subscribe-example.php PUBLISH-KEY SUBSCRIBE-KEY

");
        exit();
    }

    ## Require Pubnub API
    echo("Loading Pubnub.php Class\n");
    require('Pubnub.php');
    
    ## Require Inference function
    echo("Loading Inference.php\n");
    require('Inference.php');

    ## -----------------------------------------
    ## Create Pubnub Client API (INITIALIZATION)
    ## -----------------------------------------
    echo("Creating new Pubnub Client API\n");
    $pubnub = new Pubnub( $publish_key, $subscribe_key );
    
    ## ------------------------------
    ## Listen for Message (SUBSCRIBE)
    ## 
    ## After receiving message, fork a child to create file and execute C program.
    ## Parent keeps listening to channel.
    ## ------------------------------
    echo("Listening for Messages (Press ^C to stop)\n");
    $pubnub->subscribe(array(
        'channel'  => $channel_name,        ## REQUIRED Channel to Listen
        'callback' => create_function(
            '$message',
            '$pid = pcntl_fork(); 
            if($pid == -1) { die("Could not fork."); } 
            else if ($pid) {echo($pid.":".$message."\n");}
            else { $cap = simplexml_load_string($message);
            #print_r($cap);
            if ( strcasecmp ( $cap->info[0]->event, "Earthquake" ) == 0 ) { # event is earthquake
            	print("Earthquake coming!\n");
            	inference($message);
            }
            else { print("Not earthquake\n"); }
            return false;}
            return true;'
        )
    ));
?>

