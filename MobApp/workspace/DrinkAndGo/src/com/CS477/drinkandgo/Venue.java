package com.CS477.drinkandgo;

import java.io.Serializable;
import java.util.ArrayList;
import java.util.Locale;

import org.json.JSONException;
import org.json.JSONObject;

import android.annotation.SuppressLint;

import com.CS477.drinkandgo.activies.DrinkAndGoActivity;

public class Venue implements Serializable
{
	/**
	 * 
	 */
	private static final long serialVersionUID = -2313617514560371505L;
	public static final Locale locale = Locale.getDefault();
	
	private final String id, name, street, zipCode, city, state;
	
	private float credit;
	
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

	public float getCredit() 
	{	return credit;}

	public void addCredit(float credit) 
	{	this.credit += credit;}
	
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
	
	@SuppressLint("DefaultLocale")
	public boolean inSearch(String value)
	{
		return street.toLowerCase(locale).indexOf(value.toLowerCase()) != -1 ||
			state.toLowerCase(locale).indexOf(value.toLowerCase()) != -1 ||
			name.toLowerCase(locale).indexOf(value.toLowerCase()) != -1 ||
			city.toLowerCase(locale).indexOf(value.toLowerCase()) != -1 ||
			zipCode.toLowerCase(locale).indexOf(value.toLowerCase()) != -1;
	}
	
	@Override
	public String toString()
	{	return String.format("%s\n%s", getName(), getAddress());}
}
