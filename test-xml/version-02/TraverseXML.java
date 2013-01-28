
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

public class TraverseXML {

    //private Element root;
    private static Element root;
    private static Document document;

    public TraverseXML(String xmlFile) throws Exception
    {

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
            //new TraverseXML("config.xml");
            new TraverseXML("./input/debris_alerts.xml");
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
        // get children
        Iterator iterator = element.elementIterator();

        // DFS search
        while (iterator.hasNext()) {
            // get next child
            Element childElement = (Element) iterator.next();

            // recursive
            traverse(childElement);
        }

        return;
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
