package com.CS477.drinkandgo.activies;

import android.app.Activity;
import android.content.Intent;
import android.content.SharedPreferences;
import android.content.SharedPreferences.Editor;
import android.os.Bundle;
import android.view.ViewGroup.LayoutParams;

import com.CS477.drinkandgo.Customer;

public abstract class DrinkAndGoActivity extends Activity 
{
	protected static final String PREF_NAME = "drinkAndGo_preferences.txt";
	
	/**
	 * Customer instance that represents this user.
	 */
	protected static Customer customer;
	
	private final int CONTENT_VIEW;
	
	protected DrinkAndGoActivity(int contentView)
	{	this.CONTENT_VIEW = contentView;}
	
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
	
	protected SharedPreferences getPrefs()
	{	return getSharedPreferences(PREF_NAME, 0);}
	
	protected Editor getEditor()
	{	return getPrefs().edit();}
	
	public static LayoutParams makeDefaultParams()
	{	return new LayoutParams(LayoutParams.MATCH_PARENT, LayoutParams.MATCH_PARENT);}
}
