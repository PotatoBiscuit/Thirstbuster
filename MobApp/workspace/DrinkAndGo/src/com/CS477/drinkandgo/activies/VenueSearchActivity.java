package com.CS477.drinkandgo.activies;

import android.app.Activity;
import android.content.Context;
import android.os.Bundle;
import android.text.Editable;
import android.text.TextWatcher;
import android.widget.EditText;
import android.widget.LinearLayout;
import android.widget.RelativeLayout.LayoutParams;

import com.CS477.drinkandgo.Drink;
import com.CS477.drinkandgo.DrinkLayout;
import com.CS477.drinkandgo.R;
import com.CS477.drinkandgo.Venue;

public class VenueSearchActivity extends Activity 
{
	private static final Venue testVenues[] = 
	{
		new Venue("Bar", "86001", "Flagstaff", "AZ", 
			new Drink("Beer", "This is beer. Must be over 21 to order", 2), 
			new Drink("Coke", "This is a soda", 1), 
			new Drink("Water", "This is water", 0.5f))
	};
	
	@Override
	protected void onCreate(Bundle savedInstanceState) 
	{
		super.onCreate(savedInstanceState);
		setContentView(R.layout.activity_venue_search);
		
		EditText text = (EditText) findViewById(R.id.search_value);
		text.addTextChangedListener(new VenueTextWatcher());
		
		LinearLayout venueList = (LinearLayout) findViewById(R.id.venue_list);
	}
	
	private class VenueTextWatcher implements TextWatcher
	{
		@Override
		public void beforeTextChanged(CharSequence s, int start, int count, int after) 
		{
			
		}

		@Override
		public void onTextChanged(CharSequence s, int start, int before, int count) 
		{
			
		}

		@Override
		public void afterTextChanged(Editable s) 
		{
			
		}	
	}
}
