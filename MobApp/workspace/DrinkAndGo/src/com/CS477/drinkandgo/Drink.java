package com.CS477.drinkandgo;

import java.io.Serializable;
import java.util.Locale;

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
	
	public Drink(String values[])
	{	this(values[0], values[1], values[3], values[5], values[2]);}

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
}
