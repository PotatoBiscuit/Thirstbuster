package com.CS477.drinkandgo.activies;

import android.view.View;

import com.CS477.drinkandgo.R;


public class MainActivity extends DrinkAndGoActivity 
{
    public MainActivity()
    {	super(R.layout.activity_main);}
    
    public void gotoSignIn(View view)
    {	startActivity(SignInActivity.class);}
    
    public void gotoSignUp(View view)
    {	startActivity(SignUpActivity.class);}
}
