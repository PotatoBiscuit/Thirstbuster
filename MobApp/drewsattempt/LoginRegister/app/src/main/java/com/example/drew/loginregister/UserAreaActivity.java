package com.example.drew.loginregister;

import android.content.Intent;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.widget.EditText;
import android.widget.TextView;

public class UserAreaActivity extends AppCompatActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_user_area);

        Intent intent = getIntent();

        //how to for int:
        int credit = intent.getIntExtra("credit", -1);

        //String credit = intent.getStringExtra("credit");
        String name = intent.getStringExtra("name");
        String username = intent.getStringExtra("username");
        String password = intent.getStringExtra("password");

        //final?
        TextView tvWelcomeMsg = (TextView) findViewById(R.id.tvWelcomeMsg);
        EditText etCredit = (EditText) findViewById(R.id.etCredit);
        EditText etName = (EditText) findViewById(R.id.etName);
        EditText etUsername = (EditText) findViewById(R.id.etUsername);
        EditText etPassword = (EditText) findViewById(R.id.etPassword);


        //display user details
        String message = "Welcome, " + name + ". Login successful. Your info:";

        tvWelcomeMsg.setText(message);

        //how to for int:
        etCredit.setText(credit + "");

        //etCredit.setText(credit);
        etName.setText(name);
        etUsername.setText(username);
        etPassword.setText(password);

    }
}
