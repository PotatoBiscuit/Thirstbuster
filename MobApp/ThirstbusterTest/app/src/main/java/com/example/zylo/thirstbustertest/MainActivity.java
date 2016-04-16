package com.example.zylo.thirstbustertest;

import android.app.Activity;
import android.content.Intent;
import android.os.AsyncTask;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.ListView;
import android.widget.TextView;

import java.io.BufferedReader;
import java.io.IOException;
import java.io.InputStream;
import java.io.InputStreamReader;
import java.net.HttpURLConnection;
import java.net.MalformedURLException;
import java.net.ProtocolException;
import java.net.URL;
import java.util.ArrayList;

public class MainActivity extends Activity {

    private static final String DEBUG_TAG = "HttpExample";
    private EditText zipText;
    private TextView textView;
    private Button searchButton;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);

        zipText = (EditText) findViewById(R.id.zipcode);
        searchButton = (Button) findViewById(R.id.searchbutton);

        // Construct the data source
        final ArrayList<Location> locationarray = new ArrayList<Location>();

        // Create the adapter to convert the array to views
        LocationAdapter adapter = new LocationAdapter(this, locationarray);

        // Attach the adapter to a ListView
        ListView listView = (ListView) findViewById(R.id.listView);
        listView.setAdapter(adapter);

        //Drink drink1 = new Drink("The wild Goose", "$200");
        // drinkarray.add(drink1);

        Location L1 = new Location("6865", "Tony's Pizza");
        locationarray.add(L1);
        Location L2 = new Location("6865", "Lama Letuce");
        locationarray.add(L2);
        Location L3 = new Location("86001", "Some Sub");
        locationarray.add(L3);
        Location L4 = new Location("86001", "Drinks Please");
        locationarray.add(L4);
        Location L5 = new Location("12134", "Mama Mozorella");
        locationarray.add(L5);
        for (int i = 0; i < locationarray.size(); i++)
            System.out.println(locationarray.get(i).getName());

        searchButton.setOnClickListener(
                new View.OnClickListener() {
                    public void onClick(View view) {
                        String zip;
                        zip = zipText.getText().toString();
                        for (int i = 0; i < locationarray.size(); i++) {
                            String d = locationarray.get(i).getLocation();
                            System.out.println("Zip=" + zip + "" + locationarray.get(i).getName() + "=" + d + " I=" + i);
                            if (d.equals(zip)) {

                            } else {
                                locationarray.remove(i);
                                i--;
                            }

                        }
                    }
                });
    }


    public void toConfirmation(View view){
        Intent intent = new Intent(view.getContext(), Confirmation_Page.class);
        view.getContext().startActivity(intent);
        finish();
    }

    public void toOrderNumber(View view){
        Intent intent = new Intent(view.getContext(), OrderNumber.class);
        view.getContext().startActivity(intent);
        finish();
    }



}
