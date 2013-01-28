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
 
 
public class XmlDom4J {
 
    private static Element root;
    private static List<String> name = new ArrayList<String>();
    private static Document document;
    
    public static void main(String args[]){

        String xmlFile = "config.xml";
        File file = new File(xmlFile);
        if(file.exists() == false) {
            System.exit(1);
        }

//        // create connection object
//        URLConnectionUtil urlc = new URLConnectionUtil() ;
//        // URL
//        String urlStr = "http://hk.news.yahoo.com/rss/business/rss.xml";
 
        Map<String,Object> map = new HashMap<String,Object>(); 
//        InputStream res = null ;
 
        try {
 //           // connect to get data
 //           res = URLConnectionUtil.doGet(urlStr, map);
            
            // read XML file
            SAXReader reader = new SAXReader();
//            document = reader.read(res);
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
 
 
 
        }catch (Exception e) {
 
        }
 
 
 
    }
 
 
 
    /** print all xml data */
    public static void printXMLTree(){
        printElement(root, 0);
        return;
    }
    
    private static void printElement(Element element, int level){
        // print by level
        for(int i = 0; i < level; i++){
            System.out.print("\t");
        }
        System.out.print( "<" + element.getQualifiedName() + ">" );
        // TAG Attr
        List attributes = element.attributes();
        for(int i = 0; i < attributes.size(); i++){
            Attribute a = ((Attribute)attributes.get(i));
            System.out.print(" (Attr:\"" + a.getName() + "\"==" + a.getValue() + ")");
        }
        System.out.println( " "+element.getTextTrim());
 
        Iterator iter = element.elementIterator();
        while(iter.hasNext()){
            Element sub = (Element)iter.next();
            printElement(sub, level+1 );
        }
        return;
    }
 
    public static Document loadXMLFile(String filename)
    {
        Document document = null;
        try
        {
            SAXReader saxReader = new SAXReader();
            document = saxReader.read(new File(filename));
        }
        catch (Exception ex){
            ex.printStackTrace();
        }
        return document;
    }
 
    public static List<String> getAllDataByPath( String path ){
        List<String> data = new ArrayList<String>();
        Iterator it = document.selectNodes( path ).iterator();
        while(it.hasNext())
        {
            Element ele = (Element)it.next();
            System.out.println( path + " = "+ele.getStringValue());
            data.add(ele.getStringValue());
        }
        return data;
    }
}
