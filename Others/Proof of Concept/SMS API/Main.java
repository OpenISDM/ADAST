import java.io.*;

public class Main
{
    public static void main(String [] args)
    {
        //declare new objects and variables
        ComputeSmsData sms = new ComputeSmsData();
        SerialToGsm stg = new SerialToGsm("serial0");

        String retStr = new String("");
        String sss = new String();
        String alarmNumber = new String("+886912020410");   // a real phone number here

        // check for messages
        retStr = stg.checkSms();
        if (retStr.indexOf("ERROR") == -1) {
            System.out.println("Phone # of sender: " + stg.readSmsSender());
            System.out.println("Recv'd SMS message: " + stg.readSms());
        }

        // send a message
        sss = stg.sendSms(alarmNumber,"Hello GSM World");

        // exit
        System.exit(0);
    }
}
