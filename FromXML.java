
package openisdm;

import java.io.File;
import java.io.InputStream;
import java.util.ArrayList;
import java.util.HashMap;
import java.util.Iterator;
import java.util.List;
import java.util.Map;
 
import org.dom4j.Attribute;
import org.dom4j.Document;
import org.dom4j.Element;
import org.dom4j.io.SAXReader;
 
import org.dom4j.io.XMLWriter;
import org.dom4j.io.OutputFormat;
import java.io.FileOutputStream;

import com.hp.hpl.jena.rdf.model.Model;
import com.hp.hpl.jena.rdf.model.ModelFactory;
import com.hp.hpl.jena.rdf.model.Resource;
import com.hp.hpl.jena.rdf.model.Property;
import com.hp.hpl.jena.rdf.model.Statement;

public class FromXML {
 
    //private Element root;
    private static Element root;
    //private static List<String> name = new ArrayList<String>();
    private static Document document;

    // Jena used
    private Model model = null;
    private String xmlnsUri = "";
    private String rdfPrefix = "";
//private String rootURL = ParseXML.getNodeValue("config.xml", "/config/generate-rdf/rootURL");

    public FromXML(String xmlFile) throws Exception
    {
        // set variable
        xmlnsUri = "http://openisdm.iis.sinica.edu.tw/";
        rdfPrefix = "openisdm";

        // create object
        model = ModelFactory.createDefaultModel();

        // set rdf prefix
        model.setNsPrefix(rdfPrefix, xmlnsUri);

//        File file = new File(xmlFile);
//        if(file.exists() == false) {
//            System.exit(1);
//        }

        // read XML file
//        SAXReader reader = new SAXReader();
//        //document = reader.read(file);
//        document = reader.read(xmlFile);
        document = new SAXReader().read(xmlFile);

        document = loadXmlFile(xmlFile);

        // get XML Root Node
        root = document.getRootElement();

        //// Root Node NAME
        //System.out.println(root.getName());
        //System.out.println();

        // print all XML DATA
        printXML(root, 0);

        // traverse
        traverse(root);

        // output file
        String outputFile = "./output/rdf/test";
        //String outputFile = this.outputPath + this.fileName;

        // generate RDF
        model.write(new FileOutputStream(outputFile + "_(RDF-XML).rdf"), "RDF/XML");
        model.write(new FileOutputStream(outputFile + "_(RDF-XML-ABBREV).rdf"), "RDF/XML-ABBREV");
        model.write(new FileOutputStream(outputFile + "_(TURTLE).rdf"), "TURTLE");
        model.write(new FileOutputStream(outputFile + "_(N-TRIPLE).rdf"), "N-TRIPLE");
        model.write(new FileOutputStream(outputFile + "_(N3).rdf"), "N3");
        //model.write(System.out, "RDF/XML-ABBREV");
        //model.write(System.out, "N-TRIPLE");
    }

    private Document loadXmlFile(String filename) throws Exception
    {
        Document document = null;

        SAXReader saxReader = new SAXReader();
        document = saxReader.read(new File(filename));

        return document;
    }
    
    public static void main (String [] args)
    {
        try {
            //new FromXML("config.xml");
            new FromXML("./input/debries.xml");
        } catch (Exception e) {
            e.printStackTrace();
        }

        // exit
        System.exit(0);
/*
        String xmlFile = "config.xml";
        File file = new File(xmlFile);
        if(file.exists() == false) {
            System.exit(1);
        }
 
        try {
            // read XML file
            SAXReader reader = new SAXReader();
            document = reader.read(file);

            // get XML Root Node
            root = document.getRootElement();

            // Root Node NAME
            System.out.println( root.getName() );
            System.out.println(  );

            // print all XML DATA
            printXMLTree();

            // print data => /rss/channel/item/title
//            name = getAllDataByPath("/rss/channel/item/title");

        } catch (Exception e) {
            e.printStackTrace();
        }
*/
    }

    private void traverse(Element element) throws Exception
    {
        // create parent (RDF subject)
        Resource parentResource = model.createResource(xmlnsUri + element.getQualifiedName());

        // get children
        Iterator iterator = element.elementIterator();

        // DFS search
        while (iterator.hasNext()) {
            // get next child
            Element childElement = (Element) iterator.next();

            // add RDF node
            addRdfNode(parentResource, childElement);

            // recursive
            traverse(childElement);
        }

        return;
    }

    private void addRdfNode(Resource parentResource, Element childElement) throws Exception
    {
        // RDF triples: subject, predicate, object
        Resource subject = parentResource;
        Property predicate = model.createProperty(xmlnsUri + childElement.getQualifiedName());
        String object = childElement.getTextTrim();

        // add
        Statement statement = model.createStatement(subject, predicate, object);
        model.add(statement);
    }

    // Debug purpose
    private void printXML(Element element, int level) throws Exception
    {
        // print by level
        for (int i = 0; i < level; ++i) {
            System.out.print("  ");
        }

        System.out.print("<" + element.getQualifiedName() + ">");

        // attributes
        List attributes = element.attributes();
        for (int i = 0; i < attributes.size(); ++i) {
            Attribute attribute = ((Attribute) attributes.get(i));
            System.out.print(" (Attr:\"" + attribute.getName() + "\"==" + attribute.getValue() + ")");
        }

        System.out.println(" " + element.getTextTrim());

/*
        // (incomplete) to avoid 亂碼 if there is no "-Dfile.encoding=UTF-8" option while running
        //// http://chenlb.blogjava.net/archive/2007/09/05/143036.html
        //// http://blog.csdn.net/redez/article/details/527897
        //// http://www.blogjava.net/chenlb/archive/2007/09/06/143040.html
        //// http://topic.csdn.net/t/20040902/10/3332591.html
        //// http://topic.csdn.net/t/20040902/09/3331941.html
        String xmlFile = "xdxdxd.txt";
        XMLWriter writer;
        OutputFormat format = OutputFormat.createPrettyPrint();
        format.setEncoding("UTF-8");
        FileOutputStream fos = new FileOutputStream(xmlFile, true);
        writer = new XMLWriter(fos, format);
        writer.write(" " + element.getTextTrim());
        writer.close();
*/

        // get children
        Iterator iterator = element.elementIterator();

        // DFS search
        while (iterator.hasNext()) {
            // get next child
            Element childElement = (Element) iterator.next();

            // recursive
            printXML(childElement, level + 1);
        }

        return;
    }
}
