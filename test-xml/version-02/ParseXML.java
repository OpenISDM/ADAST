/*
 * Classname
 *
 *   ParseXML
 * 
 * Version information
 *
 *   Beta v0.1
 *
 * Date
 *
 *   2012-08-30 Old Yu
 * 
 * Copyright notice
 *
 *   Open source
 */

package openisdm;

import java.io.*;
import javax.xml.xpath.*;
import org.xml.sax.InputSource;

/*
 * Description
 *
 * TODO
 */
public class ParseXML
{

    public static void main(String [] args)
    {

        try {
            String host = getNodeValue("config.xml", "/config/cwb-ftp/host");
            System.out.println("host = " + "\"" + host + "\"");

            String port = getNodeValue("config.xml", "/config/cwb-ftp/port");
            System.out.println("port = " + "\"" + port + "\"");

            String username = getNodeValue("config.xml", "/config/cwb-ftp/username");
            System.out.println("username = " + "\"" + username + "\"");

            String password = getNodeValue("config.xml", "/config/cwb-ftp/password");
            System.out.println("password = " + "\"" + password + "\"");

            String timeout = getNodeValue("config.xml", "/config/cwb-ftp/timeout");
            System.out.println("timeout = " + "\"" + timeout + "\"");

            String logFile = getNodeValue("config.xml", "/config/cwb-ftp/logFile");
            System.out.println("logFile = " + "\"" + logFile + "\"");

            String localPath = getNodeValue("config.xml", "/config/cwb-ftp/localPath");
            System.out.println("localPath = " + "\"" + localPath + "\"");

            String isLocalPassiveMode = getNodeValue("config.xml", "/config/cwb-ftp/isLocalPassiveMode");
            System.out.println("isLocalPassiveMode = " + "\"" + isLocalPassiveMode + "\"");
        } catch (Exception e) {
            e.printStackTrace();
        }

        // exit
        System.exit(0);
    }

    /*
     * Method Description
     *
     * Parameter
     *
     * Return value
     */
    public static String getNodeValue(String fileName, String nodeName) throws Exception
    {
        String result = "";

        try {
            XPath xpath = XPathFactory.newInstance().newXPath();
            InputSource inputSource = new InputSource(fileName);
            result = xpath.evaluate(nodeName, inputSource);
        } catch (Exception e) {
            e.getMessage();
        }

        // check null
        if (result.equals("") == true) {
            throw new Exception("Error: '<" + nodeName + ">' tag path in config.xml gets empty string");
            //throw new Exception("Error: '<" + nodeName.substring(nodeName.lastIndexOf('/') + 1 ) + ">' tag name in config.xml gets empty string");
        }

        return result;
    }
}
