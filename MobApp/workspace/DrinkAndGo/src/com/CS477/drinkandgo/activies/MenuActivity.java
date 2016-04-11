package com.CS477.drinkandgo.activies;

import android.os.Bundle;
import android.view.View;
import android.view.View.OnClickListener;
import android.widget.LinearLayout;
import android.widget.TextView;
import android.widget.Toast;

import com.CS477.drinkandgo.Cart;
import com.CS477.drinkandgo.Drink;
import com.CS477.drinkandgo.DrinkLayout;
import com.CS477.drinkandgo.R;
import com.CS477.drinkandgo.Venue;

public class MenuActivity extends DrinkAndGoActivity 
{
	public final Cart cart;
	
	private Venue venue;
	
	public MenuActivity()
	{	
		super(R.layout.activity_menu, VenueSearchActivity.class);
		cart = new Cart();
	}
	
	@Override
	protected void onCreate(Bundle bundle)
	{
		super.onCreate(bundle);

		venue = (Venue) getIntent().getSerializableExtra("Venue");
		
		TextView text = (TextView) findViewById(R.id.title_text);
		text.setText(String.format("%s's Menu", venue.getName()));
		
		LinearLayout layout = (LinearLayout) findViewById(R.id.menu_list);
		for(Drink drink : venue.getMenu())
			layout.addView(new DrinkLayout(this, drink, new AddDrink(drink)));
	}
	
	public void gotoCart(View view)
	{	
		if(cart.size() == 0)
			Toast.makeText(this, "Must have items in cart", Toast.LENGTH_SHORT).show();
		else
			startActivity(CartActivity.class, venue, cart);
	}
	
	private class AddDrink implements OnClickListener
	{
		private final Drink drink;
		
		public AddDrink(Drink drink)
		{	this.drink = drink;}

		@Override
		public void onClick(View v) 
		{	
			cart.add(drink);
			TextView cartText = (TextView) findViewById(R.id.cart);
			cartText.setText(String.format("Cart (%d)", cart.size()));
		}
	}
}