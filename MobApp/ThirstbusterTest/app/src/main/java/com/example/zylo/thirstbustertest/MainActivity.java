package com.example.zylo.thirstbustertest;

import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.widget.ListView;

import java.util.ArrayList;

public class MainActivity extends AppCompatActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);

        // Construct the data source
        ArrayList<Drink> drinkarray = new ArrayList<Drink>();

        // Create the adapter to convert the array to views
        DrinkAdapter adapter = new DrinkAdapter(this, drinkarray);

        // Attach the adapter to a ListView
        ListView listView = (ListView) findViewById(R.id.listView);
        listView.setAdapter(adapter);

        Drink drink1 = new Drink("The wild Goose", "$200");
        drinkarray.add(drink1);

    }
}
