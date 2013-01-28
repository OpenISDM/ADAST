// http://jena.apache.org/tutorials/rdf_api.html
// http://jena.apache.org/documentation/javadoc/jena/com/hp/hpl/jena/vocabulary/package-tree.html
// http://jena.apache.org/documentation/javadoc/jena/com/hp/hpl/jena/vocabulary/DC.html
// http://jena.apache.org/documentation/javadoc/jena/com/hp/hpl/jena/rdf/model/Resource.html
// http://jena.sourceforge.net/IO/iohowto.html
//
// RDF2Go
// http://semanticweb.org/wiki/RDF2Go
//
// Java XML parser comparison
// http://blog.xuite.net/javax/programmer/22438335-%EF%BC%BBXML%EF%BC%BDJava%E4%B8%AD%E5%9B%9B%E7%A8%AE%E6%93%8D%E4%BD%9Cxml%E6%96%B9%E5%BC%8F%E7%9A%84%E6%AF%94%E8%BC%83
//
// Jena API
// http://jena.apache.org/documentation/javadoc/jena/index.html

/*
 * Classname
 *
 *   Crawler
 * 
 * Version information
 *
 *   Beta v0.1
 *
 * Date
 *
 *   2012-08-15 Old Yu
 * 
 * Copyright notice
 *
 *   Open source
 * 
 * TODO
 *
 *   1. Preserve timestamp on received files
 *   2. Check difference between local copy and remote file before downloading it
 *   3. Log file timestamp format
 */

package openisdm;

import java.io.*;
//import java.util.Date;
//import java.text.DateFormat;
//import org.apache.commons.net.ftp.*;

// The ARQ application API.
import org.openjena.atlas.io.IndentedWriter;

import com.hp.hpl.jena.graph.Triple;
import com.hp.hpl.jena.query.Query;
import com.hp.hpl.jena.query.QueryExecution;
import com.hp.hpl.jena.query.QueryExecutionFactory;
import com.hp.hpl.jena.query.QueryFactory;
import com.hp.hpl.jena.query.QuerySolution;
import com.hp.hpl.jena.query.ResultSet;
import com.hp.hpl.jena.rdf.model.Literal;
import com.hp.hpl.jena.rdf.model.Model;
import com.hp.hpl.jena.rdf.model.ModelFactory;
import com.hp.hpl.jena.rdf.model.RDFNode;
import com.hp.hpl.jena.rdf.model.Resource;
import com.hp.hpl.jena.sparql.core.Var;
import com.hp.hpl.jena.sparql.syntax.ElementGroup;
import com.hp.hpl.jena.vocabulary.DC;

import com.hp.hpl.jena.ontology.*;
import com.hp.hpl.jena.rdf.model.Property;

/*
 * Description
 *
 *
 * TODO
 */
public class GenerateRDF
{

    public static void main(String [] args)
    {

        try {
            // read config.xml
            String rootPath = ParseXML.getNodeValue("config.xml", "/config/generate-rdf/rootPath");

            // generate RDF
            new GenerateRDF().new FromFileHierarchy(rootPath);
        } catch (Exception e) {
            e.printStackTrace();
        }

        // exit
        System.exit(0);
    }


    public class FromFileHierarchy
    {
        // config.xml
        String outputPath = "";
        String fileName = "";
        String rootURL = "";

        // Jena used
        private Model model = null;
        private String xmlnsUri = "";
        private String rdfPrefix = "";
        private String rdfVocabulary_Subdirectory = "";
        private String rdfVocabulary_Leaf = "";

        // // Jena API for RDF
        // <xmlns:openisdm="http://somewhere.com/"> <openisdm:Subdirectory>
        //           |         |                        |        |
        //           |         ---- setNsPrefix();      |        ---- createProperty();
        //           |                                  |
        //           --------------------------------------- setNsPrefix();
        public FromFileHierarchy(String rootPath) throws Exception
        {
            // read config.xml
            this.outputPath = ParseXML.getNodeValue("config.xml", "/config/generate-rdf/outputPath");
            this.fileName = ParseXML.getNodeValue("config.xml", "/config/generate-rdf/fileName");
            this.rootURL = ParseXML.getNodeValue("config.xml", "/config/generate-rdf/rootURL");

            // set variable
            xmlnsUri = "http://openisdm.iis.sinica.edu.tw/";
            rdfPrefix = "openisdm";
            rdfVocabulary_Subdirectory = "Subdirectory";
            rdfVocabulary_Leaf = "Leaf";

            // create object
            model = ModelFactory.createDefaultModel();

            // set rdf prefix
            model.setNsPrefix(rdfPrefix, xmlnsUri);

            // look into file hierarchy
            traverse(new File(rootPath));

            // create output directory
            createLocalDirectory(this.outputPath);

            // output file
            String outputFile = this.outputPath + this.fileName;

            // generate RDF
            model.write(new FileOutputStream(outputFile + "_(RDF-XML).rdf"), "RDF/XML");
            model.write(new FileOutputStream(outputFile + "_(RDF-XML-ABBREV).rdf"), "RDF/XML-ABBREV");
            model.write(new FileOutputStream(outputFile + "_(TURTLE).rdf"), "TURTLE");
            model.write(new FileOutputStream(outputFile + "_(N-TRIPLE).rdf"), "N-TRIPLE");
            model.write(new FileOutputStream(outputFile + "_(N3).rdf"), "N3");
            //model.write(System.out, "RDF/XML-ABBREV");
            //model.write(System.out, "N-TRIPLE");
        }

        /*
         * Method Description
         *
         * Parameter
         *
         * Return value
         */
        private void traverse(File file) throws Exception
        {
            if (file.isDirectory()) {
                // create parent (RDF subject)
                Resource parentResource = model.createResource(this.rootURL + file.getName());

//                onDirectory(file);

                // get files
                File [] childs = file.listFiles();

                // DFS search
                for (File child : childs) {
                    // add RDF node
                    addRdfNode(parentResource, child);

                    // recursive
                    traverse(child);
                }

                return;
            }

//            onFile(file);

        }

        private void addRdfNode(Resource parentResource, File child) throws Exception
        {
            Property property = null;

            // create property (RDF predicate)
            if (child.isDirectory() == true) {
                property = model.createProperty(xmlnsUri + rdfVocabulary_Subdirectory);
            } else {
                property = model.createProperty(xmlnsUri + rdfVocabulary_Leaf);
            }

            // create child (RDF object)
            Resource childResource = model.createResource(this.rootURL + child.getName());

            // add child, where (parentResource, property, childResource) is mapped as (subject, predicate, object) in RDF
            parentResource.addProperty(property, childResource);
        }

        /*
         * Method Description
         *
         * Parameter
         *
         * Return value
         */
        private void onDirectory(File d)
        {
            System.out.println(d.getName());
        }

        /*
         * Method Description
         *
         * Parameter
         *
         * Return value
         */
        private void onFile(File f)
        {
            System.out.println(f.getName());
        }
    }    // end of class FromFileHierarchy

    /*
     * Method Description
     *   Create local directory
     *
     * Parameter
     *   path
     *     [in] The path to create the directory.
     *
     * Return value
     *   None.
     */
    private void createLocalDirectory(String path) throws Exception    // Crawler.java has this method too, Q_Q...
    {
        if (new File(path).mkdir() == false) {
            ;
            //// no message is ok (update data)
            //System.out.println("Warning: directory already exists.");
        }
    }
}    // end of class GenerateRDF


//        File root = new File("/home/foobar/Personal/Examples");
//
//        try {
//            String[] extensions = {"xml", "java", "dat"};
//            boolean recursive = true;
//
//            //
//            // Finds files within a root directory and optionally its
//            // subdirectories which match an array of extensions. When the
//            // extensions is null all files will be returned.
//            //
//            // This method will returns matched file as java.io.File
//            //
//            Collection files = FileUtils.listFiles(root, extensions, recursive);
//
//            for (Iterator iterator = files.iterator(); iterator.hasNext();) {
//                File file = (File) iterator.next();
//                System.out.println("File = " + file.getAbsolutePath());
//            }
//        } catch (Exception e) {
//            e.printStackTrace();
//        }


