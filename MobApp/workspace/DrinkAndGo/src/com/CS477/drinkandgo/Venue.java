package com.CS477.drinkandgo;

import java.util.ArrayList;

public class Venue 
{
	private final String name, zipCode, city, state;
	private final ArrayList<Drink> menu;
	
	private float credit;
	
	public Venue(String name, String zipCode, String city, String state, 
							Drink... drinks)
	{
		this.name = name;
		this.zipCode = zipCode;
		this.city = city;
		this.state = state;
		
		this.menu = new ArrayList<Drink>(drinks.length);
		for(Drink drink : drinks)
			menu.add(drink);
	}

	public String getZipCode() 
	{	return zipCode;}

	public String getState() 
	{	return state;}

	public ArrayList<Drink> getMenu() 
	{	return menu;}

	public String getCity() 
	{	return city;}

	public String getName() 
	{	return name;}

	public float getCredit() 
	{	return credit;}

	public void addCredit(float credit) 
	{	this.credit += credit;}
	
	public boolean inSearch(String value)
	{
		return state.indexOf(value) != -1 ||
				name.indexOf(value) != -1 ||
				city.indexOf(value) != -1 ||
				zipCode.indexOf(value) != -1;
	}
}