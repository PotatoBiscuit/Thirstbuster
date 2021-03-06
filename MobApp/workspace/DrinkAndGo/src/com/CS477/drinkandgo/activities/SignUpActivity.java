package com.CS477.drinkandgo.activities;

import org.json.JSONException;
import org.json.JSONObject;

import android.content.SharedPreferences.Editor;
import android.util.Log;
import android.view.View;
import android.widget.TextView;
import android.widget.Toast;

import com.CS477.drinkandgo.Customer;
import com.CS477.drinkandgo.R;
import com.CS477.drinkandgo.requests.SignUpRequest;
import com.android.volley.Response.Listener;
import com.android.volley.toolbox.Volley;


public class SignUpActivity extends DrinkAndGoActivity 
{
	public SignUpActivity()
	{	super(R.layout.activity_sign_up, MainActivity.class);}
	
	public void performSignUp(View view)
	{
		TextView name = get(R.id.name_view),
				username = get(R.id.username_view),
				cardNum = get(R.id.card_number_view),
				password = get(R.id.password_view),
				password2 = get(R.id.password_view2);
		
		if(username.getText().toString().isEmpty()
		|| cardNum.getText().toString().isEmpty() || password.getText().toString().isEmpty()
		|| password2.getText().toString().isEmpty() || name.getText().toString().isEmpty())
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
		else if(uniqueUsername(username.getText().toString()))
		{
			Volley.newRequestQueue(this).add(new SignUpRequest(this,
			new Customer(name.getText().toString(),
			username.getText().toString(), password.getText().toString(),
			cardNum.getText().toString()), new SignUpListener()));
		}
		else 
		{
			Toast.makeText(this, getString(R.string.username_not_unique), 
			Toast.LENGTH_SHORT).show();
			username.setText("");
		}
	}
	
	private TextView get(int contentID)
	{	return (TextView) findViewById(contentID);}
	
	@Override
	public void onUpdateDatabaseComplete()
	{	startActivity(VenueSearchActivity.class);}
	
	private class SignUpListener implements Listener<String>
	{
		@Override
		public void onResponse(String response) 
		{
			try
			{
				JSONObject obj = new JSONObject(response);
				if(obj.getBoolean("success"))
				{
					Toast.makeText(SignUpActivity.this, "Sign Up Sucessful", 
							Toast.LENGTH_SHORT).show();
					Editor editor = getEditor();
					editor.putString("username", obj.getString("username"));
					editor.putString("password", obj.getString("password"));
					editor.apply();
					updateData();
				}
				else
				{
					Toast.makeText(SignUpActivity.this, obj.getString("message"), 
							Toast.LENGTH_SHORT).show();
				}
			}
			catch(JSONException j)
			{	Log.e("Sign Up Error", j.getLocalizedMessage());}
		}
	}
}
