package com.CS477.drinkandgo.requests;

import java.util.HashMap;

import android.content.Context;

import com.CS477.drinkandgo.Cart;
import com.CS477.drinkandgo.Customer;
import com.CS477.drinkandgo.Venue;
import com.CS477.drinkandgo.activities.DrinkAndGoActivity;
import com.CS477.drinkandgo.listeners.DrinkAndGoErrorListener;
import com.android.volley.Response.Listener;
import com.android.volley.toolbox.StringRequest;

public class OrderDrinksRequest extends StringRequest 
{
	private final HashMap<String, String> params;
	
	public OrderDrinksRequest(Context context, Cart cart, Customer customer, 
			String tableNumber, Venue venue, Listener<String> listener) 
	{
		super(Method.POST, DrinkAndGoActivity.ORDER_URL, 
		listener, new DrinkAndGoErrorListener(context));
		
		params = new HashMap<String, String>();
		params.put("user_id", customer.getId());
		params.put("venue_id", venue.getId());
		
		if(tableNumber != null)
			params.put("table_num", tableNumber);
		
		for(int i = 0, n = cart.size(); i < n; ++i)
			params.put("drinks"+i, cart.get(i).getId());
	}

	@Override
	public HashMap<String, String> getParams()
	{	return params;}
}
