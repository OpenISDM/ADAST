all:
	mkdir -p ./output/classes/
	mkdir -p ./output/rdf/
	javac -Djava.ext.dirs=./lib/ -d ./output/classes/ *.java

clean:
	rm -rfd ./output/classes/ ./output/ftp-data/ ./output/rdf/

run:
	java -Djava.ext.dirs=./lib/ -classpath ./output/classes/ openisdm.Main
	#java -Djava.ext.dirs=./lib/ -classpath ./output/classes/ openisdm.Crawler

rdf:
	java -Djava.ext.dirs=./lib/ -classpath ./output/classes/ openisdm.GenerateRDF

#test.old:
#	#javac -Djava.ext.dirs=./lib/ -d ./output/classes/ FromXML.java
#	javac -Djava.ext.dirs=./lib/ -d ./output/classes/ FromXML.java ParseXML.java
#	#java -Djava.ext.dirs=./lib/ -classpath ./output/classes/ openisdm.FromXML
#	java -Dfile.encoding=UTF-8 -Djava.ext.dirs=./lib/ -classpath ./output/classes/ openisdm.FromXML

test:
	#javac -Djava.ext.dirs=./lib/ -d ./output/classes/ FromXML.java
	javac -encoding UTF8 -Djava.ext.dirs=./lib/ -d ./output/classes/ FromXML.java ParseXML.java
	#java -Djava.ext.dirs=./lib/ -classpath ./output/classes/ openisdm.FromXML
	java -Dfile.encoding=UTF-8 -Djava.ext.dirs=./lib/ -classpath ./output/classes/ openisdm.FromXML
