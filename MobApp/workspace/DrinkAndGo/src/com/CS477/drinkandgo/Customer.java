package com.CS477.drinkandgo;

public class Customer 
{
	private final String name, username, password;
	private float credit;
	
	public Customer(String name, String username, String password)
	{
		this.name = name;
		this.username = username;
		this.password = password;
	}

	public String getName() 
	{	return name;}

	public String getUsername() 
	{	return username;}

	public String getPassword() 
	{	return password;}

	public float getCredit() 
	{	return credit;}

	public void addCredit(float credit) 
	{	this.credit += credit;}
}
