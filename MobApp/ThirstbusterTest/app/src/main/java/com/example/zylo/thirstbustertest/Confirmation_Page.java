package com.example.zylo.thirstbustertest;

import android.app.Activity;
import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.ListView;

import java.util.ArrayList;

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
        Intent intent = new Intent(this, OrderNumber.class);
    }

}
