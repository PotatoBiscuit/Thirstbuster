package com.CS477.drinkandgo;

import android.content.Context;
import android.graphics.Typeface;
import android.widget.LinearLayout;
import android.widget.TextView;

public class DrinkLayout extends LinearLayout
{
	public DrinkLayout(Context context, Drink drink) 
	{	
		super(context);
		
		int pad = context.getResources().getDimensionPixelOffset(R.dimen.button_margin);
		this.setPadding(pad, pad, pad, pad);
		
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
}
