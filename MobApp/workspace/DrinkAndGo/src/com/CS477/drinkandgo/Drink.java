package com.CS477.drinkandgo;

import java.io.Serializable;

public class Drink implements Serializable
{
	/**
	 * 
	 */
	private static final long serialVersionUID = -1719323347471622832L;
	
	private final String name, description;
	private Venue venue;
	private final float cost;
	
	public Drink(String name, String description, float cost)
	{
		this.name = name;
		this.description = description;
		this.cost = cost;
	}

	public String getName() 
	{	return name;}

	public String getDescription() 
	{	return description;}

	public float getCost() 
	{	return cost;}

	public Venue getVenue() 
	{	return venue;}
	
	public void setVenue(Venue venue)
	{	this.venue = venue;}
}
