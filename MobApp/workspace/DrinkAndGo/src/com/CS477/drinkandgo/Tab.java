package com.CS477.drinkandgo;

import org.json.JSONException;
import org.json.JSONObject;

public class Tab 
{
	private final String id, tableNum, venueID, customerID, status;
	
	public Tab(String id, String tableNum, String venueID, String customerID, String status) 
	{
		this.id = id;
		this.tableNum = tableNum;
		this.venueID = venueID;
		this.customerID = customerID;
		this.status = status;
	}
	
	public Tab(JSONObject obj) throws JSONException
	{	
		this(obj.getString("id"), obj.getString("table_number"), obj.getString("venue_id"),
			obj.getString("customer_id"), obj.getString("status"));
	}

	public String getTableNum() 
	{	return tableNum;}

	public String getVenueID() 
	{	return venueID;}

	public String getStatus()
	{	return status;}

	public String getCustomerID()
	{	return customerID;}

	public String getId() 
	{	return id;}
}
