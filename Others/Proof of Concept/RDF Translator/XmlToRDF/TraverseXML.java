/*
 * Classname
 *
 *   TraverseXML
 * 
 * Version information
 *
 *   v0.1
 *
 * Date
 *
 *   2012-11-15 Cheng-Wei Yu (Old Yu)
 * 
 * Copyright notice
 *
 *   Open source
 */

package openisdm;

import java.io.File;
import java.io.FileOutputStream;
import java.io.InputStream;
import java.util.ArrayList;
import java.util.HashMap;
import java.util.Iterator;
import java.util.List;
import java.util.Map;
import org.dom4j.Attribute;
import org.dom4j.Document;
import org.dom4j.Element;
import org.dom4j.io.OutputFormat;
import org.dom4j.io.SAXReader;
import org.dom4j.io.XMLWriter;

/*
 * Description
 *   Traverse XML.
 */
public class TraverseXML {
    private static Element root;
    private static Document document;

    /*
     * Method Description
     *   Constructor.
     *
     * Parameter
     *   xmlFile
     *     [in] XML file.
     */
    public TraverseXML(String xmlFile) throws Exception
    {
        // read XML file
        document = new SAXReader().read(xmlFile);

        // load XML file
        document = loadXmlFile(xmlFile);

        // get XML Root Node
        root = document.getRootElement();

        // print all XML DATA
        printXML(root, 0);

        // traverse
        traverse(root);
    }

    /*
     * Method Description
     *   Load XML file.
     *
     * Parameter
     *   filename
     *     [in] XML filename.
     *
     * Return value
     *   Document class.
     */
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
            new TraverseXML("./input/debris_alerts.xml");
        } catch (Exception e) {
            e.printStackTrace();
        }

        // exit
        System.exit(0);
    }

    /*
     * Method Description
     *   DFS traversal.
     *
     * Parameter
     *   element
     *     [in] Element class.
     *
     * Return value
     *   None.
     */
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

    /*
     * Method Description
     *   Debug purpose.
     *
     * Parameter
     *   element
     *     [in] Element class.
     *   level
     *     [in] XML indent level.
     *
     * Return value
     *   None.
     */
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
