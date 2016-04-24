package com.CS477.drinkandgo;

import java.io.Serializable;
import java.util.Locale;

import org.json.JSONException;
import org.json.JSONObject;

public class Drink implements Serializable
{
	/**
	 * 
	 */
	private static final long serialVersionUID = -1719323347471622832L;
	
	private final String id, venueID, name, description;
	private final float cost;
	
	public Drink(String id, String venueID, String name, String description, float cost)
	{
		this.id = id;
		this.venueID = venueID;
		this.name = name;
		this.description = description;
		this.cost = cost;
	}
	
	public Drink(String id, String venueID, String name, String description, String cost)
	{	this(id, venueID, name, description, Float.parseFloat(cost));}
	
	public Drink(JSONObject obj) throws JSONException
	{	
		this(obj.getString("id"), obj.getString("venue_id"),obj.getString("name"),
		obj.getString("description"),obj.getString("cost"));
	}

	public String getName() 
	{	return name;}

	public String getDescription() 
	{	return description;}

	public float getCost() 
	{	return cost;}

	public String getId() 
	{	return id;}
	
	public String getVenueID()
	{	return venueID;}
	
	@Override
	public String toString()
	{
		return String.format(Locale.US, "Name: %s\nDescrp: %s\nCost: $%2.2f", getName(), 
				getDescription(), getCost());
	}
	
	public boolean inSearch(String value)
	{
		return name.toLowerCase(Locale.US).indexOf(value.toLowerCase(Locale.US)) != -1
		|| description.toLowerCase(Locale.US).indexOf(value.toLowerCase(Locale.US)) != -1;
	}
}
