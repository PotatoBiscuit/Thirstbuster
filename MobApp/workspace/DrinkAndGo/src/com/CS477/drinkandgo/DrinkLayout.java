package com.CS477.drinkandgo;

import android.content.Context;
import android.graphics.Typeface;
import android.widget.LinearLayout;
import android.widget.TextView;

public class DrinkLayout extends LinearLayout
{
	private final Drink drink;
	
	public DrinkLayout(Context context, Drink drink)
	{	this(context, drink, null);}
	
	public DrinkLayout(Context context, Drink drink, OnClickListener listener) 
	{	
		super(context);
		
		this.drink = drink;
		int pad = context.getResources().getDimensionPixelOffset(R.dimen.button_margin);
		this.setPadding(pad, pad, pad, pad);
		
		if(listener != null)
		{
			this.setOnClickListener(listener);
			this.setBackground(context.getDrawable(android.R.drawable.btn_default));
		}
		
		TextView name = new TextView(context);
		name.setText(drink.getName());
		name.setId(1);
		name.setTypeface(null, Typeface.BOLD);
		
		TextView desc = new TextView(context);
		desc.setText(drink.getDescription());
		desc.setId(2);	
		
		TextView cost = new TextView(context);
		cost.setText(String.format("$%2.2f", drink.getCost()));
		cost.setId(3);
		cost.setTypeface(null, Typeface.ITALIC);
		
		LinearLayout layout = new LinearLayout(context);
		layout.setOrientation(VERTICAL);
		layout.setPadding(pad, 0, pad, 0);
		layout.addView(name);
		layout.addView(cost);
		
		addView(layout);
		addView(desc);
	}
	
	public boolean inSearch(String value)
	{	return drink.inSearch(value);}
}
