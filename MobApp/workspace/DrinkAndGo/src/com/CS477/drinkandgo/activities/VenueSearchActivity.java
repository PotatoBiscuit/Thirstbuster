package com.CS477.drinkandgo.activities;

import android.os.Bundle;
import android.text.Editable;
import android.text.TextWatcher;
import android.view.View;
import android.view.View.OnClickListener;
import android.widget.EditText;
import android.widget.LinearLayout;

import com.CS477.drinkandgo.R;
import com.CS477.drinkandgo.Venue;
import com.CS477.drinkandgo.VenueLayout;

public class VenueSearchActivity extends DrinkAndGoActivity 
{	
	public VenueSearchActivity()
	{	super(R.layout.activity_venue_search, MainActivity.class);}
	
	@Override
	protected void onCreate(Bundle savedInstanceState) 
	{
		super.onCreate(savedInstanceState);
		
		EditText text = (EditText) findViewById(R.id.search_value);
		text.addTextChangedListener(new VenueTextWatcher());
		text.clearFocus();
		
		LinearLayout venueList = (LinearLayout) findViewById(R.id.venue_list);
		for(Venue venue : venues)
			venueList.addView(new VenueLayout(this, venue, new GotoMenu(venue)));
	}
	
	public void gotoFavorites(View view)
	{	startActivity(FavoritesActivity.class);}
	
	private class VenueTextWatcher implements TextWatcher
	{
		@Override
		public void beforeTextChanged(CharSequence s, int start, int count, int after) 
		{}

		@Override
		public void onTextChanged(CharSequence s, int start, int before, int count) 
		{}

		@Override
		public void afterTextChanged(Editable s) 
		{
			LinearLayout venueList = (LinearLayout) findViewById(R.id.venue_list);
			boolean showSelect = false;
			for(int i = 0, n = venueList.getChildCount(); i < n; ++i)
			{
				VenueLayout layout = (VenueLayout) venueList.getChildAt(i);
				layout.setVisibility(layout.inSearch(s.toString()) ? View.VISIBLE : View.GONE);
				
				if(!showSelect)
					showSelect = layout.getVisibility() == View.VISIBLE;
			}
		}	
	}
	
	private class GotoMenu implements OnClickListener
	{
		private Venue venue;
		
		GotoMenu(Venue venue)
		{	this.venue = venue;}

		@Override
		public void onClick(View v) 
		{	VenueSearchActivity.this.startActivity(MenuActivity.class, venue);}
	}
}
