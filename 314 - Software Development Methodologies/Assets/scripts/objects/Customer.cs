using System.Collections;
using System.Collections.Generic;
using UnityEngine;


[System.Serializable]
public class Customer{
	//hey how are ya
	public string firstName;
	public string lastName;
	public string email;
	public string password;
	public int id;

	public Car car;
	public List<serviceRequestReceipt> serviceRequestReceipts = new List<serviceRequestReceipt>();

	public Customer()
	{
		
	}

	public Customer(int id, string firstName, string lastName, string email, string password)
	{
		this.firstName = firstName;
		this.lastName = lastName;
		this.email = email;
		this.password = password;
		this.id = id;
		car = new Car ();
	}

	//get methods
	public int getID(){

		return id;
	}

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

	public void addServiceRequest(serviceRequestReceipt a){
        serviceRequestReceipts.Add (a);

	}

	public serviceRequestReceipt getServiceRequest (int i){

		return serviceRequestReceipts[i];


	}

	public int getServiceRequestSize(){
		return serviceRequestReceipts.Count;
	}

//	public void setCar(Car car){
//		this.car = car;
//
//
//	}
//
//	public Car getCar(){
//		return car;
//
//
//	}




}


	