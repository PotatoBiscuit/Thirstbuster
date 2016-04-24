package com.CS477.drinkandgo.requests;

import java.util.HashMap;

import android.content.Context;

import com.CS477.drinkandgo.Venue;
import com.CS477.drinkandgo.activities.DrinkAndGoActivity;
import com.CS477.drinkandgo.listeners.DrinkAndGoErrorListener;
import com.android.volley.Response.Listener;
import com.android.volley.toolbox.StringRequest;

public class GetDrinksRequest extends StringRequest 
{
	private final HashMap<String, String> params;
	
	public GetDrinksRequest(Context context, Venue venue, Listener<String> listener) 
	{
		super(Method.POST, DrinkAndGoActivity.DRINKS_URL, listener, 
				new DrinkAndGoErrorListener(context));
		
		params = new HashMap<String, String>();
		params.put("venue", venue.getId());
	}
	
	@Override
	public HashMap<String, String> getParams()
	{	return params;}
}
