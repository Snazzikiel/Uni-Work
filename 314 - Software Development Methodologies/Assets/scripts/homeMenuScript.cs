using System.Collections;
using System.Collections.Generic;
using UnityEngine;
using UnityEngine.UI;

public class homeMenuScript : MonoBehaviour {
	animationScript animationscript;
	activityManager activitymanager;
	public GameObject hamburgerMenuFadeBackground;
	public Text hamburgerProfileName;

	public GameObject profileBackground;
	public Animator profileBackgroundAnim;

	public GameObject billingBackground;
	public Animator billingBackgroundAnim;

	public GameObject serviceHistoryBackground;
	public Animator serviceHistoryBackgroundAnim;

	public GameObject requestServiceBackground;
	public Animator requestServiceBackgroundAnim;

	public GameObject reviewBackground;
	public Animator reviewBackgroundAnim;

	public GameObject homeMenuBackground;

	float serviceRequestStartYPos = 305f;
	float serviceRequestGapDistance = -125f;
	int numberOfRows;
	int totalNumberOfRowsPending;
	int numberOfRequests;
	int numberOfRequestsPending;
	int totalNumberOfRows;

	public GameObject rowPrefab;
	public GameObject rowPrefabParent;



	// Use this for initialization
	void Start () {
		activitymanager = transform.GetComponent<activityManager> ();
		animationscript = transform.GetComponent<animationScript> ();
	}
	

	//get into hamburger menu
	public void hamburgerMenuButtonClicked(){
		//hamburger menu
		animationscript.playHamburgerMenuSlideInCustomer ();

		//hamburger menu background
		hamburgerMenuFadeBackground.SetActive (true);
		animationscript.playHamburgerMenuFadeBackgroundInCustomer ();

		//setting profile name
		hamburgerProfileName.text = activitymanager.getCustomerLoggedIn().getFirstName() + " " + activitymanager.getCustomerLoggedIn().getLastName();



	}

	// get out of hamburger menu
	public void hamburgerMenuBackButtonClicked(){
		//hamburger menu
		animationscript.playHamburgerMenuSlideOutCustomer ();

		//hamburger menu background
		animationscript.playHamburgerMenuFadeBackgroundOutCustomer ();




	}


	// hamburger menu buttons
	public void profileButtonClicked(){
		profileBackground.SetActive (true);
		profileBackgroundAnim.Play ("profile background slide in");
		profileMenuScriptCustomer profilemenuscript = homeMenuBackground.GetComponent<profileMenuScriptCustomer> ();
		profilemenuscript.setInputFields ();

	}

	public void billingButtonClicked(){
		billingBackground.SetActive (true);
		billingBackgroundAnim.Play ("profile background slide in");
		//profileMenuScriptCustomer profilemenuscript = homeMenuBackground.GetComponent<profileMenuScriptCustomer> ();
		//profilemenuscript.setInputFields ();

	}

	public void serviceHistoryButtonClicked(){
		serviceHistoryBackground.SetActive (true);
		serviceHistoryBackgroundAnim.Play ("profile background slide in");
		homeMenuBackground.GetComponent<serviceHistoryCustomerMenuScript> ().createHistoryList ();

	}

	public void reviewButtonClicked(){
		reviewBackground.SetActive (true);
		reviewBackgroundAnim.Play ("profile background slide in");
		//homeMenuBackground.GetComponent<serviceHistoryCustomerMenuScript> ().createHistoryList ();
		homeMenuBackground.GetComponent<reviewCustomerMenuScript>().createReviewHistoryList();

	}
	public void requestServiceButtonClicked(){
		requestServiceBackground.SetActive (true);
		requestServiceBackgroundAnim.Play ("request service background slide in");

	}
	public void logoutButtonClicked(){
		
		homeMenuBackground.SetActive (true);
		foreach (Transform child in rowPrefabParent.transform) {
			GameObject.Destroy(child.gameObject);
		}
		animationscript.playHomeMenuBackgroundSlideOutCustomer ();


	}

	public void createRowsOfRequests(){
		
		foreach (Transform child in rowPrefabParent.transform) {
			GameObject.Destroy(child.gameObject);
		}
		numberOfRows = 0;

		numberOfRequests = 0;

//		totalNumberOfRowsMechanic = activitymanager.getMechanicLoggedIn ().getServiceRequestSize ();
//		for (int x = 0; x < totalNumberOfRowsMechanic; x++) {
//			addRowMechanic ();
//
//
//		}  


		totalNumberOfRows = activitymanager.getCustomerLoggedIn().getServiceRequestSize();
		//print (totalNumberOfRows);
		for (int i = 0; i < totalNumberOfRows; i++) {
			addRowPending ();


		}
	}




	public void addRowPending(){
		serviceRequestReceipt a;
		a = activitymanager.getCustomerLoggedIn().getServiceRequest (numberOfRequests);
		numberOfRequests++;
		// if not accepted
		if (a.getStatus() == 0) {
			numberOfRows++;
			GameObject newRow = Instantiate (rowPrefab, new Vector2 (transform.position.x, transform.position.y), Quaternion.identity, rowPrefabParent.transform) as GameObject;
			newRow.GetComponent<RectTransform> ().localPosition = new Vector2 (0f, getYPos ());
			//newRow.transform.GetChild (0).GetComponent<Text> ().text = a.;
			//print(a.getName());
			newRow.transform.GetChild (0).GetComponent<Text> ().text = "Mechanic Name";
			newRow.transform.GetChild (1).GetComponent<Text> ().text = a.getName ();
			newRow.transform.GetChild (2).GetComponent<Text> ().text = "$" + a.getPrice ().ToString();

			newRow.transform.GetChild (3).GetComponent<Text> ().text = a.car.getMake ();

			newRow.transform.GetChild (4).GetComponent<Text> ().text = a.car.getModel ();
			//newRow.transform.GetChild (7).GetComponent<Button> ().onClick.AddListener (delegate{acceptRequest (newRow, a);});
			newRow.transform.GetChild (7).GetComponent<Text> ().text = "Waiting Acceptance";
		}
		// if accepted
		if (a.getStatus() == 1) {
			numberOfRows++;
			GameObject newRow = Instantiate (rowPrefab, new Vector2 (transform.position.x, transform.position.y), Quaternion.identity, rowPrefabParent.transform) as GameObject;
			newRow.GetComponent<RectTransform> ().localPosition = new Vector2 (0f, getYPos ());
			//newRow.transform.GetChild (0).GetComponent<Text> ().text = a.;
			print(a.getName());
			newRow.transform.GetChild (0).GetComponent<Text> ().text = a.getMechanicID().ToString();
			newRow.transform.GetChild (1).GetComponent<Text> ().text = a.getName ();
			newRow.transform.GetChild (2).GetComponent<Text> ().text = "$" + a.getPrice ().ToString();
			newRow.transform.GetChild (3).GetComponent<Text> ().text = a.car.getMake ();
			//		//print(a.car.getMake());
			//		//newRow.transform.GetChild (3).GetComponent<Text> ().text = "heya";
			newRow.transform.GetChild (4).GetComponent<Text> ().text = a.car.getModel ();
			//newRow.transform.GetChild (7).GetComponent<Button> ().onClick.AddListener (delegate{acceptRequest (newRow, a);});
			newRow.transform.GetChild (7).GetComponent<Text> ().text = "Accepted";
		}




	}


	public float getYPos(){
		float x = serviceRequestStartYPos;
		for (int i = 0; i < numberOfRows; i++) {
			x = x + serviceRequestGapDistance;

		}

		return x;

	}

}
