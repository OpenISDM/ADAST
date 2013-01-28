#!/usr/bin/env ruby
#
# send query result from virtuoso via POST method
#

require 'net/http'
require 'uri'

# set data
res = Net::HTTP.post_form(
                            URI.parse('http://adast.servequake.com/hub/broker/callback.php?query-result=true'), 
                            {
                                'phone-number-1'=>'0912345678', 
                                'phone-number-2'=>'0987654321'
                            }
                         )
# send data
puts res.body
