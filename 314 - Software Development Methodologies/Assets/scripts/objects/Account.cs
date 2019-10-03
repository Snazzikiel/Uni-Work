using System.Collections;
using System.Collections.Generic;
using UnityEngine;


public class Account{
	//monthly, half yearly, yearly, pay as you go
	public string subscriptionType;
	public float balance;


//	public Customer()
//	{
//		this.firstName = firstName;
//		this.lastName = lastName;
//		this.email = email;
//		this.password = password;
//
//	}

	//get methods
	public float getBalance(){

		return balance;
	}

	public void setBalance(float balance){

		this.balance = balance;
	}
	public string getSubscriptionType(){
		return subscriptionType;
	}


}


	