package com.CS477.drinkandgo.activies;

import java.util.Collection;

import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.LinearLayout;
import android.widget.TextView;

import com.CS477.drinkandgo.Cart;
import com.CS477.drinkandgo.Drink;
import com.CS477.drinkandgo.DrinkLayout;
import com.CS477.drinkandgo.R;
import com.CS477.drinkandgo.Venue;

public class CartActivity extends DrinkAndGoActivity 
{
	private Venue venue;
	
	public CartActivity()
	{	super(R.layout.activity_cart, MenuActivity.class);}
	
	@Override
	protected void onCreate(Bundle savedInstanceState) 
	{
		super.onCreate(savedInstanceState);
		
		Intent intent = getIntent();
		Cart cart = new Cart((Collection<? extends Drink>) 
				intent.getSerializableExtra("Cart"));
		
		venue = (Venue) intent.getSerializableExtra("Venue");
		
		LinearLayout layout = (LinearLayout) findViewById(R.id.cartList);
		for(Drink drink : cart)
			layout.addView(new DrinkLayout(this, drink));
		
		TextView total = (TextView) findViewById(R.id.total);
		total.setText(String.format("Total $%2.2f", cart.getTotal()));
	}
	
	@Override
	public void goBack(View view)
	{	startActivity(MenuActivity.class, venue);}
}