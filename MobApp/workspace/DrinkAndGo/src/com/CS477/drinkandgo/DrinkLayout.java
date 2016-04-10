package com.CS477.drinkandgo;

import android.content.Context;
import android.widget.RelativeLayout;
import android.widget.TextView;

public class DrinkLayout extends RelativeLayout
{
	public DrinkLayout(Context context, Drink drink, LayoutParams params) 
	{	
		super(context);
		
		TextView name = new TextView(context);
		name.setText(drink.getName());
		name.setId(1);
		
		TextView desc = new TextView(context);
		desc.setText(drink.getDescription());
		desc.setId(2);	
		
		TextView cost = new TextView(context);
		cost.setText(Float.toString(drink.getCost()));
		cost.setId(3);
		
		params.addRule(ALIGN_PARENT_TOP);
		params.addRule(ABOVE, 2);
		addView(name, params);
		
		params.addRule(ALIGN_PARENT_TOP, 0);
		params.addRule(ABOVE, 3);
		params.addRule(BELOW, 1);
		addView(desc, params);
		
		params.addRule(ABOVE, 0);
		params.addRule(BELOW, 2);
		addView(cost, params);
	}
}
