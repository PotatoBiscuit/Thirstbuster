package com.example.zylo.thirstbustertest;

/**
 * Created by Zylo on 2/19/2016.
 */
public class Drink {
    private String price;
    private String name;

    // a chat message requiers  a message, and an author.
    // it has a boolean set to true uused to determin which side of the chat the message originates.
    public Drink( String price, String name) {
        // TODO Auto-generated constructor stub
        super();
        this.price = price;
        this.name = name;
    }

    // Getters
    public String getPrice(){
    return price;
    }

    public String getName()
    {
        return name;
    }


    // Setters
    public void setPrice(String s)
    {
        price = s;
    }

    public void setName(String b)
    {
        name = b;
    }
}