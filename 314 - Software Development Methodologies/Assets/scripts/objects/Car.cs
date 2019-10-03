using System.Collections;
using System.Collections.Generic;
using UnityEngine;

[System.Serializable]
public class Car{
	//hey how are ya
	public string make;
	public string model;
	public int year;
	public string colour;

	public float lattitude;
	public float longitude;

//	public Customer()
//	{
//		this.firstName = firstName;
//		this.lastName = lastName;
//		this.email = email;
//		this.password = password;
//
//	}

	//get methods
	public string getMake(){

		return make;
	}

	public string getModel(){

		return model;
	}
	public int getYear(){

		return year;
	}

	public string getColour(){

		return colour;
	}

	//set methods
	public void setMake(string make){

		this.make = make;
	}

	public void setModel(string model){

		this.model = model;
	}
	public void setYear(int year){

		this.year = year;
	}

	public void setColour(string colour){

		this.colour = colour;
	}

	public void setlattitude (float lattitude){
		this.lattitude = lattitude;
	}

	public void setlongitude (float longitude){
		this.longitude = longitude;
	}

	public float getLattitude(){

		return lattitude;
	}

	public float getLongitude(){

		return longitude;
	}



}


	