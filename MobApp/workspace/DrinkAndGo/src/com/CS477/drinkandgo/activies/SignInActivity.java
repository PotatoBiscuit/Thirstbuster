package com.CS477.drinkandgo.activies;

import android.content.SharedPreferences;
import android.content.SharedPreferences.Editor;
import android.os.Bundle;
import android.view.View;
import android.widget.TextView;
import android.widget.Toast;

import com.CS477.drinkandgo.R;

public class SignInActivity extends DrinkAndGoActivity 
{
	public SignInActivity()
	{	super(R.layout.activity_sign_in, MainActivity.class);}
	
	@Override
	protected void onCreate(Bundle bundle)
	{
		super.onCreate(bundle);
		
		SharedPreferences prefs = getPrefs();
		
		TextView username = (TextView) findViewById(R.id.username_view);
		username.setText(prefs.getString("username", ""));
		
		TextView password = (TextView) findViewById(R.id.password_view);
		password.setText(prefs.getString("password", ""));
	}
	
	public void performSignIn(View view)
	{
		Editor editor = getEditor();
		
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
