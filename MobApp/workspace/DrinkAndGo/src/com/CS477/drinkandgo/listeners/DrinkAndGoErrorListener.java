package com.CS477.drinkandgo.listeners;

import android.content.Context;
import android.widget.Toast;

import com.android.volley.Response.ErrorListener;
import com.android.volley.VolleyError;

public class DrinkAndGoErrorListener implements ErrorListener 
{
	private final Context context;
	
	public DrinkAndGoErrorListener(Context context) 
	{	this.context = context;}

	@Override
	public void onErrorResponse(VolleyError err) 
	{	Toast.makeText(context, err.getLocalizedMessage(), Toast.LENGTH_LONG).show();}
}
