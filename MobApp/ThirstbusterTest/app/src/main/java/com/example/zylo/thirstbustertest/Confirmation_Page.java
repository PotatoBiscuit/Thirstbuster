package com.example.zylo.thirstbustertest;

import android.app.Activity;
import android.content.Intent;
import android.graphics.Color;
import android.os.Bundle;
import android.view.View;
import android.widget.ListView;

import java.util.ArrayList;
import java.util.Random;

/**
 * Created by Zylo on 4/10/2016.
 */
public class Confirmation_Page extends Activity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.confirmationpage);

    }

    public void YesButtonPress(View view) {
        // we are moving to the order number page with thie confirmation we need to do a few thing before then

        // Send order to server

        // wait for confirmation

        // place error if one happened

        // Generate a random number
        Random rng = new Random();

        // save random generated number as our order number
        User U = new User();
        U.setOrderNumber(this, (10000+rng.nextInt(90000)));
        // Send order number to server

        // Generate colors and save them as well
        U.setColor(this, Color.rgb(rng.nextInt(256), rng.nextInt(256), rng.nextInt(256)));

        // Move to order number page
        Intent intent = new Intent(view.getContext(), OrderNumber.class);
        view.getContext().startActivity(intent);
    }

}
