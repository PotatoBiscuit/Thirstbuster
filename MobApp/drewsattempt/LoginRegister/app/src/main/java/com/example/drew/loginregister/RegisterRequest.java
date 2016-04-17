package com.example.drew.loginregister;

import com.android.volley.Response;
import com.android.volley.toolbox.StringRequest;

import java.util.HashMap;
import java.util.Map;

/**
 * Created by Drew on 4/10/16.
 */
public class RegisterRequest extends StringRequest {

    private static final String REGISTER_REQUEST_URL = "http://thirstbuster.net23.net/Register.php";
    private Map<String, String> params;

    public RegisterRequest(int credit, String name, String username, String password, Response.Listener<String> listener){
        super(Method.POST, REGISTER_REQUEST_URL, listener, null); /*TODO replace null w an error listener*/
        params = new HashMap<>();

        //how to for int:
        params.put("credit", credit + "");

        //params.put("credit", credit);
        params.put("name", name);
        params.put("username", username);
        params.put("password", password);
    }

    @Override
    public Map<String, String> getParams() {
        return params;
    }
}
