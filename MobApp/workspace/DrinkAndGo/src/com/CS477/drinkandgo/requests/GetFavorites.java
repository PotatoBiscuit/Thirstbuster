package com.CS477.drinkandgo.requests;

import java.util.HashMap;

import android.content.Context;

import com.CS477.drinkandgo.Customer;
import com.CS477.drinkandgo.activities.DrinkAndGoActivity;
import com.CS477.drinkandgo.listeners.DrinkAndGoErrorListener;
import com.android.volley.Response.Listener;
import com.android.volley.toolbox.StringRequest;

public class GetFavorites extends StringRequest 
{
	private final HashMap<String, String> params;
	
	public GetFavorites(Context context, Customer customer, Listener<String> listener) 
	{
		super(Method.POST, DrinkAndGoActivity.FAVORITES_URL, 
			listener, new DrinkAndGoErrorListener(context));
		
		params = new HashMap<String, String>();
		params.put("id", customer.getId());
	}
	
	@Override
	public HashMap<String, String> getParams()
	{	return params;}
}
