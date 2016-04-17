package com.CS477.drinkandgo.requests;

import java.util.HashMap;

import android.content.Context;

import com.CS477.drinkandgo.Customer;
import com.CS477.drinkandgo.activities.DrinkAndGoActivity;
import com.CS477.drinkandgo.listeners.DrinkAndGoErrorListener;
import com.android.volley.Response.Listener;
import com.android.volley.toolbox.StringRequest;

public class SignUpRequest extends StringRequest 
{	
	private HashMap<String, String> params;
	
	public SignUpRequest(Context context, Customer customer, Listener<String> listener) 
	{
		super(Method.POST, DrinkAndGoActivity.SIGN_UP_URL, 
		listener, new DrinkAndGoErrorListener(context));
		
		params = new HashMap<String, String>(5);
		params.put("name", customer.getName());
		params.put("username", customer.getUsername());
		params.put("password", customer.getPassword());
		params.put("credit", customer.getCredit());
	}

	@Override
	public HashMap<String, String> getParams()
	{	return params;}
}
