using System.Collections;
using System.Collections.Generic;
using UnityEngine;

public class customerMoney {
//class used to payment data to be used and retrieved when paying for services
//used to pay for services, upgrade member status and pay as you go services

	Customer custData;
	private string custCDetails;
	private string custCExpiry;
	private string custCCSV;
	
	
	customerMoney (Customer custData, string custCDetails, string custCExpiry, string custCCSV){
		this.custData = custData;
		this.custCDetails = custCDetails;
		this.custCExpiry = custCExpiry;
		this.custCCSV = custCCSV;
	}
	
	//get methods
	public Customer getCustData(){
		return this.custData;
	}
	
	public string getCustDetails(){
		return this.custCDetails;
	}
	
	public string getCustExpiry(){
		return this.custCExpiry;
	}
	
	public string getCustCSV(){
		return this.custCCSV;
	}
	
	//set methods
	public void setCustData(Customer custData){
		this.custData = custData;
	}
	
	public void setCustDetails(string custCDetails){
		this.custCDetails = custCDetails;
	}
	
	public void setCustExiry(string custCExpiry){
		this.custCExpiry = custCExpiry;
	}
	
	public void setCustCSV(string custCCSV){
		this.custCCSV = custCCSV;
	}
	

}