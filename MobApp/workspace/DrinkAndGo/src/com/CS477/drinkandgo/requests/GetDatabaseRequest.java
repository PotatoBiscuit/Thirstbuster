package com.CS477.drinkandgo.requests;

import org.json.JSONObject;

import android.content.Context;

import com.CS477.drinkandgo.activities.DrinkAndGoActivity;
import com.CS477.drinkandgo.listeners.DrinkAndGoErrorListener;
import com.android.volley.Response.Listener;
import com.android.volley.toolbox.JsonObjectRequest;

public class GetDatabaseRequest extends JsonObjectRequest 
{
	public GetDatabaseRequest(Context context, Listener<JSONObject> listener) 
	{
		super(Method.GET, DrinkAndGoActivity.DATABASE_URL, 
		new JSONObject(), listener, new DrinkAndGoErrorListener(context));
	}
}
