package com.CS477.drinkandgo.activities;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import android.os.Bundle;
import android.util.Log;
import android.widget.LinearLayout;

import com.CS477.drinkandgo.Drink;
import com.CS477.drinkandgo.DrinkLayout;
import com.CS477.drinkandgo.R;
import com.CS477.drinkandgo.requests.GetFavorites;
import com.android.volley.Response.Listener;
import com.android.volley.toolbox.Volley;

public class FavoritesActivity extends DrinkAndGoActivity 
{
	public FavoritesActivity() 
	{	super(R.layout.activity_favorites, VenueSearchActivity.class);}
	
	@Override
	protected void onCreate(Bundle bundle)
	{
		super.onCreate(bundle);
		
		Volley.newRequestQueue(this).add(new GetFavorites(this, getCustomer(),
											new FavoritesListener()));
	}
	
	private class FavoritesListener implements Listener<String>
	{
		@Override
		public void onResponse(String str) 
		{
			try
			{
				JSONObject obj = new JSONObject(str);
				LinearLayout layout = (LinearLayout) findViewById(R.id.favorites_list);
				JSONArray array = obj.getJSONArray("drinks");
				for(int i = 0, n = array.length(); i < n; ++i)
				{
					layout.addView(new DrinkLayout(FavoritesActivity.this, 
							new Drink(array.getJSONObject(i))));
				}
			}
			catch(JSONException j)
			{	Log.e("Favorites", j.getLocalizedMessage());}
		}	
	}
}
