package com.example.zylo.thirstbustertest;

import android.app.Activity;
import android.content.Intent;
import android.graphics.Color;
import android.os.Bundle;
import android.view.View;
import android.widget.RelativeLayout;
import android.widget.TextView;

/**
 * Created by Zylo on 4/10/2016.
 */
public class OrderNumber extends Activity {


    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.ordernumber);

        // Get order number from saved preferences and display it
        User u = new User();
        // the order number
        TextView orderNum = (TextView)findViewById(R.id.number);
        // the promt saying "Your number is..."
        TextView prompt = (TextView)findViewById(R.id.ordernumbertext);
        // setting the order number to the saved number
        orderNum.setText(String.valueOf(u.getOrderNumber(this)));
        //get and set colors
        int color = u.getColor(this);
        RelativeLayout current = (RelativeLayout)findViewById(R.id.relativelayout);
        current.setBackgroundColor(color);

        // change text coloe based on back ground color
        // we breack color up into its rgb elements
        int[] rgb = {Color.red(color), Color.green(color), Color.blue(color)};
        for(int i=0;i<3;i++)
        {
            System.out.println("Slot "+i+" = "+rgb[i]);
        }
        // we use a match algorthim to test the colors brightness and set that to the variable brightness
       /* int brightness =
                (int)Math.sqrt(
                        rgb[0] * rgb[0] * .241 +
                                rgb[1] * rgb[1] * .691 +
                                rgb[2] * rgb[2] * .068);

        System.out.println("COLOR: " + color + ", BRIGHT: " + brightness);

        // color is dark
        if(brightness <= 40){
            orderNum.setTextColor(Color.WHITE);
            prompt.setTextColor(Color.WHITE);
        }
        // color is light
        else if (brightness >= 215){
            orderNum.setTextColor(Color.BLACK);
            prompt.setTextColor(Color.BLACK);
        }
        */
        for(int i=0;i<3;i++)
        {
            rgb[i]=256-rgb[i];
            System.out.println("Slot "+i+" = "+rgb[i]);
        }
        orderNum.setTextColor(Color.rgb(rgb[0],rgb[1],rgb[2]));

        /*
        if(u.getColor(this))
        orderNum.setTextColor();
        */
    }

    // function for the back button
    public void toVenue(View view){
        Intent intent = new Intent(view.getContext(), MainActivity.class);
        view.getContext().startActivity(intent);
        finish();
    }

}
