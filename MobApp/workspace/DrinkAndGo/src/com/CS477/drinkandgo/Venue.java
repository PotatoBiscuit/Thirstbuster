package com.CS477.drinkandgo;

import java.io.Serializable;
import java.util.ArrayList;
import java.util.Locale;

public class Venue implements Serializable
{
	/**
	 * 
	 */
	private static final long serialVersionUID = -2313617514560371505L;
	
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
		{
			drink.setVenue(this);
			menu.add(drink);
		}
	}
	
	public String getAddress()
	{	return String.format("%s, %s, %s", getCity(), getState(), getZipCode());}

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
		return state.toLowerCase(Locale.US).indexOf(value.toLowerCase()) != -1 ||
			name.toLowerCase(Locale.US).indexOf(value.toLowerCase()) != -1 ||
			city.toLowerCase(Locale.US).indexOf(value.toLowerCase()) != -1 ||
			zipCode.toLowerCase(Locale.US).indexOf(value.toLowerCase()) != -1;
	}
}
