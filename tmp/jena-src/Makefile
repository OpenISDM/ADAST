ARG = 01    # default value

all:
	mkdir -p ./output/classes/
	javac -Djava.ext.dirs=./lib/ -d ./output/classes/ *.java

clean:
	rm -rfd ./output/classes

run:
	echo "Usage: make run 'ARG=04'"
	java -Djava.ext.dirs=./lib/ -classpath ./output/classes/ jena.examples.rdf.Tutorial$(ARG)
