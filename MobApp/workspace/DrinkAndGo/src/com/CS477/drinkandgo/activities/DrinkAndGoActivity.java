package com.CS477.drinkandgo.activities;

import java.io.Serializable;
import java.util.ArrayList;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import android.app.Activity;
import android.content.Intent;
import android.content.SharedPreferences;
import android.content.SharedPreferences.Editor;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.view.ViewGroup.LayoutParams;

import com.CS477.drinkandgo.Customer;
import com.CS477.drinkandgo.Drink;
import com.CS477.drinkandgo.Venue;
import com.CS477.drinkandgo.requests.GetDatabaseRequest;
import com.android.volley.Response.Listener;
import com.android.volley.toolbox.Volley;

public abstract class DrinkAndGoActivity extends Activity 
{
	protected static final String PREF_NAME = "drinkAndGo_preferences.txt";
	
	public static final String DATABASE_URL = "http://thirstbuster.net23.net/database.php";
	public static final String ORDER_URL = "http://thirstbuster.net23.net/order_drinks.php";
	public static final String SIGN_UP_URL = "http://thirstbuster.net23.net/sign_up.php";
	
	public static ArrayList<Venue> venues;
	public static ArrayList<Customer> customers;
	public static ArrayList<Drink> drinks;
	
	private final int CONTENT_VIEW;
	private final Class<?> prevActivity;
	
	protected DrinkAndGoActivity(int contentView)
	{	this(contentView, null);}
	
	protected DrinkAndGoActivity(int contentView, Class<?> cls)
	{	
		this.CONTENT_VIEW = contentView;
		prevActivity = cls;
	}
	
	@Override
    protected void onCreate(Bundle savedInstanceState) 
    {
        super.onCreate(savedInstanceState);
        setContentView(CONTENT_VIEW);
    }
	
	protected void startActivity(Class<?> cls)
	{
		startActivity(new Intent(this, cls));
		finish();
	}
	
	protected void startActivity(Class<?> cls, Serializable... objs)
	{
		Intent intent = new Intent(this, cls);
		for(Serializable obj : objs)
			intent.putExtra(obj.getClass().getSimpleName(), obj);
		startActivity(intent);
		finish();
	}
	
	protected SharedPreferences getPrefs()
	{	return getSharedPreferences(PREF_NAME, 0);}
	
	protected Editor getEditor()
	{	return getPrefs().edit();}
	
	protected void updateData()
	{	
		customers.clear();
		venues.clear();
		drinks.clear();
		Volley.newRequestQueue(this).add(new GetDatabaseRequest(this, listener));
	}
	
	protected boolean validCustomer(String username, String password)
	{
		for(Customer customer : customers)
		{
			if(username.equals(customer.getUsername()) &&
			password.equals(customer.getPassword()))
			{return true;}
		}
		return false;
	}
	
	protected boolean uniqueUsername(String username)
	{
		for(Customer customer : customers)
		{
			if(username.equals(customer.getUsername()))
			{return false;}
		}
		return true;
	}
	
	protected Customer getCustomer()
	{
		SharedPreferences prefs = getPrefs();
		String username = prefs.getString("username", "");
		String password = prefs.getString("password", "");
		for(Customer customer : customers)
		{
			if(username.equals(customer.getUsername()) &&
			password.equals(customer.getPassword()))
			{	return customer;}
		}
		return null;
	}
	
	public void goBack(View view)
	{	startActivity(prevActivity);}

	public static LayoutParams makeDefaultParams()
	{	return new LayoutParams(LayoutParams.MATCH_PARENT, LayoutParams.MATCH_PARENT);}
	
	private final GetDatabaseListener listener = new GetDatabaseListener();
	private class GetDatabaseListener implements Listener<JSONObject> 
	{
		@Override
		public void onResponse(JSONObject obj) 
		{
			try
			{
				//get customers
				JSONArray array = obj.getJSONArray("customers").getJSONArray(0);
				for(int i = 0, n = array.length(); i < n; ++i)
					customers.add(new Customer(array.getJSONObject(i)));
				
				//get venues
				array = obj.getJSONArray("venues").getJSONArray(0);
				for(int i = 0, n = array.length(); i < n; ++i)
					venues.add(new Venue(array.getJSONObject(i)));
				
				//get drinks
				array = obj.getJSONArray("drinks").getJSONArray(0);
				for(int i = 0, n = array.length(); i < n; ++i)
					drinks.add(new Drink(array.getJSONObject(i)));
				
				Log.i("Customers", customers.toString());
				Log.i("Venues", venues.toString());
				Log.i("Drinks", drinks.toString());
			}
			catch(JSONException e)
			{	Log.e("JSON Error", e.getLocalizedMessage());}
		}

	}
}
