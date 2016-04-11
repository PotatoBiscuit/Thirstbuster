package com.example.zylo.thirstbustertest;

import android.content.Context;
import android.graphics.Bitmap;
import android.graphics.BitmapFactory;
import android.view.Gravity;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ArrayAdapter;
import android.widget.ImageView;
import android.widget.LinearLayout;
import android.widget.TextView;

import java.util.ArrayList;
import java.util.List;

/**
 * Created by Zylo on 2/19/2016.
 */

public class DrinkAdapter extends ArrayAdapter<Drink> {

    private TextView price;
    private TextView name;
   // private List<Drink> MessageList = new ArrayList<Drink>();
    private LinearLayout layout;

    public DrinkAdapter(Context context, ArrayList<Drink> drinks) {
        super(context,0,drinks);
    }

    @Override
    public View getView(int position, View convertView, ViewGroup parent) {

        // Get the data item for this position this comes from the drinks array list we passed in from above.
        // get item grabs the next item from that list
        Drink drinkA = getItem(position);

        // Check if an existing view is being reused, otherwise inflate the view
        if (convertView == null) {
            convertView = LayoutInflater.from(getContext()).inflate(R.layout.drinklayout, parent, false);
        }

        // Lookup view for data population
        TextView drinkName = (TextView) convertView.findViewById(R.id.DrinkName);
        TextView drinkPrice = (TextView) convertView.findViewById(R.id.DrinkPrice);

        // Populate the data into the template view using the data object
        drinkName.setText(drinkA.getName());
        drinkPrice.setText(drinkA.getPrice());

        // Return the completed view to render on screen
        return convertView;
    }

}
