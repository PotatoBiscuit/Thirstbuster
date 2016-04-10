package com.CS477.drinkandgo;

import android.app.Activity;
import android.content.Intent;
import android.content.SharedPreferences;
import android.content.SharedPreferences.Editor;
import android.os.Bundle;

public abstract class DrinkAndGoActivity extends Activity 
{
	protected static final String PREF_NAME = "drinkAndGo_preferences.txt";
	
	private final int CONTENT_VIEW;
	
	DrinkAndGoActivity(int contentView)
	{	this.CONTENT_VIEW = contentView;}
	
	@Override
    protected void onCreate(Bundle savedInstanceState) 
    {
        super.onCreate(savedInstanceState);
        setContentView(CONTENT_VIEW);
    }
	
	public void startActivity(Class<?> cls)
	{	
		startActivity(new Intent(this, cls));
		finish();
	}
	
	public Editor getPrefs()
	{
		SharedPreferences prefs = getSharedPreferences(PREF_NAME, 0);
		return prefs.edit();
	}
}
