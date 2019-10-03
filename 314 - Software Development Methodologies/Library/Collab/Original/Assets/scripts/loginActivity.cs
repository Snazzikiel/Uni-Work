using System.Collections;
using System.Collections.Generic;
using UnityEngine;
using UnityEngine.UI;



public class loginActivity : MonoBehaviour {
	// login variables
	public GameObject loginBackground;
	public GameObject homeMenuBackgroundCustomer;
	public GameObject homeMenuBackgroundMechanic;
	public GameObject signUpBackgroundGameObj;
	animationScript animationscript;

	activityManager activitymanager;
	public Color selectedCol;
	public Color unselectedCol;
	bool isMechanicSelected;

	string errorMessage;
	bool hasLoginError;

	public GameObject customerButton;
	public GameObject mechanicButton;



	public InputField email;
	public InputField password;

	Dictionary<string,Customer> dictionaryCustomer = new Dictionary<string, Customer>();
	Dictionary<string,Mechanic> dictionaryMechanic = new Dictionary<string, Mechanic>();




	// sign up variables
	public List<Customer> customer  = new List<Customer>();

	public InputField signUpFirstName;
	public InputField signUpLastName;
	public InputField signUpPassword;
	public InputField signUpEmail;

	public homeMenuScript homemenuscriptCustomer;
	public homeMenuScriptMechanic homemenuscriptmechanic;

	int totalIDCount = 5;

	// Use this for initialization
	void Start () {


		animationscript = transform.GetComponent<animationScript>();
		activitymanager = transform.GetComponent<activityManager> ();


		//creating customers
		Customer customer1 = new Customer(1,"harry","hazelton","h","p");
		Customer customer2 = new Customer(2,"Connor","Jones","c","p");

		//adding customers to dictionary

		dictionaryCustomer.Add (customer1.getEmail (), customer1);
		dictionaryCustomer.Add (customer2.getEmail (), customer2);



		Mechanic mechanic1 = new Mechanic(3,"Steve","Harvey","s","p");
		Mechanic mechanic2 = new Mechanic(4,"Aladin","Harvey","a","p");

		//adding mechanics to dictionary
		dictionaryMechanic.Add (mechanic1.getEmail (), mechanic1);
		dictionaryMechanic.Add (mechanic2.getEmail (), mechanic2);

		//create service request
		customer2.car = new Car();
		customer2.car.setMake ("toyota");
		customer2.car.setModel ("aurion");
		print (customer1.car.getMake ());
		activitymanager.addServiceRequest(new serviceRequestReciept("fuel", 29f));
		activitymanager.getServiceRequest (0).customerId = customer2.getID();
		activitymanager.getServiceRequest (0).car = new Car ();
		activitymanager.getServiceRequest (0).car.setMake ("toyota");
		activitymanager.getServiceRequest (0).car.setModel ("aurion");
		customer2.addServiceRequest (activitymanager.getServiceRequest(0));

		Data data = new Data();
		data.saveCustomer(customer2);
		
	}
	
	// Update is called once per frame
	void Update () {
		
	}


	public void signInClicked(){
		
		// checking login for customers
		if (dictionaryCustomer.ContainsKey (email.text)) {
			//correct email, now checking password
			if (dictionaryCustomer [email.text].getPassword() == password.text) {
				//correct password
				SSTools.ShowMessage ("login successful", SSTools.Position.bottom, SSTools.Time.twoSecond);
				// login customer
				activitymanager.setCustomerLoggedIn(dictionaryCustomer [email.text]);

				changeActivityToHomeMenuCustomer ();
				errorMessage = "login successful";
			} else {
				//correct email, incorrect password

				errorMessage = "Incorrect Password";
			}
			
		} else {
			//incorrect email
			errorMessage = "Incorrect UserName";

		}

		// checking login for mechanics
		if (errorMessage != "login successful") {
			if (dictionaryMechanic.ContainsKey (email.text)) {
				//correct email, now checking password
				if (dictionaryMechanic [email.text].getPassword () == password.text) {
					//correct password
					SSTools.ShowMessage ("login successful", SSTools.Position.bottom, SSTools.Time.twoSecond);
					// login customer
					activitymanager.setMechanicLoggedIn (dictionaryMechanic [email.text]);
					changeActivityToHomeMenuMechanic ();
					errorMessage = "login successful";

				} else {
					//correct email, incorrect password

					errorMessage = "Incorrect Password";
				}

			} else {
				//incorrect email
				errorMessage = "Incorrect UserName";

			}
		}

		SSTools.ShowMessage (errorMessage, SSTools.Position.bottom, SSTools.Time.twoSecond);
		errorMessage = "";
	}

	public void changeActivityToHomeMenuCustomer(){
		homeMenuBackgroundCustomer.SetActive (true);
		animationscript.playHomeMenuBackgroundSlideInCustomer ();
		//homeMenuBackgroundCustomer;
		homemenuscriptCustomer.createRowsOfRequests();
	}

	public void changeActivityToHomeMenuMechanic(){
		homeMenuBackgroundMechanic.SetActive (true);
		animationscript.playHomeMenuBackgroundSlideInMechanic ();
		homemenuscriptmechanic.createRowsOfRequests ();
	}


	public void clickHereButtonClicked(){
		signUpBackgroundGameObj.SetActive (true);
		animationscript.playSignUpBackgroundSlideIn ();
		setCustomerMechanicSignupButton ();

	}

	// sign up functions

	public void signUpCrossButtonClicked(){
		animationscript.playSignUpBackgroundSlideOut ();


	}



	public void signUpClicked(){
		if (signUpFirstName.text == "" | signUpLastName.text == ""| signUpEmail.text == "" | signUpPassword.text == "") {
			//input field message
			SSTools.ShowMessage ("input field empty", SSTools.Position.bottom, SSTools.Time.twoSecond);
			return;
			
		}
		if (isMechanicSelected) {
			//checks if email already in use
			if (!dictionaryMechanic.ContainsKey (signUpEmail.text)) {
				//creates mechanic account by adding mechanic object to dictionary
				Mechanic mechanica;
				mechanica = new Mechanic (totalIDCount, signUpFirstName.text, signUpLastName.text, signUpEmail.text, signUpPassword.text);
				dictionaryMechanic.Add (signUpEmail.text, mechanica);
				SSTools.ShowMessage ("new account created", SSTools.Position.bottom, SSTools.Time.twoSecond);
			} else {
				SSTools.ShowMessage ("email account already in use", SSTools.Position.bottom, SSTools.Time.twoSecond);

			}

		} else {
			//checks if email already in use
			if (!dictionaryCustomer.ContainsKey (signUpEmail.text)) {
				//creates customer account by adding customer object to dictionary
				Customer customera;
				customera = new Customer (totalIDCount, signUpFirstName.text, signUpLastName.text, signUpEmail.text, signUpPassword.text);
				dictionaryCustomer.Add (signUpEmail.text, customera);
				SSTools.ShowMessage ("new account created", SSTools.Position.bottom, SSTools.Time.twoSecond);
			} else {
				SSTools.ShowMessage ("email account already in use", SSTools.Position.bottom, SSTools.Time.twoSecond);


			}
		}


	}

	public void customerButtonClicked(){
		isMechanicSelected = false;
		setCustomerMechanicSignupButton ();
	}

	public void mechanicButtonClicked(){
		isMechanicSelected = true;
		setCustomerMechanicSignupButton ();

	}

	public void setCustomerMechanicSignupButton(){
		if(isMechanicSelected){
			customerButton.GetComponent<Image> ().color = unselectedCol;
			mechanicButton.GetComponent<Image> ().color = selectedCol;
		}else{
			customerButton.GetComponent<Image> ().color = selectedCol;
			mechanicButton.GetComponent<Image> ().color = unselectedCol;

		}


	}

	public void editCustomerInfo(string email){
		//print (dictionaryCustomer [activitymanager.getCustomerLoggedIn().getEmail()].getLastName());

		dictionaryCustomer.Remove (email);
		dictionaryCustomer.Add (activitymanager.getCustomerLoggedIn ().getEmail (), activitymanager.getCustomerLoggedIn ());

	}


	public void editMechanicInfo(string email){
		//print (dictionaryCustomer [activitymanager.getCustomerLoggedIn().getEmail()].getLastName());

		dictionaryMechanic.Remove (email);
		dictionaryMechanic.Add (activitymanager.getMechanicLoggedIn ().getEmail (), activitymanager.getMechanicLoggedIn ());

	}



}
