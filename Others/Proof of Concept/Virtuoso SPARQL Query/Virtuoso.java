/*
 * Classname
 *
 *   Virtuoso
 * 
 * Version information
 *
 *   v0.1
 *
 * Date
 *
 *   2012-9-15 Cheng-Wei Yu (Old Yu)
 * 
 * Copyright notice
 *
 *   Open source
 */

import java.io.*;
import java.lang.*;
import java.sql.*;
import java.util.Properties;

/*
 * Description
 *   Connect to Virtuoso RDF server: Upload files, SPARQL queries.
 */
class Virtuoso
{
    /*
     * Method Description
     *   Print name.
     *
     * Parameter
     *   name
     *     [in] name.
     *
     * Return value
     *   None.
     */
    public static void PrintName(String name)
    {
        // Avoid empty name
        if (name == null) {
            name = "null";
        }

        // Print message
        System.out.print(name + " ");
    }

    /*
     * Method Description
     *   Execute SPARQL search query.
     *
     * Parameter
     *   conn
     *     [in] Connection class.
     *   query
     *     [in] SPARQL query.
     *
     * Return value
     *   None.
     */
    public static void ExecuteQuerySearch(Connection conn, String query) throws Exception
    {
        // Variable
        ResultSetMetaData meta;
        Statement stmt;
        ResultSet result;
        int count;

        // Print message
        System.out.println("EXECUTE: " + query);

        // Execute query
        stmt = conn.createStatement();
        result = stmt.executeQuery(query);

        // Print message
        meta = result.getMetaData();
        count = meta.getColumnCount();
        for (int c = 1; c <= count; c++) {
            PrintName(meta.getColumnName(c));
        }

        // Print message
        System.out.println("\n--------------");
        while (result.next()) {
            for (int c = 1; c <= count; c++) {
                PrintName(result.getString(c));
            }

            System.out.println("");
        }

        // Release resource & print message
        stmt.close();
        System.out.println("");
    }

    /*
     * Method Description
     *   Main method.
     *
     * Parameter
     *   args
     *     [in] arguments.
     *
     * Return value
     *   None.
     */
    public static void main(String [] args)
    {
        try {
            // Add the OpenLink JDBC driver to the system properties
            Class.forName("virtuoso.jdbc4.Driver");

            // Connect to Virtuoso
            String username = "dba";
            String password = "iis404";
            Connection conn = DriverManager.getConnection("jdbc:virtuoso://vrtestbed.iis.sinica.edu.tw/charset=UTF-8/log_enable=2", username, password);

            // Drop from Virtuoso before upload to use the same URL
            ExecuteQuery(conn, "SPARQL DROP SILENT GRAPH <http://test.com>");

            // Upload RDF & register URL on Virtuoso (somewhere cannot be localhost)
            ExecuteQuery(conn, "SPARQL LOAD <http://somewhere/example.rdf> INTO GRAPH <http://test.com>");

            // Query from Virtuoso
            ExecuteQuerySearch(conn, "SPARQL SELECT * from <http://test.com> WHERE {?s ?p ?o} LIMIT 400");
        } catch (Exception e) {
            e.printStackTrace();
        }
    }

    /*
     * Method Description
     *   Execute SPARQL query.
     *
     * Parameter
     *   conn
     *     [in] Connection class.
     *   query
     *     [in] SPARQL query.
     *
     * Return value
     *   None.
     */
    public static void ExecuteQuery(Connection conn, String query) throws Exception
    {
        // Variable
        ResultSetMetaData meta;
        Statement stmt;
        ResultSet result;

        // Print message
        System.out.println("EXECUTE: " + query);

        // Execute query
        stmt = conn.createStatement();
        result = stmt.executeQuery(query);

        // Release resource & print message
        stmt.close();
        System.out.println("");
    }
}
