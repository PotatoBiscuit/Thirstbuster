package com.CS477.drinkandgo;

import android.content.SharedPreferences.Editor;
import android.view.View;
import android.widget.TextView;
import android.widget.Toast;

public class SignInActivity extends DrinkAndGoActivity 
{
	public SignInActivity()
	{	super(R.layout.activity_sign_in);}
	
	public void performSignIn(View view)
	{
		Editor editor = getPrefs();
		
		TextView username = (TextView) findViewById(R.id.username_view);
		TextView password = (TextView) findViewById(R.id.password_view);
		
		if(username.getText().toString().isEmpty() || password.getText().toString().isEmpty())
		{
			Toast.makeText(this, getString(R.string.input_error), 
			Toast.LENGTH_SHORT).show();
		}
		else
		{
			editor.putString("username", username.getText().toString());
			editor.putString("password", password.getText().toString());
			
			editor.apply();
			
			startActivity(VenueSearchActivity.class);
		}
	}
}