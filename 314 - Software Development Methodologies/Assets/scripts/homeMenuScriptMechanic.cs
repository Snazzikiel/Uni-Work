using System.Collections;
using System.Collections.Generic;
using UnityEngine;
using UnityEngine.UI;

public class homeMenuScriptMechanic : MonoBehaviour {
	animationScript animationscript;
	activityManager activitymanager;
	loginActivity loginactivity; 
	public GameObject hamburgerMenuFadeBackground;
	public Text hamburgerProfileName;

	public GameObject profileBackground;
	public Animator profileBackgroundAnim;

	public GameObject serviceHistoryBackground;
	public Animator serviceHistoryBackgroundAnim;

	float serviceRequestStartYPos = 305f;
	float serviceRequestGapDistance = -135f;
	int numberOfRows;
	int totalNumberOfRowsMechanic;
	int numberOfRequests;
	int numberOfRequestsMechanic;
	int totalNumberOfRows;

	public GameObject rowPrefab;
	public GameObject rowPrefabParent;


	public GameObject homeMenuBackground;

    public Dictionary<int, Customer> dictionaryCustomer;
    public Dictionary<int, Mechanic> dictionaryMechanic;
    public Dictionary<int, Staff> dictionaryStaff;


    // Use this for initialization
    void Start () {
		activitymanager = transform.GetComponent<activityManager> ();
		animationscript = transform.GetComponent<animationScript> ();
		loginactivity = transform.GetComponent<loginActivity> ();

        dictionaryCustomer = loginActivity.getCustomerDictionary();
        dictionaryMechanic = loginActivity.getMechanicDictionary();
        dictionaryStaff = loginActivity.getStaffDictionary();


    }


    //get into hamburger menu
    public void hamburgerMenuButtonClicked(){
		//hamburger menu
		animationscript.playHamburgerMenuSlideInMechanic ();

		//hamburger menu background
		hamburgerMenuFadeBackground.SetActive (true);
		animationscript.playHamburgerMenuFadeBackgroundInMechanic ();

		//setting profile name
		hamburgerProfileName.text = activitymanager.getMechanicLoggedIn().getFirstName() + " " + activitymanager.getMechanicLoggedIn().getLastName();



	}

	// get out of hamburger menu
	public void hamburgerMenuBackButtonClicked(){
		//hamburger menu
		animationscript.playHamburgerMenuSlideOutMechanic ();

		//hamburger menu background
		animationscript.playHamburgerMenuFadeBackgroundOutMechanic ();




	}


	// hamburger menu buttons
	public void profileButtonClicked(){
		//profileBackground.SetActive (true);
		//profileBackgroundAnim.Play ("profile background slide in");

		profileBackground.SetActive (true);
		profileBackgroundAnim.Play ("profile background slide in");
		profileMenuScriptMechanic profilemenuscript = homeMenuBackground.GetComponent<profileMenuScriptMechanic> ();
		profilemenuscript.setInputFields ();

	}

	public void billingButtonClicked(){
		//profileBackground.SetActive (true);
		//profileBackgroundAnim.Play ("profile background slide in");

		profileBackground.SetActive (true);
		profileBackgroundAnim.Play ("profile background slide in");
		profileMenuScriptMechanic profilemenuscript = homeMenuBackground.GetComponent<profileMenuScriptMechanic> ();
		profilemenuscript.setInputFields ();

	}


	public void serviceHistoryButtonClicked(){
		serviceHistoryBackground.SetActive (true);
		serviceHistoryBackgroundAnim.Play ("profile background slide in");
		homeMenuBackground.GetComponent<serviceHistoryMechanicMenuScript> ().createHistoryList ();

	}


	public void logoutButtonClicked(){
		
		homeMenuBackground.SetActive (true);
//		foreach (Transform child in rowPrefabParent.transform) {
//			GameObject.Destroy(child.gameObject);
//		}
		animationscript.playHomeMenuBackgroundSlideOutMechanic ();


	}

	public void addRowUniversal(serviceRequestReceipt a){
		



		print ("universal customer id" + a.getCustomerID());
		numberOfRequests++;
		if (a.getStatus() == 0) {
			numberOfRows++;
			GameObject newRow = Instantiate (rowPrefab, new Vector2 (transform.position.x, transform.position.y), Quaternion.identity, rowPrefabParent.transform) as GameObject;
			newRow.GetComponent<RectTransform> ().localPosition = new Vector2 (0f, getYPos ());
			//newRow.transform.GetChild (0).GetComponent<Text> ().text = a.;
			print(a.getName());
			newRow.transform.GetChild (0).GetComponent<Text> ().text = loginActivity.dictionaryCustomer[a.customerId].getFullName();
			newRow.transform.GetChild (1).GetComponent<Text> ().text = a.getName ();
			newRow.transform.GetChild (2).GetComponent<Text> ().text = "$" + a.getPrice ().ToString();
			newRow.transform.GetChild (3).GetComponent<Text> ().text = a.car.getMake () + ", " + a.car.getModel ();
			newRow.transform.GetChild (4).GetComponent<Text> ().text = "Colour: " + a.car.getColour();
			newRow.transform.GetChild (5).GetComponent<Text> ().text = SaveData.DistanceBetween(a.car.getLattitude(),a.car.getLongitude(),
			activitymanager.getMechanicLoggedIn().lattitude, activitymanager.getMechanicLoggedIn().longitude) + " KM Away";

		
			newRow.transform.GetChild (6).GetComponent<Text> ().text = "Pos: " + a.car.lattitude + ", " + a.car.longitude;
			newRow.transform.GetChild (7).GetComponent<Button> ().onClick.AddListener (delegate{acceptRequest (newRow, a);});
			newRow.transform.GetChild (8).GetComponent<Text> ().text = "Waiting Acceptance";
		}


			

	}

	public void addRowMechanic(serviceRequestReceipt a){
		

		numberOfRequestsMechanic++;
		if (a.getStatus() == 1) {
			numberOfRows++;
			GameObject newRow = Instantiate (rowPrefab, new Vector2 (transform.position.x, transform.position.y), Quaternion.identity, rowPrefabParent.transform) as GameObject;
			newRow.GetComponent<RectTransform> ().localPosition = new Vector2 (0f, getYPos ());
			//newRow.transform.GetChild (0).GetComponent<Text> ().text = a.;
			print(a.getName());
			newRow.transform.GetChild (0).GetComponent<Text> ().text = loginActivity.dictionaryCustomer[a.customerId].getFullName();
			newRow.transform.GetChild (1).GetComponent<Text> ().text = a.getName ();
			newRow.transform.GetChild (2).GetComponent<Text> ().text = "$" + a.getPrice ().ToString();
			newRow.transform.GetChild (3).GetComponent<Text> ().text = a.car.getMake () + ", " + a.car.getModel ();
			newRow.transform.GetChild (4).GetComponent<Text> ().text = "Colour: " + a.car.getColour();
			newRow.transform.GetChild (5).GetComponent<Text> ().text = SaveData.DistanceBetween(a.car.getLattitude(),a.car.getLongitude(),
			activitymanager.getMechanicLoggedIn().lattitude, activitymanager.getMechanicLoggedIn().longitude) + " KM Away";

			newRow.transform.GetChild (6).GetComponent<Text> ().text = "Pos: " + a.car.lattitude + ", " + a.car.longitude;

		
			newRow.transform.GetChild (7).GetComponent<Button> ().onClick.AddListener (delegate{finishRequest (newRow, a);});
			newRow.transform.GetChild (7).transform.GetChild(0).GetComponent<Text>().text = "Finish";

			newRow.transform.GetChild (8).GetComponent<Text> ().text = "Accepted";
		}

		if (a.getStatus() == 2) {
			numberOfRows++;
			GameObject newRow = Instantiate (rowPrefab, new Vector2 (transform.position.x, transform.position.y), Quaternion.identity, rowPrefabParent.transform) as GameObject;
			newRow.GetComponent<RectTransform> ().localPosition = new Vector2 (0f, getYPos ());
			//newRow.transform.GetChild (0).GetComponent<Text> ().text = a.;
			print(a.getName());
			newRow.transform.GetChild (0).GetComponent<Text> ().text = a.getCustomerID().ToString();
			newRow.transform.GetChild (1).GetComponent<Text> ().text = a.getName ();
			newRow.transform.GetChild (2).GetComponent<Text> ().text = "$" + a.getPrice ().ToString();
			newRow.transform.GetChild (3).GetComponent<Text> ().text = a.car.getMake ();
			//		//print(a.car.getMake());
			//		//newRow.transform.GetChild (3).GetComponent<Text> ().text = "heya";
			newRow.transform.GetChild (4).GetComponent<Text> ().text = a.car.getModel ();
			newRow.transform.GetChild (7).gameObject.SetActive (false);
			newRow.transform.GetChild (8).GetComponent<Text> ().text = "Finished";
		}




	}

	public float getYPos(){
		float x = serviceRequestStartYPos;
		for (int i = 0; i < numberOfRows; i++) {
			x = x + serviceRequestGapDistance;

		}

		return x;

	}

	public void createRowsOfRequests(){
		
		foreach (Transform child in rowPrefabParent.transform) {
			GameObject.Destroy(child.gameObject);
		}
        serviceRequestReceipt a;
		numberOfRows = 0;
		numberOfRequestsMechanic = 0;
		numberOfRequests = 0;

//		totalNumberOfRowsMechanic = activitymanager.getMechanicLoggedIn ().getServiceRequestSize ();
//		//print (totalNumberOfRowsMechanic + "size");
//		for (int x = 0; x < totalNumberOfRowsMechanic; x++) {
//			addRowMechanic ();
//
//
//		}  

		print ("started creatiing");
		totalNumberOfRows = activitymanager.serviceRequestReceipts.Count;
		print (totalNumberOfRows);
		print (totalNumberOfRows);
		for (int i = 0; i < totalNumberOfRows; i++) {
			a = activitymanager.getServiceRequest (i);
			//status 0 = not accepted, status 1 = accepted waiting to be finished, status 2 = finished
			if (a.getStatus () == 1 ) {
				if (a.mechanicId == activitymanager.getMechanicLoggedIn ().id) {
					addRowMechanic (a);
				}
			} else if (a.getStatus() == 0) {

				addRowUniversal (a);
			}



		}
	}

	public void acceptRequest(GameObject row, serviceRequestReceipt mechanicReciept){
		row.transform.GetChild (7).GetComponent<Button> ().onClick.RemoveAllListeners ();
		print ("accepted");
		mechanicReciept.setStatus (1);
		row.transform.GetChild (8).GetComponent<Text> ().text = "Accepted";
		mechanicReciept.mechanicId = activitymanager.getMechanicLoggedIn ().getID();
		loginactivity.saveReceipt (mechanicReciept.customerId, mechanicReciept);
		//activitymanager.getMechanicLoggedIn ().addServiceRequest (mechanicReciept);
		//activitymanager.serviceRequestReciepts.Remove (mechanicReciept);
		row.transform.GetChild (7).GetComponent<Button> ().onClick.AddListener (delegate{finishRequest (row, mechanicReciept);});
		row.transform.GetChild (7).GetComponentInChildren<Text> ().text = "Finish";
		//mechanicReciept.customer.serviceRequestReciepts.Contains (mechanicReciept).Equals(mechanicReciept);

		//Destroy (a);

	}

	public void finishRequest(GameObject a, serviceRequestReceipt b){
		b.setStatus (2);
		a.transform.GetChild (8).GetComponent<Text> ().text = "Finished";
		a.transform.GetChild (7).gameObject.SetActive (false);
		loginactivity.saveReceipt (b.customerId, b);
		//activitymanager.serviceRequestReciepts.Remove (b);
		//b.mechanic = activitymanager.getMechanicLoggedIn ();
		//activitymanager.getMechanicLoggedIn ().addServiceRequest (b);


	}
}
