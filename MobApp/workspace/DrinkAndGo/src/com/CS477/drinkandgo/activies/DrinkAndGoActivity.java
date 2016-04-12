package com.CS477.drinkandgo.activies;

import java.io.Serializable;

import android.app.Activity;
import android.content.Intent;
import android.content.SharedPreferences;
import android.content.SharedPreferences.Editor;
import android.os.Bundle;
import android.view.View;
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
	
	public void goBack(View view)
	{	startActivity(prevActivity);}
	
	public static LayoutParams makeDefaultParams()
	{	return new LayoutParams(LayoutParams.MATCH_PARENT, LayoutParams.MATCH_PARENT);}
}
