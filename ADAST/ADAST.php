<?php

/**
 *
 * DESCRIPTION:
 *     Dynamic Alert Display.
 *
 * @author     Cheng-Wei Yu (Old Yu)
 * @copyright  Open Source
 * @project    OpenISDM (http://openisdm.iis.sinica.edu.tw/)
 *
 */

?>

<html>
    <head>
        <title>OpenISDM ADAST</title>

        <!--css-->
        <link rel="stylesheet" href="bootstrap/css/bootstrap-responsive.css">
        <link rel="stylesheet" href="bootstrap/css/bootstrap-responsive.min.css">
        <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
        <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">

<script type="text/javascript" language="javascript">
function CallDiv() {
    var divTag = document.createElement("div");
    divTag.id = "divDyn";
    divTag.className = "classA";
    divTag.innerHTML = "Welcome to aspxtutorial.com ";
    document.body.appendChild(divTag);
}
</script>

<!-- AJAX Dynamic Get Message Part (Begin) -->
<script type="text/javascript" src="jquery-1.2.6.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    setInterval(function() {
        $.ajax({
            url: 'message.php', <!--run in background-->
            cache: false,
            dataType: 'text',   <!--response data type-->
            type:'GET',         <!--request method-->
            <!--data: { name: $('#name').val()},-->
            data: {},
                error: function(xhr) {
                    alert('Ajax request error');
                },
                success: function(response) {
                    $('#dynamic').html(response);
                    $('#dynamic').fadeIn();
                }
        });
    }, 1000);
})
</script>
<!-- AJAX Dynamic Get Message Part (End) -->

    </head>
    <body>

<form id="form1" runat="server">
    <div>
           <input id="btClick" type="button" value="Click" onclick="CallDiv();" />
    <br />
    </div>
</form>

        <div class="content">
            <div class="row">

                <!-- Sidebar Menu -->
                <div class="span2">
                    <div class="well" style="width:200px; padding: 8px 0;">
                        <ul class="nav nav-list"> 
                          <li class="nav-header">Admin Menu</li>        
                          <li><a href="/ADASTdashboard"><i class="icon-home"></i> Dashboard</a></li>
                      <li><a href="/ADASTsub"><i class="icon-envelope"></i> Subscribe</a></li>
                      <li><a href="/ADASTlist"><i class="icon-align-justify"></i> List</a></li>
                      <li class="divider"></li>
                          <li><a href="#"><i class="icon-wrench"></i> Settings</a></li>
                          <li><a href="#"><i class="icon-share"></i> Logout</a></li>
                        </ul>
                    </div> <!-- END .well -->
                </div> <!-- END .sidebar-nav span2 -->

                <div class="span6 offset2">

                <div class="well" style="border-style:solid; border-width:5px; height:200px;">

                    <!-- AJAX Dynamic Get Message Part (Begin) -->
                    <div id="dynamic" textarea wrap="hard" style="width:100%; height:100%;">
                        <!-- // Text Tere (get from message.php using AJAX technique) -->
                    </textarea></div>
                    <!-- AJAX Dynamic Get Message Part (End) -->

                    </div>

                    <div class="accordion" id="accordion2">
                      <div class="accordion-group">
                        <div class="accordion-heading">
                          <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseOne">
                            Monitoring objects
                          </a>
                        </div>
                        <div id="collapseOne" class="accordion-body collapse in">
                          <div class="accordion-inner">

                            <table class="table table-striped">
                                <tbody>
                                    <tr>
                                        <th>Alert type</th>
                                        <th>Publisher</th>
                                        <th>Applied rule</th>
                                        <th>Description</th>
                                    </tr>
                                    <tr>
                                        <td>Debris Alert</td>
                                        <td>debris.alert.test.com</td>
                                        <td>debris_alert_rule1</td>
                                        <td>11/10</td>
                                    </tr>
                                    <tr>
                                        <td>Rain Info</td>
                                        <td>testbbb.com</td>
                                        <td>rain_alert_rules</td>
                                        <td>1/23</td>
                                    </tr>
                                    <tr>
                                        <td>Flood Alert</td>
                                        <td>flood.testcccccc.com</td>
                                        <td>Flood_alert</td>
                                        <td>3/14</td>
                                    </tr>
                                </tbody>
                                    </table>

                                    <a href="/ADASTlist" class="btn btn-danger" style="float:right">Modify</a>

                          </div>
                        </div>
                      </div> <!-- END .according-group -->
                      <div class="accordion-group">
                        <div class="accordion-heading">
                          <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseTwo">
                            Not-monitoring objects
                          </a>
                        </div>
                        <div id="collapseTwo" class="accordion-body collapse">
                          <div class="accordion-inner">

                            <table class="table table-striped">
                                <tbody>
                                    <tr>
                                        <th>Alert type</th>
                                        <th>Publisher</th>
                                        <th>Applied rule</th>
                                        <th>Description</th>
                                    </tr>
                                    <tr>
                                        <td>Earthquake</td>
                                        <td>test.not.monitoring.com</td>
                                        <td>Earthquake_alert_rules</td>
                                        <td>11/4</td>
                                    </tr>
                                </tbody>
                                    </table>

                                    <a href="/ADASTlist" class="btn btn-danger" style="float:right">Modify</a>

                          </div>
                        </div>
                      </div> <!-- END .according-group -->
                    </div> <!-- END .accordion #accordion2 -->
                </div> <!-- END .well span8 offset3 -->
            </div> <!-- END .row -->
        </div> <!-- END .content -->

        <!--add div tag-->
        <div id="msg"> </div>

    </body>
</html>

<?php

if ($_REQUEST['topic'] != '') {

    // solve magic_quotes_gpc kicking by using stripslashes() due to urlencode() by sender
    $feed_content = stripslashes($_REQUEST['content']);

    // debug on file
    file_put_contents('log/received-data.txt', $feed_content, FILE_APPEND);

    // parse feed notification
    $parameter = parser($feed_content);

    // debug
    echo '<h2>Debug Message: Parameter Instance</h2>';
    my_print_debug($parameter);

    // debug
    echo '<h2>Debug Message: Feed Content</h2>';
    echo $feed_content;

} else if ($_REQUEST['query'] == 'true') {    // get query result from virtuoso via POST method

    // debug: query result (TouristAttraction.txt, GroupID.txt, Contact.txt)
    foreach($_REQUEST['result'] as $key => $value) {
        echo '$key = '."$key".', $value = '."$value"."\n";
    }

    // todo: send SMS, Line, etc.

} else {
    // verbose message
    echo "This message is from callback.";
}

// parser
function parser($feed_content) {

    // load feed content
    $xml = new SimpleXmlElement($feed_content);

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
    print_r($message).'<br>';
    echo '</pre>';
}

// rule engine input structure
class Parameter
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
