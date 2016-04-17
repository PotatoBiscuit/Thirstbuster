package com.CS477.drinkandgo;

import org.json.JSONException;
import org.json.JSONObject;

public class Customer 
{
	private final String name, username, password, credit;
	
	public Customer(String name, String username, String password)
	{	this(name, username, password, "0");}
	
	public Customer(String name, String username, String password, String credit)
	{
		this.name = name;
		this.username = username;
		this.password = password;
		this.credit = credit;
	}
	
	public Customer(JSONObject obj) throws JSONException
	{	
		this(obj.getString("name"), obj.getString("username"), 
		obj.getString("password"), obj.getString("credit"));
	}

	public String getName() 
	{	return name;}

	public String getUsername() 
	{	return username;}

	public String getPassword() 
	{	return password;}

	public String getCredit() 
	{	return credit;}
	
	@Override
	public String toString()
	{	return String.format("%s\n%s\n%s", getName(), getUsername(), getCredit());}
}
