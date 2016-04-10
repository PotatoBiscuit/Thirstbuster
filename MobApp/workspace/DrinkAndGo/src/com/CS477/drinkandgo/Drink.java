package com.CS477.drinkandgo;

public class Drink 
{
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
