package com.CS477.drinkandgo.activities;

import java.util.ArrayList;

import android.os.Bundle;
import android.view.View;

import com.CS477.drinkandgo.Customer;
import com.CS477.drinkandgo.Drink;
import com.CS477.drinkandgo.R;
import com.CS477.drinkandgo.Venue;

public class MainActivity extends DrinkAndGoActivity 
{
    public MainActivity()
    {	super(R.layout.activity_main);}
    
    @Override
    protected void onCreate(Bundle bundle)
    {
    	super.onCreate(bundle);
		if(customers == null || venues == null || drinks == null)
		{
			customers = new ArrayList<Customer>();
			venues = new ArrayList<Venue>();
			drinks = new ArrayList<Drink>();
			
		}
		updateData();
    }
    
    public void gotoSignIn(View view)
	{	startActivity(SignInActivity.class);}

	public void gotoSignUp(View view)
	{	startActivity(SignUpActivity.class);}
}
