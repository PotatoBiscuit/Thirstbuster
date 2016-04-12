package com.CS477.drinkandgo;

import java.util.ArrayList;
import java.util.Collection;

public class Cart extends ArrayList<Drink> 
{
	/**
	 * 
	 */
	private static final long serialVersionUID = 7085411106160924254L;
	
	public Cart()
	{	super();}
	
	public Cart(Collection<? extends Drink> drinks)
	{	super(drinks);}

	public float getTotal()
	{
		float total = 0;
		for(Drink drink : this)
			total += drink.getCost();
		return total;
	}
}
