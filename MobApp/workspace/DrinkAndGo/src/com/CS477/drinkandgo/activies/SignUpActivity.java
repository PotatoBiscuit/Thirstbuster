package com.CS477.drinkandgo.activies;

import android.content.SharedPreferences.Editor;
import android.view.View;
import android.widget.TextView;
import android.widget.Toast;

import com.CS477.drinkandgo.R;


public class SignUpActivity extends DrinkAndGoActivity 
{
	public SignUpActivity()
	{	super(R.layout.activity_sign_up);}
	
	public void performSignUp(View view)
	{
		TextView username = get(R.id.name_view),
				email = get(R.id.email_view),
				cardNum = get(R.id.card_number_view),
				password = get(R.id.password_view),
				password2 = get(R.id.password_view2);
		
		if(username.getText().toString().isEmpty() || email.getText().toString().isEmpty()
		|| cardNum.getText().toString().isEmpty() || password.getText().toString().isEmpty()
		|| password2.getText().toString().isEmpty())
		{
			Toast.makeText(this, getString(R.string.input_error), 
			Toast.LENGTH_SHORT).show();
		}
		else if(!password.getText().toString().equals(password2.getText().toString()))
		{
			Toast.makeText(this, getString(R.string.password_error), 
								Toast.LENGTH_SHORT).show();
			password.setText("");
			password2.setText("");
		}
		else
		{	
			Editor editor = getPrefs();
			editor.putString("username", username.getText().toString());
			editor.putString("email", email.getText().toString());
			editor.putString("cardNum", cardNum.getText().toString());
			editor.putString("password", password.getText().toString());
			
			editor.apply();
			startActivity(VenueSearchActivity.class);
		}	
	}
	
	private TextView get(int contentID)
	{	return (TextView) findViewById(contentID);}
}