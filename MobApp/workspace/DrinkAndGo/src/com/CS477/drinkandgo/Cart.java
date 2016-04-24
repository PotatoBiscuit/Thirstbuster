package com.CS477.drinkandgo;

import java.util.ArrayList;
import java.util.Collection;

import org.json.JSONException;
import org.json.JSONObject;

public class Cart extends ArrayList<Drink> 
{
	/**
	 * 
	 */
	private static final long serialVersionUID = 7085411106160924254L;
	
	public Cart()
	{	super();}
	
	public Cart(Collection<? extends Drink> drinks)
	{	super(drinks);}

	public float getTotal()
	{
		float total = 0;
		for(Drink drink : this)
			total += drink.getCost();
		return total;
	}
	
	public JSONObject toJSON(Venue venue) throws JSONException
	{
		JSONObject obj = new JSONObject();
		for(int i = 0, n = size(); i < n; ++i)
			obj.put("drink_name"+i, String.format("Venue: %s\nDrink: %s", 
					venue.getName(), get(i).getName()));
		return obj;
	}
}
