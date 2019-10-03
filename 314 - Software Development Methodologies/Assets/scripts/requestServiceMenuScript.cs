using System.Collections;
using System.Collections.Generic;
using UnityEngine;
using UnityEngine.UI;


public class requestServiceMenuScript : MonoBehaviour {


	public Animator requestServiceAnim;
	public Animator carDetailsBackgroundAnim;
	public GameObject carDetailsBackground;
	public InputField price;
	public InputField problem;
	public InputField make;
	public InputField model;
	public InputField year;
	public InputField colour;

	public InputField lattitude;
	public InputField longitude;

	public Text priceText;
	public Text carText;
	public Text requestTypeText;
	public Text requestPriceText;

	activityManager activitymanager;
	public GameObject canvas;

	bool isOther = false;

	Service service;

	// Use this for initializationw
	void Start () {
		activitymanager = canvas.GetComponent<activityManager> ();
	}

	public void backButtonServiceRequestClicked(){

		requestServiceAnim.Play ("request service background slide out");
		carDetailsBackground.SetActive (false);

	}

	public void carDetailsBackgroundInFuel(){
		carDetailsBackground.SetActive (true);
		//carDetailsBackgroundAnim.Play ("profile background slide in");
		requestTypeText.text = activitymanager.fuel.name;
		requestPriceText.text = activitymanager.fuel.price.ToString();
		service = activitymanager.fuel;

	}

	public void carDetailsBackgroundInFlatTyre(){
		carDetailsBackground.SetActive (true);

		requestTypeText.text = activitymanager.flatTyre.name;
		requestPriceText.text = activitymanager.flatTyre.price.ToString();
		service = activitymanager.flatTyre;
		//carDetailsBackgroundAnim.Play ("profile background slide in");

	}

	public void carDetailsBackgroundInLockedOut(){
		carDetailsBackground.SetActive (true);

		requestTypeText.text = activitymanager.lockedOut.name;
		requestPriceText.text = activitymanager.lockedOut.price.ToString();
		service = activitymanager.lockedOut;
		//carDetailsBackgroundAnim.Play ("profile background slide in");

	}

	public void carDetailsBackgroundInTow(){
		carDetailsBackground.SetActive (true);

		requestTypeText.text = activitymanager.tow.name;
		requestPriceText.text = activitymanager.tow.price.ToString();
		service = activitymanager.tow;
		//carDetailsBackgroundAnim.Play ("profile background slide in");

	}

	public void carDetailsBackgroundInOther(){
		carDetailsBackground.SetActive (true);


		requestPriceText.gameObject.SetActive (false);
		requestTypeText.gameObject.SetActive (false);
		carText.gameObject.SetActive (false);
		priceText.gameObject.SetActive (false);
		price.gameObject.SetActive (true);
		problem.gameObject.SetActive (true);
		service = activitymanager.tow;
		//carDetailsBackgroundAnim.Play ("profile background slide in");
		isOther = true;
	}

	public void okClicked(){
		if (isOther) {
			if (make.text == "" | model.text == "" | year.text == "" | colour.text == "" | lattitude.text == "" | longitude.text == ""| price.text == "" | problem.text == "") {
				//input field message
				SSTools.ShowMessage ("input field empty", SSTools.Position.bottom, SSTools.Time.twoSecond);
				return;
			}

			canvas.GetComponent<activityManager> ().getCustomerLoggedIn ().car.setMake (make.text);
			canvas.GetComponent<activityManager> ().getCustomerLoggedIn ().car.setModel (model.text);
			canvas.GetComponent<activityManager> ().getCustomerLoggedIn ().car.setYear (int.Parse (year.text));
			canvas.GetComponent<activityManager> ().getCustomerLoggedIn ().car.setColour (colour.text);
			canvas.GetComponent<activityManager> ().getCustomerLoggedIn ().car.setlattitude (float.Parse (lattitude.text));
			canvas.GetComponent<activityManager> ().getCustomerLoggedIn ().car.setlongitude (float.Parse (longitude.text));

			//create service request receipt
			loginActivity loginactivity = canvas.GetComponent<loginActivity> ();
			loginactivity.totalIDCount++;
			loginactivity.saveTotalIDCount ();
            serviceRequestReceipt reciept = new serviceRequestReceipt (loginactivity.totalIDCount, activitymanager.getCustomerLoggedIn ().id, problem.text , float.Parse(price.text));
			reciept.car = canvas.GetComponent<activityManager> ().getCustomerLoggedIn ().car;

			activitymanager.addServiceRequest (reciept);
			//loginactivity.saveReceipt(activitymanager.getCustomerLoggedIn().id,reciept);

			//serviceRequestReciept currentReciept = activitymanager.getServiceRequest (activitymanager.getServiceRequestSize () - 1);
			activitymanager.getCustomerLoggedIn ().addServiceRequest (reciept);

			loginactivity.saveCustomer (activitymanager.getCustomerLoggedIn ());


			//currentReciept.customer = activitymanager.getCustomerLoggedIn();
			//currentReciept.car = activitymanager.getCustomerLoggedIn ().car;
			SSTools.ShowMessage ("request Sent", SSTools.Position.bottom, SSTools.Time.twoSecond);
			backButtonServiceRequestClicked ();
			canvas.GetComponent<homeMenuScript> ().createRowsOfRequests ();


		} else {
			if (make.text == "" | model.text == "" | year.text == "" | colour.text == "" | lattitude.text == "" | longitude.text == "") {
				//input field message
				SSTools.ShowMessage ("input field empty", SSTools.Position.bottom, SSTools.Time.twoSecond);
				return;
			}

			canvas.GetComponent<activityManager> ().getCustomerLoggedIn ().car.setMake (make.text);
			canvas.GetComponent<activityManager> ().getCustomerLoggedIn ().car.setModel (model.text);
			canvas.GetComponent<activityManager> ().getCustomerLoggedIn ().car.setYear (int.Parse (year.text));
			canvas.GetComponent<activityManager> ().getCustomerLoggedIn ().car.setColour (colour.text);
			canvas.GetComponent<activityManager> ().getCustomerLoggedIn ().car.setlattitude (float.Parse (lattitude.text));
			canvas.GetComponent<activityManager> ().getCustomerLoggedIn ().car.setlongitude (float.Parse (longitude.text));

			//create service request receipt
			loginActivity loginactivity = canvas.GetComponent<loginActivity> ();
			loginactivity.totalIDCount++;
			loginactivity.saveTotalIDCount ();
            serviceRequestReceipt reciept = new serviceRequestReceipt(loginactivity.totalIDCount, activitymanager.getCustomerLoggedIn ().id, service.name, service.price);
			reciept.car = canvas.GetComponent<activityManager> ().getCustomerLoggedIn ().car;

			activitymanager.addServiceRequest (reciept);
			//loginactivity.saveReceipt(activitymanager.getCustomerLoggedIn().id,reciept);

			//serviceRequestReciept currentReciept = activitymanager.getServiceRequest (activitymanager.getServiceRequestSize () - 1);
			activitymanager.getCustomerLoggedIn ().addServiceRequest (reciept);

			loginactivity.saveCustomer (activitymanager.getCustomerLoggedIn ());


			//currentReciept.customer = activitymanager.getCustomerLoggedIn();
			//currentReciept.car = activitymanager.getCustomerLoggedIn ().car;
			SSTools.ShowMessage ("request Sent", SSTools.Position.bottom, SSTools.Time.twoSecond);
			backButtonServiceRequestClicked ();
			canvas.GetComponent<homeMenuScript> ().createRowsOfRequests ();


		}

		requestPriceText.gameObject.SetActive (true);
		requestTypeText.gameObject.SetActive (true);
		carText.gameObject.SetActive (true);
		priceText.gameObject.SetActive (true);
		price.gameObject.SetActive (false);
		problem.gameObject.SetActive (false);
		isOther = false;
	}


	


}
