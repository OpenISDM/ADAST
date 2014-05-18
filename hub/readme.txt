# Description
Implement Google Pubsubhubbub Hub

# Example (on the same machine) to subscribe a topic
#http://localhost/Hub/hub.php?callback=http://localhost/Hub/broker/callback.php&topic=http://localhost/debris.xml
http://localhost/Hub/hub.php?callback=http://localhost/ADAST/ADAST.php&topic=http://localhost/debris.xml

# Example (on the same machine) to notify an updated data source
http://localhost/Hub/hub.php?notification=true&topic=http://localhost/debris.xml
