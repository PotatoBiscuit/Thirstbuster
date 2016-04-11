package com.CS477.drinkandgo.activies;

import android.os.Bundle;
import android.widget.LinearLayout;
import android.widget.TextView;

import com.CS477.drinkandgo.Drink;
import com.CS477.drinkandgo.DrinkLayout;
import com.CS477.drinkandgo.R;
import com.CS477.drinkandgo.Venue;

public class MenuActivity extends DrinkAndGoActivity 
{
	private Venue venue;
	
	public MenuActivity()
	{	super(R.layout.activity_menu, VenueSearchActivity.class);}
	
	@Override
	protected void onCreate(Bundle bundle)
	{
		super.onCreate(bundle);

		venue = (Venue) getIntent().getSerializableExtra("Venue");
		
		TextView text = (TextView) findViewById(R.id.title_text);
		text.setText(String.format("%s's Menu", venue.getName()));
		
		LinearLayout layout = (LinearLayout) findViewById(R.id.menu_list);
		for(Drink drink : venue.getMenu())
			layout.addView(new DrinkLayout(this, drink));
	}
}
