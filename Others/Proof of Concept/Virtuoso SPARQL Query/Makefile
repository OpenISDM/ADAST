all:
	mkdir -p ./output/classes/
	javac -Djava.ext.dirs=./lib/ -d ./output/classes/ *.java

clean:
	rm -rfd ./output/classes/

run:
	java -Djava.ext.dirs=./lib/ -Djdbc.drivers=virtuoso.jdbc4.Driver -classpath ./output/classes/ Virtuoso
