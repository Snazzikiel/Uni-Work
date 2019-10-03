using System.Collections;
using System.Collections.Generic;
using UnityEngine;


[System.Serializable]
public class Mechanic{
	
	public string firstName;
	public string lastName;
	public string email;
	public string password;
	public float lattitude;
	public float longitude;
	public int id;

	//public List<serviceRequestReciept> serviceRequestReciepts = new List<serviceRequestReciept>();

	public Mechanic()
	{
		

	}

	public Mechanic(int id, string firstName, string lastName, string email, string password)
	{
		this.firstName = firstName;
		this.lastName = lastName;
		this.email = email;
		this.password = password;
		this.id = id;

	}
	public int getID(){

		return id;
	}
	//get methods
	public string getFirstName(){

		return firstName;
	}

	public string getLastName(){

		return lastName;
	}

	public string getFullName(){

		return firstName + " " + lastName;
	}
	public string getEmail(){

		return email;
	}

	public string getPassword(){

		return password;
	}

	//set methods
	public void setFirstName(string firstName){

		this.firstName = firstName;
	}

	public void setLastName(string lastName){

		this.lastName = lastName;
	}

	public void setEmail(string email){

		this.email = email;
	}

	public void setPassword(string password){

		this.password = password;
	}







}


	