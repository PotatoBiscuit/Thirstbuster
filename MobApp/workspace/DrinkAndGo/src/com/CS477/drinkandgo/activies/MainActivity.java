package com.CS477.drinkandgo.activies;

import static org.xmlpull.v1.XmlPullParser.END_DOCUMENT;
import static org.xmlpull.v1.XmlPullParser.START_TAG;

import java.io.IOException;
import java.util.ArrayList;

import org.xmlpull.v1.XmlPullParser;
import org.xmlpull.v1.XmlPullParserException;

import android.os.Bundle;
import android.util.Log;
import android.util.Xml;
import android.view.View;

import com.CS477.drinkandgo.Customer;
import com.CS477.drinkandgo.Drink;
import com.CS477.drinkandgo.R;
import com.CS477.drinkandgo.Venue;


public class MainActivity extends DrinkAndGoActivity 
{
    public MainActivity()
    {	super(R.layout.activity_main);}
    
    @Override
    protected void onCreate(Bundle bundle)
    {
    	super.onCreate(bundle);
    	try
    	{	
    		if(customers == null || venues == null || drinks == null)
    		{
    			customers = new ArrayList<Customer>();
    			venues = new ArrayList<Venue>();
    			drinks = new ArrayList<Drink>();
    			parseXml();
    		}
    	}
    	catch(Exception e)
    	{
    		e.printStackTrace();
    	}
    }
    
    private void parseXml() throws XmlPullParserException, IOException
    {
    	XmlPullParser parser = Xml.newPullParser();
		parser.setFeature(XmlPullParser.FEATURE_PROCESS_NAMESPACES, false);
		parser.setInput(getAssets().open("eld66.xml"), null);
		int eventType = parser.getEventType();
		while(eventType != END_DOCUMENT)
		{
			if(eventType == START_TAG)
			{
				String tag = parser.getName();
				if(tag != null)
				{
					if(tag.equals("table") || tag.equals("venue"))
					{
						String name = parser.getAttributeValue(null, "name");
						if(name.equals("customer"))
						{
							String values[] = new String[5];
							int i = 0;
							parser.next();
							while(i < 5)
							{
								if(parser.getEventType() == START_TAG)
								{
									parser.next();
									values[i++] = new String(parser.getText());
								}
								parser.next();
							}
							customers.add(new Customer(values));
						}
						else if(name.equals("venue"))
						{
							String values[] = new String[9];
							int i = 0;
							parser.next();
							while(i < 9)
							{
								if(parser.getEventType() == START_TAG)
								{
									parser.next();
									values[i++] = new String(parser.getText());
								}
								parser.next();
							}
							venues.add(new Venue(values));
						}
						else if(name.equals("drink"))
						{
							String values[] = new String[6];
							int i = 0;
							parser.next();
							while(i < 6)
							{
								if(parser.getEventType() == START_TAG)
								{
									parser.next();
									values[i++] = new String(parser.getText());
								}
								parser.next();
							}
							drinks.add(new Drink(values));
						}
					}
				}
			}
			eventType = parser.next();
		}
		Log.i("Customers", customers.toString());
		Log.i("Venues", venues.toString());
		Log.i("Drinks", drinks.toString());
    }
    
    public void gotoSignIn(View view)
    {	startActivity(SignInActivity.class);}
    
    public void gotoSignUp(View view)
    {	startActivity(SignUpActivity.class);}
}
