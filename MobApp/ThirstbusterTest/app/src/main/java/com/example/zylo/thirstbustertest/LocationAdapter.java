package com.example.zylo.thirstbustertest;

import android.content.Context;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ArrayAdapter;
import android.widget.LinearLayout;
import android.widget.TextView;

import java.util.ArrayList;

/**
 * Created by Zylo on 4/15/2016.
 */
public class LocationAdapter extends ArrayAdapter<Location> {

        private TextView price;
        private TextView name;
        // private List<Drink> MessageList = new ArrayList<Drink>();
        private LinearLayout layout;

        public LocationAdapter(Context context, ArrayList<Location> places) {
            super(context,0,places);
        }

        @Override
        public View getView(int position, View convertView, ViewGroup parent) {

            // Get the data item for this position this comes from the drinks array list we passed in from above.
            // get item grabs the next item from that list
            Location LocA = getItem(position);

            // Check if an existing view is being reused, otherwise inflate the view
            if (convertView == null) {
                convertView = LayoutInflater.from(getContext()).inflate(R.layout.locationlayout, parent, false);
            }

            // Lookup view for data population
            TextView locationName = (TextView) convertView.findViewById(R.id.locationname);

            // Populate the data into the template view using the data object
            locationName.setText(LocA.getName());

            // Return the completed view to render on screen
            return convertView;
        }

    }
