package com;

import java.io.Serializable;
import java.util.ArrayList;
import java.util.Objects;
import javax.annotation.ManagedBean;
import javax.enterprise.context.SessionScoped;


@SessionScoped
@ManagedBean
public class Bean implements Serializable{
    private static final long serialVersionUID = 1L;
    private ArrayList<Object[]> sessionData = new ArrayList<>();

    public void setSessionData(ArrayList<Object[]> data){
        this.sessionData = data;
    }
    public void addSessionData(Object[] data){
        this.sessionData.add(data);
    }
    public ArrayList<Object[]> getSessionData(){
        return this.sessionData;
    }
}
