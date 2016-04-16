package com.CS477.drinkandgo;

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
	
	public Customer(String values[])
	{	this(values[2], values[3], values[4], values[1]);}

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
