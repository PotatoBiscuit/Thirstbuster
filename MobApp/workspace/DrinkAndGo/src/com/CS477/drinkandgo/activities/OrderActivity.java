package com.CS477.drinkandgo.activities;

import java.util.HashMap;
import java.util.Random;

import org.json.JSONException;
import org.json.JSONObject;

import android.graphics.Color;
import android.os.Bundle;
import android.os.Handler;
import android.view.View;
import android.widget.TextView;

import com.CS477.drinkandgo.R;
import com.CS477.drinkandgo.Venue;
import com.CS477.drinkandgo.listeners.DrinkAndGoErrorListener;
import com.android.volley.Response.Listener;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;

public class OrderActivity extends DrinkAndGoActivity 
{
	private static final int delay = 5000;//in milliseconds
	
	private String status;
	private Integer orderNum;
	private Venue venue;
	
	private final Handler handler;
	
	public OrderActivity() 
	{	
		super(R.layout.activity_order);
		handler = new Handler();
	}

	@Override
	protected void onCreate(Bundle savedInstanceState) 
	{
		super.onCreate(savedInstanceState);
		
		View layout = findViewById(R.id.mainLayout);
		Random rnd = new Random(); 
		int color = Color.argb(255, rnd.nextInt(156)+100, 
				rnd.nextInt(156)+100, rnd.nextInt(156)+100);
		layout.setBackgroundColor(color);
		
		TextView order = (TextView) findViewById(R.id.order_number),
			venueView = (TextView) findViewById(R.id.venue),
			table = (TextView) findViewById(R.id.table_num),
			tableview = (TextView) findViewById(R.id.table_num_view);
		
		orderNum = (Integer) getIntent().getSerializableExtra("Order");
		order.setText(orderNum.toString());
		
		Integer tableNum = (Integer) getIntent().getSerializableExtra("Table");
		if(tableNum == null || tableNum == 0)
		{
			table.setVisibility(View.GONE);
			tableview.setVisibility(View.GONE);
		}
		else table.setText(tableNum.toString());
		
		venue = (Venue) getIntent().getSerializableExtra("Venue");
		venueView.setText(venue.getName());
		
		handler.postDelayed(new GetStatus(), delay);
	}
	
	@Override
	public void goBack(View view)
	{	startActivity(MainActivity.class);}
	
	private class GetStatus implements Runnable, Listener<String>
	{
		@Override
		public void run() 
		{	Volley.newRequestQueue(OrderActivity.this).add(new GetStatusRequest(this));}

		@Override
		public void onResponse(String str) 
		{
			try
			{
				JSONObject obj = new JSONObject(str);
				status = obj.getJSONObject("data").getString("status");
				((TextView) findViewById(R.id.status)).setText(status);
				if(status.equals("Complete"))
					findViewById(R.id.home_button).setVisibility(View.VISIBLE);
				else
					handler.postDelayed(this, delay);
			}
			catch(JSONException j)
			{}
		}	
	}
	
	private class GetStatusRequest extends StringRequest
	{
		private final HashMap<String, String> params;
		
		public GetStatusRequest(Listener<String> listener) 
		{
			super(Method.POST, STATUS_URL, listener, 
			new DrinkAndGoErrorListener(OrderActivity.this));
			
			params = new HashMap<String, String>();
			params.put("id", orderNum.toString());
			params.put("customer_id", getCustomer().getId());
			params.put("venue_id", venue.getId());
		}
		
		@Override
		public HashMap<String, String> getParams()
		{	return params;}
	}
}
