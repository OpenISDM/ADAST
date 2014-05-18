<?php
    require_once('phprules/phprules.php');

    
    class Parameter extends Fact
    {
        var $valueName;
        var $value;

        var $country;
        var $town;
        var $vill;
        var $debriesNo;
        var $alertValue;
        var $alertType;
        var $timeStamp;

        function __construct( $valueName, $value, $country, $town, $vill, $debriesNo, $alertValue, $alertType, $timeStamp ) {
            $this->valueName    = $valueName;
            $this->value        = $value;

            $this->country     = $country;
            $this->town        = $town ;
            $this->vill        = $vill;
            $this->debriesNo   = $debriesNo;
            $this->alertValue  = $alertValue;
            $this->alertType   = $alertType;
            $this->timeStamp   = $timeStamp;
        }
    }



    ############################ 
    ##### Action Component #####
    ############################    
    class ResponseComponent {
        var $list_of_phone_number;

        function do_action() {
           print("LED light up");
            // exec('led 1 1'); # light up led[1]
            // sleep(3);
            // exec('led 1 0'); # turn off led[1]
        }

        function do_action_3() {
           print("do_action_3");
            $arrayContact = array();
            // exec('led 1 1'); # light up led[1]
            // sleep(3);
            // exec('led 1 0'); # turn off led[1]

            // Query TouristAttraction

            // Parse TouristAttraction.txt
            $fileTouristAttraction = file_get_contents('/QueryResult/TouristAttraction.txt', true);
            $rowsTouristAttraction = explode("\n", $fileTouristAttraction);
            foreach ($rowsTouristAttraction as $rowTouristAttraction => $dataTouristAttraction) {
                echo($dataTouristAttraction);
                echo("<br>");

            }

            // Query GuroupID within TouistAttraction.txt

            // Parse GroupID.txt
            $fileGroupID = file_get_contents('/QueryResult/GroupID.txt', true);
            $rowsGroupID = explode("\n", $fileGroupID);
            foreach ($rowsGroupID as $rowGroupID => $dataGroupID) {
                echo($dataGroupID);
                echo("<br>");                    
            }

            // Query Contact of each GroupID

            // Parse Contact.txt
            $fileContact = file_get_contents('/QueryResult/Contact.txt', true);
            $rowsContact = explode("\n", $fileContact);
            foreach ($rowsContact as $rowContact => $dataContact) {
                $dataContactArray = explode(",", $dataContact);
                array_push($arrayContact, $dataContactArray[1]);
                echo($dataContactArray[1]);
                echo("<br>");
            }

            print_r($arrayContact);

            // Call the InformBySMS with Contacts  

        }

        function do_action_2() {
           print("do_action_2");
            // exec('led 1 1'); # light up led[1]
            // sleep(3);
            // exec('led 1 0'); # turn off led[1]
        }

        function do_action_1() {
           print("do_action_1");
            // exec('led 1 1'); # light up led[1]
            // sleep(3);
            // exec('led 1 0'); # turn off led[1]
        }


        function InformBySMS($list_of_phone_number) {

            
            print_r($list_of_phone_number);
        }

        function InformByVoiceMessage($list_of_phone_number) {
            print_r($list_of_phone_number);
        }
    }


?>
