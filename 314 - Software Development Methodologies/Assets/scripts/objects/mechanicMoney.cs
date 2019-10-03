using System.Collections;
using System.Collections.Generic;
using UnityEngine;

public class mechanicMoney {

	Mechanic mechData;
	private string mechCDetails;
	private string mechCExpiry;
	private string mechCCSV;
		
	mechanicMoney (Mechanic mechData, string mechCDetails, string mechCExpiry, string mechCCSV){
		this.mechData = mechData;
		this.mechCDetails = mechCDetails;
		this.mechCExpiry = mechCExpiry;
		this.mechCCSV = mechCCSV;
	}
	
	//get methods
	public Mechanic getMechData(){
		return this.mechData;
	}
	
	public string getMechDetails(){
		return this.mechCDetails;
	}
	
	public string getMechExpiry(){
		return this.mechCExpiry;
	}
	
	public string getMechCSV(){
		return this.mechCCSV;
	}
	
	//set methods
	public void setMechData(Mechanic mechData){
		this.mechData = mechData;
	}
	
	public void setMechDetails(string mechCDetails){
		this.mechCDetails = mechCDetails;
	}
	
	public void setMechExpiry(string mechCExpiry){
		this.mechCExpiry = mechCExpiry;
	}
	
	public void setMechCSV(string mechCCSV){
		this.mechCCSV = mechCCSV;
	}
	

}