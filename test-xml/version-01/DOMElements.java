import java.io.*;
import javax.xml.parsers.*;
import org.w3c.dom.*;
import org.xml.sax.*;

public class DOMElements {

    static public void main(String[] arg){
        try {
//            BufferedReader bf = new BufferedReader(new InputStreamReader(System.in));
//            System.out.print("Enter XML File name: ");
//            String xmlFile = bf.readLine();
            String xmlFile = "config.xml";
            File file = new File(xmlFile);
            if(file.exists()){
                // Create a factory
                DocumentBuilderFactory factory = DocumentBuilderFactory.newInstance();
                // Use the factory to create a builder
                DocumentBuilder builder = factory.newDocumentBuilder();
                Document doc = builder.parse(xmlFile);
//                // Get a list of all elements in the document
//                NodeList list = doc.getElementsByTagName("*");
//                System.out.println("XML Elements: ");
//                for (int i=0; i<list.getLength(); i++) {
//                    // Get element
//                    Element element = (Element)list.item(i);
//                    System.out.println(element.getNodeName());
//                }

//////////////////////////////////////////////////////////////////

////Node node = doc.getDocumentElement();
////String root = node.getNodeName();
////System.out.println("@@@ root = " + root);
//
//Element root = null;
//// Get the XML root node by examining the children nodes
//list = doc.getChildNodes();
//System.out.println("### list.getLength() = " + list.getLength());
////NodeList list = doc.getChildNodes();
//for (int i = 0; i < list.getLength(); ++i) {
//    Node node = (Node)list.item(i);
//    //Element element = (Element)list.item(i);
//
//    // skip <!-- comment --> node in .xml
//    if (node.getNodeType() == Node.COMMENT_NODE) {  
//        continue;  
//    } 
//
//    System.out.println("QQQQQQQQQQQQQQQQQQQQQQQQQQQQQ");
//
//    Element element = (Element) node;
//
//    System.out.println("xd: " + element.getNodeName());
//    //    if (list.item(i) instanceof Element) {
//    //        root = (Element)list.item(i);
//    System.out.println("### root = " + root);
//    //        break;
//    //    }
//}

DOMElements dd = new DOMElements();
String blankString = "";
Node rootNode = doc.getDocumentElement();

String rootName = rootNode.getNodeName();

//System.out.println("rootNode = " + rootNode.getNodeName());
//System.out.println("rootNode.hasChildNodes() = " + rootNode.hasChildNodes());

dd.dfs(rootNode, blankString);
//dd.dfs(doc, rootName, blankString);
//dd.dfs(rootNode, blankString);


//////////////////////////////////////////////////////////////////

            }
            else{
                System.out.print("File not found!");
            }
        }
        catch (Exception e) {
            e.printStackTrace();
            System.exit(1);
        }
    }

//private void dfs(Node parentNode, String blankString) throws Exception
////private void dfs(Node parentNode) throws Exception
//{
//    for (Node node = parentNode.getFirstChild(); node != null; node = node.getNextSibling()) {
//
//        // print node information
//        System.out.println(blankString + node.getNodeName() + " = " + node.getNodeValue());
//
//        blankString += "    ";
//        // traverse children
//        dfs(node, blankString);
//        //dfs(node);
//        blankString = blankString.substring(4);
//    }
//}

private void dfs(Node parentNode, String blankString) throws Exception
//private void dfs(Node parentNode) throws Exception
{
    System.out.println(blankString + parentNode.getNodeName() + " = " + parentNode.getNodeValue());

    for (Node node = parentNode.getFirstChild(); node != null; node = node.getNextSibling()) {

        if (node.getNodeType() == Node.ELEMENT_NODE) {
        //if (true || node.getNodeType() == Node.ELEMENT_NODE) {
            // print node information
            //System.out.println(blankString + node.getNodeName());
//            System.out.println(blankString + node.getNodeName() + " = " + node.getNodeValue());
            //System.out.println(blankString + "nodeName = " + node.getNodeName());

            blankString += "    ";
            // traverse children
            dfs(node, blankString);
            //dfs(node);
            blankString = blankString.substring(4);
        }
    }
}

//private void dfs(Node parentNode, String blankString) throws Exception
//{
//    NodeList list = parentNode.getChildNodes();
//
//    if (list == null) {
//    //if (list == null || list.getLength() == 0) {
//        return;
//    }
//
//    for (int i = 0; i < list.getLength(); ++i) {
//        Node node = (Node) list.item(i);
//
//        if (node.getNodeType() == Node.ELEMENT_NODE) {
//            System.out.println(blankString + "nodeName = " + node.getNodeName());
//
//            // blank++
//            blankString += "    ";
//
////            if (node instanceof Element) {
////                Element element = (Element) node;
////                System.out.println(blankString + "nodeValue = " + element.getNodeValue());
////            }
//
//            dfs(node, blankString);
//
//            // blank--
//            blankString = blankString.substring(4);
//        }
//    }
//}

//private void dfs(Node parentNode, String blankString) throws Exception
////private void dfs(Document doc, String tagName, String blankString) throws Exception
//{
//    NodeList list = parentNode.getChildNodes();
//    //NodeList list = doc.getElementsByTagName(tagName);
//
//    if (list == null || list.getLength() == 0) {
//        return;
//    }
//
//    for (int i = 0; i < list.getLength(); ++i) {
//        Node node = (Node) list.item(i);
//
//        if (node.getNodeType() != Node.ELEMENT_NODE) {
//            continue;  
//        } 
//
//
////        // skip <!-- comment --> node in .xml
////        if (node.getNodeType() == Node.COMMENT_NODE) {  
////            continue;  
////        } 
////        Element element = (Element) node;
//
////
////        System.out.println(blankString + "tagName = " + element.getNodeName());
//        System.out.println(blankString + "nodeName = " + node.getNodeName());
//        blankString += "    ";
//
//        dfs(node, blankString);
//        //dfs(doc, element.getNodeName(), blankString);
//        blankString = blankString.substring(4);
//    }
//
////    for (int i = 0; i < list.getLength(); ++i) {
////        Node node = (Node) list.item(i);
////
////        // skip <!-- comment --> node in .xml
////        if (node.getNodeType() == Node.COMMENT_NODE) {  
////            continue;  
////        } 
////
////        Element element = (Element) node;
////
////        System.out.println("xd: " + element.getNodeName());
////        System.out.println(blankString + element.getNodeName());
////        blankString += "    ";
////
////        dfs(list);
////    }
//}

}

/*
// http://stackoverflow.com/questions/3273682/get-the-name-of-all-attributes-in-a-xml-file
public class DOMElements {
    static public void main(String[] arg){
        try {
            BufferedReader bf = new BufferedReader(new InputStreamReader(System.in));
            System.out.print("Enter XML File name: ");
            String xmlFile = bf.readLine();
            File file = new File(xmlFile);
            if(file.exists()){
                // Create a factory
                DocumentBuilderFactory factory = DocumentBuilderFactory.newInstance();
                // Use the factory to create a builder
                DocumentBuilder builder = factory.newDocumentBuilder();
                Document doc = builder.parse(xmlFile);
                // Get a list of all elements in the document
                NodeList list = doc.getElementsByTagName("*");
                System.out.println("XML Elements: ");
                for (int i=0; i<list.getLength(); i++) {
                    // Get element
                    Element element = (Element)list.item(i);
                    System.out.println(element.getNodeName());
                }
            }
            else{
                System.out.print("File not found!");
            }
        }
        catch (Exception e) {
            System.exit(1);
        }
    }
}
*/

/*
// http://myarch.com/treeiter/traditways
import org.w3c.dom.*;

public class RecursiveTraversal implements ITraversal {

  /**
   * Performs full tree traversal using recursion.
   * /
  public void traverse( Node parentNode ) {
    // traverse all nodes that belong to the parent
    for(Node node=parentNode.getFirstChild(); node!=null; node=node.getNextSibling()
    ) {
      // print node information
      System.out.println( node.getNodeName()+"="+node.getNodeValue());
      // traverse children
      traverse(node);
    }
  }
}
*/

/*
// http://www.exampledepot.com/egs/org.w3c.dom/GetRoot.html
// Create a document; this method is implemented in
// The Quintessential Program to Create a DOM Document from an XML File
Document doc = parseXmlFile("infilename.xml", false);

Element root = null;

// Get the XML root node by examining the children nodes
NodeList list = doc.getChildNodes();
for (int i=0; i<list.getLength(); i++) {
    if (list.item(i) instanceof Element) {
        root = (Element)list.item(i);
        break;
    }
}

// Get the XML root node the easy way
root = doc.getDocumentElement();
*/
