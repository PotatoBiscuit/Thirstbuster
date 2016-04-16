package com.example.zylo.thirstbustertest;

import android.content.Context;
import android.content.SharedPreferences;

/**
 * Created by Zylo on 4/16/2016.
 */


public class User {

    private SharedPreferences sharedPreferences;
    private static String USER_INFO = "user";

    private static SharedPreferences getPrefs(Context context) {
        return context.getSharedPreferences(USER_INFO, Context.MODE_PRIVATE);
    }

    public static int getOrderNumber(Context context) {
        return getPrefs(context).getInt("ordernumber_key", -1);
    }

    public static void setOrderNumber(Context context, int input) {
        SharedPreferences.Editor editor = getPrefs(context).edit();
        editor.putInt("ordernumber_key", input);
        editor.commit();
    }

    public static int getColor(Context context) {
        return getPrefs(context).getInt("color_key", -1);
    }

    public static void setColor(Context context, int input) {
        SharedPreferences.Editor editor = getPrefs(context).edit();
        editor.putInt("color_key", input);
        editor.commit();
    }






}
