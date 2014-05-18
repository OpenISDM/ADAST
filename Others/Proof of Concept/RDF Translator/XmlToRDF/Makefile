all:
	mkdir -p ./output/classes/
	javac -encoding UTF8 -Djava.ext.dirs=./lib/ -d ./output/classes/ *.java

clean:
	rm -rfd ./output/classes/

run:
	java -Dfile.encoding=UTF-8 -Djava.ext.dirs=./lib/ -classpath ./output/classes/ openisdm.TraverseXML
