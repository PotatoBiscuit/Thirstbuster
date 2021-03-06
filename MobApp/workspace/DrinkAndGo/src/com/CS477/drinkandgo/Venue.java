package com.CS477.drinkandgo;

import java.io.Serializable;
import java.util.ArrayList;
import java.util.Locale;

import org.json.JSONException;
import org.json.JSONObject;

import com.CS477.drinkandgo.activities.DrinkAndGoActivity;

public class Venue implements Serializable
{
	/**
	 * 
	 */
	private static final long serialVersionUID = -2313617514560371505L;
	
	private final String id, name, street, zipCode, city, state;
	private String credit, loginName, password;
	
	public Venue(String id, String name, String street, String city, 
			String state, String zipCode)
	{
		this.id = id;
		this.name = name;
		this.street = street;
		this.zipCode = zipCode;
		this.city = city;
		this.state = state;
	}
	
	public Venue(JSONObject obj) throws JSONException
	{	
		this(obj.getString("id"), obj.getString("name"), obj.getString("address"),
			obj.getString("city"), obj.getString("state"), obj.getString("zip"));
		
		credit = obj.getString("credit");
		loginName = obj.getString("login_name");
		password = obj.getString("password");
	}
	
	public String getAddress()
	{	return String.format("%s\n%s, %s, %s", getStreet(), getCity(), getState(), getZipCode());}
	
	public String getStreet()
	{	return street;}

	public String getZipCode() 
	{	return zipCode;}

	public String getState() 
	{	return state;}

	public String getCity() 
	{	return city;}

	public String getName() 
	{	return name;}

	public String getCredit() 
	{	return credit;}
	
	public String getId()
	{	return id;}
	
	public String getLogin()
	{	return loginName;}
	
	public String getPassword()
	{	return password;}
	
	public ArrayList<Drink> getMenu()
	{
		ArrayList<Drink> rval = new ArrayList<Drink>();
		for(Drink drink : DrinkAndGoActivity.drinks)
		{
			if(id.equals(drink.getVenueID()))
				rval.add(drink);
		}
		return rval;
	}
	
	public boolean inSearch(String value)
	{
		return street.toLowerCase(Locale.US).indexOf(value.toLowerCase(Locale.US)) != -1 ||
			state.toLowerCase(Locale.US).indexOf(value.toLowerCase(Locale.US)) != -1 ||
			name.toLowerCase(Locale.US).indexOf(value.toLowerCase(Locale.US)) != -1 ||
			city.toLowerCase(Locale.US).indexOf(value.toLowerCase(Locale.US)) != -1 ||
			zipCode.toLowerCase(Locale.US).indexOf(value.toLowerCase(Locale.US)) != -1;
	}
	
	@Override
	public String toString()
	{	return String.format("%s\n%s", getName(), getAddress());}
}
