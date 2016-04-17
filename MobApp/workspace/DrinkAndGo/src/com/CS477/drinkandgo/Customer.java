package com.CS477.drinkandgo;

import org.json.JSONException;
import org.json.JSONObject;

public class Customer 
{
	private final String name, username, password, credit;
	private String id;
	
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
	
	public void setId(String id)
	{	this.id = id;}
	
	public String getId()
	{	return id;}

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
