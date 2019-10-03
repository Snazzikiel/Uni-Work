using System.Collections;
using System.Collections.Generic;
using UnityEngine;

public class activityManager : MonoBehaviour {
	string currentActivity;
	string lastActivity;

	Customer currentCustomer;
	Mechanic currentMechanic;
    Staff currentStaff;

    public Service flatTyre = new Service();
	public Service fuel = new Service();
	public Service lockedOut = new Service();
	public Service tow = new Service();

	public List<serviceRequestReceipt> serviceRequestReceipts = new List <serviceRequestReceipt>();

	List<int> listOfRequestRecieptsID = new List<int>();


	// Use this for initialization
	void Start () {
		//creating service types

		flatTyre.name = "Flat Tyre";
		flatTyre.price = 199.99f;

		fuel.name = "Fuel";
		fuel.price = 29.99f;

		lockedOut.name = "locked out";
		lockedOut.price = 99.99f;

		tow.name = "tow";
		tow.price = 80f;
	}



	public void setCustomerLoggedIn(Customer cus){
		currentCustomer = cus;

	}

	public Customer getCustomerLoggedIn(){
		return currentCustomer;

	}

	public void setMechanicLoggedIn(Mechanic mech){
		currentMechanic = mech;

	}

	public Mechanic getMechanicLoggedIn(){
		return currentMechanic;

	}

    public void setStaffLoggedIn(Staff staf)
    {
        currentStaff = staf;

    }

    public Staff getStaffLoggedIn()
    {
        return currentStaff;
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



}
