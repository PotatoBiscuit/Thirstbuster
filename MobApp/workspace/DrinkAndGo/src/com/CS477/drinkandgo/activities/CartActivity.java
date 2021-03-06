package com.CS477.drinkandgo.activities;

import java.io.Serializable;
import java.util.Collection;
import java.util.HashMap;

import org.json.JSONException;
import org.json.JSONObject;

import android.content.Intent;
import android.content.SharedPreferences.Editor;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.LinearLayout;
import android.widget.TextView;
import android.widget.Toast;

import com.CS477.drinkandgo.Cart;
import com.CS477.drinkandgo.Drink;
import com.CS477.drinkandgo.DrinkLayout;
import com.CS477.drinkandgo.R;
import com.CS477.drinkandgo.Venue;
import com.CS477.drinkandgo.requests.OrderDrinksRequest;
import com.android.volley.Response.Listener;
import com.android.volley.toolbox.Volley;

public class CartActivity extends DrinkAndGoActivity 
{
	private Venue venue;
	private Cart cart;
	
	public CartActivity()
	{	super(R.layout.activity_cart, MenuActivity.class);}
	
	@Override
	protected void onCreate(Bundle savedInstanceState) 
	{
		super.onCreate(savedInstanceState);
		
		Intent intent = getIntent();
		cart = new Cart((Collection<? extends Drink>) 
				intent.getSerializableExtra("Cart"));
		
		venue = (Venue) intent.getSerializableExtra("Venue");
		
		findViewById(R.id.table_num_view).clearFocus();
		
		LinearLayout layout = (LinearLayout) findViewById(R.id.cartList);
		for(Drink drink : cart)
			layout.addView(new DrinkLayout(this, drink));
		
		TextView total = (TextView) findViewById(R.id.total);
		total.setText(String.format("Total $%2.2f", cart.getTotal()));
	}
	
	@Override
	public void goBack(View view)
	{	startActivity(MenuActivity.class, venue);}
	
	public void setService(View view)
	{
		TextView tabNum = (TextView) findViewById(R.id.table_num_view);
		switch(view.getId())
		{
			case R.id.self_service_view:
				tabNum.setVisibility(View.GONE);
				break;
			case R.id.table_service_view:
				tabNum.setVisibility(View.VISIBLE);
				tabNum.setText("");
				break;
		}
	}
	
	public void orderDrinks(View view)
	{
		TextView text = (TextView) findViewById(R.id.table_num_view);
		
		Volley.newRequestQueue(this).add(new OrderDrinksRequest(this, cart, 
		getCustomer(), text.getVisibility() == View.VISIBLE ? text.getText().toString() : null, 
		venue, new OrderListener()));
	}
	
	private class OrderListener implements Listener<String>
	{
		@Override
		public void onResponse(String str) 
		{
			try
			{
				JSONObject obj = new JSONObject(str);
				Log.i("Message", obj.toString());
				if(obj.getBoolean("success"))
				{
					Toast.makeText(CartActivity.this, obj.getString
					("message"), Toast.LENGTH_LONG).show();
					
					Editor editor = getEditor();
					editor.putString("favorites", cart.toJSON(venue).toString());
					editor.apply();
					
					HashMap<String, Serializable> map = new HashMap<String, Serializable>();
					map.put("Order", obj.getInt("order_num"));
					map.put("Table", obj.getInt("table"));
					map.put("Venue", venue);
					startActivity(OrderActivity.class, map);
				}
				else
				{
					Toast.makeText(CartActivity.this, "Failed to place order", 
					Toast.LENGTH_LONG).show();
				}
			}
			catch(JSONException j)
			{	
				String message = j.getLocalizedMessage();
				Toast.makeText(CartActivity.this, message, Toast.LENGTH_LONG).show();
				Log.e("JSON Error", message);
				Log.e("Message", str);
			}
		}	
	}
}
