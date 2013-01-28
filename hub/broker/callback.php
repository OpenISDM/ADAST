<?php

//// charles syntax
//file_put_contents('output/callback', print_r($_REQUEST['message'], FILE_APPEND));

if ($_REQUEST['topic'] != '') {

    // verbose message
    echo "This message is from callback.php, good job O(∩_∩)O~";

    // debug on file
    file_put_contents('output/received-data.txt', $_REQUEST['message'], FILE_APPEND);

    // parse feed notification
    $parameter = parser($_REQUEST['message']);

    my_print_debug($parameter);

} else if ($_REQUEST['query-result'] == 'true') {    // get query result from virtuoso via POST method

    // debug on file
    file_put_contents('output/query-result.txt', $_REQUEST['phone-number-1']."\n", FILE_APPEND);

    // todo: send SMS, Line, etc.

} else {
    // verbose message
    echo "This message is from callback.php, bad job o(〒﹏〒)";
}

// parser
function parser($feed_content) {

    //// debug
    //phpinfo();

    // simulate
$string = <<<XML
<?xml version="1.0"?>
<RDF xmlns="http://www.w3.org/1999/02/22-rdf-syntax-ns#"
     xmlns:err="http://www.w3.org/2005/xqt-errors#"
     xmlns:fti="http://franz.com/ns/allegrograph/2.2/textindex/"
     xmlns:fn="http://www.w3.org/2005/xpath-functions#"
     xmlns:skos="http://www.w3.org/2004/02/skos/core#"
     xmlns:dc="http://purl.org/dc/elements/1.1/"
     xmlns:dcterms="http://purl.org/dc/terms/"
     xmlns:xsd="http://www.w3.org/2001/XMLSchema#"
     xmlns:rdfs="http://www.w3.org/2000/01/rdf-schema#"
     xmlns:foaf="http://xmlns.com/foaf/0.1/"
     xmlns:owl="http://www.w3.org/2002/07/owl#"
     xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#">
  <Description rdf:nodeID="b6564E2EEx1">
    <ns1:station2StationName xmlns:ns1="http://openisdm.iis.sinica.edu.tw/">sat2</ns1:station2StationName>
    <ns1:station1StationName xmlns:ns1="http://openisdm.iis.sinica.edu.tw/">sat1</ns1:station1StationName>
    <ns1:station2ID xmlns:ns1="http://openisdm.iis.sinica.edu.tw/">1198</ns1:station2ID>
    <ns1:station1ID xmlns:ns1="http://openisdm.iis.sinica.edu.tw/">1199</ns1:station1ID>
    <ns1:Time xmlns:ns1="http://purl.org/NET/c4dm/event.owl#">2012/08/22 17:00:00</ns1:Time>
    <ns1:AlertType xmlns:ns1="http://openisdm.iis.sinica.edu.tw/">Y</ns1:AlertType>
    <ns1:AlertValue xmlns:ns1="http://openisdm.iis.sinica.edu.tw/">200</ns1:AlertValue>
    <ns1:Debrisno xmlns:ns1="http://openisdm.iis.sinica.edu.tw/">DF025</ns1:Debrisno>
    <ns1:Vill xmlns:ns1="http://purl.org/ontology/places#" rdf:resource="http://openisdm.iis.sinica.edu.tw/#Village/秀林鄉"/>
    <ns1:Town xmlns:ns1="http://purl.org/ontology/places#" rdf:resource="http://openisdm.iis.sinica.edu.tw/#Town/花蓮縣"/>
    <ns1:County xmlns:ns1="http://purl.org/ontology/places#" rdf:resource="http://openisdm.iis.sinica.edu.tw/#County/台灣"/>
  </Description>
  <Description rdf:about="http://openisdm.iis.sinica.edu.tw/#DebrisAlert">
    <ns1:Eventsmudslide xmlns:ns1="http://umbel.org/umbel/#" rdf:nodeID="b6564E2EEx1"/>
  </Description>
</RDF>
XML;
$xml = new SimpleXMLElement($string);


//    // ToDo
//    $xml = new SimpleXmlElement(file_get_contents("../input/debris_alerts.xml"));
//    $xml = new SimpleXmlElement(urlencode($_REQUEST['message']));
//    $xml = new SimpleXmlElement($_REQUEST['message']);
    //$xml = new SimpleXmlElement($feed_content);


    // structure for getting value from feed-of-rdf by using RuleEngine's key
    $lookupArray = array("valueName"  => array("tag_name" => "station1StationName", "tag_type" => "Value"), 
                         "value"      => array("tag_name" => "station1ID",          "tag_type" => "Value"), 
                         "country"    => array("tag_name" => "County",              "tag_type" => "Attribute"), 
                         "town"       => array("tag_name" => "Town",                "tag_type" => "Attribute"), 
                         "vill"       => array("tag_name" => "Vill",                "tag_type" => "Attribute"), 
                         "debriesNo"  => array("tag_name" => "Debrisno",            "tag_type" => "Value"), 
                         "alertValue" => array("tag_name" => "AlertValue",          "tag_type" => "Value"), 
                         "alertType"  => array("tag_name" => "AlertType",           "tag_type" => "Value"), 
                         "timeStamp"  => array("tag_name" => "Time",                "tag_type" => "Value")
                     );

    // parse feed-of-rdf and save to array
    $resultArray = array();
    foreach($lookupArray as $key => $value) {
        //echo "[$key] ".$value["tag_name"]."=".$value["tag_type"]."<br />";

        if ($value["tag_type"] == "Value") {
            $resultArray["$key"] = getNodeValue($xml, $value["tag_name"]);
        } else if ($value["tag_type"] == "Attribute") {
            $resultArray["$key"] = getNodeAttribute($xml, $value["tag_name"]);
        } else {
            echo "Not Supported Yet."."<br />";
        }
    }

    // save to RuleEngine's structure
    $parameter = new Parameter($resultArray["valueName"], 
                               $resultArray["value"], 
                               $resultArray["country"], 
                               $resultArray["town"], 
                               $resultArray["vill"], 
                               $resultArray["debriesNo"], 
                               $resultArray["alertValue"], 
                               $resultArray["alertType"], 
                               $resultArray["timeStamp"]
                           );

    return $parameter;
}

// get xml node value
function getNodeValue($xml, $tag_name) {
    $results = $xml->children(NULL)->Description->children("ns1", true)->$tag_name;
    return (string) $results[0];
}

// get xml node attributes
function getNodeAttribute($xml, $tag_name) {
    $results = $xml->children(NULL)->Description->children("ns1", true)->$tag_name->attributes("rdf", true);
    return (string) $results['resource'];
}

// debug
function my_print_debug($message)
{
    echo '<pre>';
    echo '@@ Test Begin'.'<br>';
    print_r($message).'<br>';
    echo '@@ Test End'.'<br>';
    echo '</pre>';
}

// rule engine input structure
class Parameter
//class Parameter extends Fact
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

    function __construct($valueName, $value, $country, $town, $vill, $debriesNo, $alertValue, $alertType, $timeStamp)
    {
        $this->valueName  = $valueName;
        $this->value      = $value;

        $this->country    = $country;
        $this->town       = $town;
        $this->vill       = $vill;
        $this->debriesNo  = $debriesNo;
        $this->alertValue = $alertValue;
        $this->alertType  = $alertType;
        $this->timeStamp  = $timeStamp;
    }
}

?>
