package com.example.zylo.thirstbustertest;

/**
 * Created by Zylo on 4/15/2016.
 */
public class Location {

    private String location;
    private String name;

    // a chat message requiers  a message, and an author.
    // it has a boolean set to true uused to determin which side of the chat the message originates.
    public Location( String location, String name) {
        // TODO Auto-generated constructor stub
        super();
        this.location = location;
        this.name = name;
    }

    // Getters
    public String getLocation(){
        return location;
    }

    public String getName()
    {
        return name;
    }


    // Setters
    public void setPrice(String s)
    {
        location = s;
    }

    public void setName(String b)
    {
        name = b;
    }
}