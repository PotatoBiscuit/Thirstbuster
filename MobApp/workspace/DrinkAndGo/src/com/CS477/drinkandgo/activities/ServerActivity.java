package com.CS477.drinkandgo.activities;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import android.os.Bundle;
import android.util.Log;
import android.widget.LinearLayout;

import com.CS477.drinkandgo.R;
import com.CS477.drinkandgo.Tab;
import com.CS477.drinkandgo.TabLayout;
import com.CS477.drinkandgo.Venue;
import com.CS477.drinkandgo.requests.GetDrinksRequest;
import com.android.volley.Response.Listener;
import com.android.volley.toolbox.Volley;

public class ServerActivity extends DrinkAndGoActivity 
{
	private LinearLayout layout;
	
	public ServerActivity()
	{	super(R.layout.activity_server, MainActivity.class);}
	
	@Override
	protected void onCreate(Bundle bundle)
	{
		super.onCreate(bundle);
	
		layout = (LinearLayout) findViewById(R.id.drinkList);
		
		Volley.newRequestQueue(this).add(new GetDrinksRequest(this, 
		(Venue) getIntent().getSerializableExtra("Venue"), new DrinksListener()));
	}
	
	private class DrinksListener implements Listener<String>
	{
		@Override
		public void onResponse(String str) 
		{
			try
			{
				JSONObject obj = new JSONObject(str);
				JSONArray tabs = obj.getJSONArray("tabs");
				for(int i = 0, n = tabs.length(); i < n; ++i)
				{
					TabLayout drink = new TabLayout(ServerActivity.this, 
											new Tab(tabs.getJSONObject(i)));
					drink.setOnClickListener(null);
					layout.addView(drink);
				}
			}
			catch(JSONException j)
			{	Log.e("ServerActivity", j.getLocalizedMessage());}
		}
	}
}
