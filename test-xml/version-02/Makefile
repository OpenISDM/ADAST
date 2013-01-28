all:
	mkdir -p ./output/classes/
	javac -Djava.ext.dirs=./lib/ -d ./output/classes/ *.java

clean:
	rm -rfd ./output/classes/ ./output/ftp-data/ ./output/rdf/

run:
	java -Djava.ext.dirs=./lib/ -classpath ./output/classes/ openisdm.TraverseXML
	#java -Djava.ext.dirs=./lib/ -classpath ./output/classes/ openisdm.Crawler

test:
	#javac -Djava.ext.dirs=./lib/ -d ./output/classes/ FromXML.java
	javac -encoding UTF8 -Djava.ext.dirs=./lib/ -d ./output/classes/ FromXML.java ParseXML.java
	#java -Djava.ext.dirs=./lib/ -classpath ./output/classes/ openisdm.FromXML
	java -Dfile.encoding=UTF-8 -Djava.ext.dirs=./lib/ -classpath ./output/classes/ openisdm.FromXML
