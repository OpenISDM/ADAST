#!/usr/bin/env ruby
# encoding: utf-8

#
# send query result from virtuoso via POST method
#

require 'net/http'
require 'uri'


# set URI
uri = URI('http://adast.servequake.com/hub/broker/callback.php?query=true')

# set post data
result = [
    'http://openisdm.iis.sinica.edu.tw/#TouristAttraction/Taroko_National_Park1', 
    'http://openisdm.iis.sinica.edu.tw/#TouristAttraction/Taroko_National_Park2', 
    'http://openisdm.iis.sinica.edu.tw/#TouristAttraction/Taroko_National_Park3'
]

# set data
res = Net::HTTP.post_form(uri, {'result[]' => result})
# send data
puts res.body

result = [
    'CD001(temp)', 
    'TE022(temp)', 
    'CD002(temp)', 
    'CD005(temp)', 
    'FA033(temp)', 
    'FA034(temp)'
]

# set data
res = Net::HTTP.post_form(uri, {'result[]' => result})
# send data
puts res.body

result = [
    '東晟旅行社, 0225651515, TE022(temp)', 
    '首都旅行社, 0225966923, CD001(temp)', 
    '首都旅行社, 0225966923, CD002(temp)', 
    '首都旅行社, 0225966923, CD005(temp)', 
    '捷利旅行社, 062290100, FA033(temp)', 
    '捷利旅行社, 062290100, FA034(temp)'
]

# set data
res = Net::HTTP.post_form(uri, {'result[]' => result})
# send data
puts res.body

