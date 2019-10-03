using System.Collections;
using System.Collections.Generic;
using UnityEngine;
using UnityEngine.UI;

public class reviewCustomerMenuScript : MonoBehaviour {
	
	public Animator reviewAnim;
	public GameObject rowPrefab;
	public GameObject rowPrefabParent;

	int numberOfRows;
	int numberOfRequests;
	int totalNumberOfRequests;
	int totalNumberOfRows;

	float serviceRequestStartYPos = 335f;
	float serviceRequestGapDistance = -165f;


	public activityManager activitymanagerScript;
	public loginActivity loginactivity;


	// Use this for initialization
	void Start () {
		
	}

	public void backButtonReviewClicked(){

		reviewAnim.Play ("profile background slide out");



	}

	public void profileActivated(){


	}

	public void createReviewHistoryList(){
		foreach (Transform child in rowPrefabParent.transform) {
			GameObject.Destroy(child.gameObject);
		}
		numberOfRows = 0;

		numberOfRequests = 0;


		totalNumberOfRows = activitymanagerScript.getCustomerLoggedIn().getServiceRequestSize();
		print (totalNumberOfRows + "total");
		for (int i = 0; i < totalNumberOfRows; i++) {
			addRowFinished ();


		}

	}

	public void addRowFinished(){
        serviceRequestReceipt a;

		a = activitymanagerScript.getCustomerLoggedIn().getServiceRequest (numberOfRequests);
		numberOfRequests++;
		// if not accepted
		if (a.getStatus() == 2 & a.getHasReviewed() == false) {
			numberOfRows++;
			GameObject newRow = Instantiate (rowPrefab, new Vector2 (transform.position.x, transform.position.y), Quaternion.identity, rowPrefabParent.transform) as GameObject;
			newRow.GetComponent<RectTransform> ().localPosition = new Vector2 (0f, getYPos ());


			newRow.transform.GetChild (0).GetComponent<Text> ().text = loginActivity.dictionaryMechanic[a.mechanicId].getFullName();
			newRow.transform.GetChild (1).GetComponent<Text> ().text = a.getName ();
			newRow.transform.GetChild (2).GetComponent<Text> ().text = "$" + a.getPrice ().ToString();
			newRow.transform.GetChild (3).GetComponent<Text> ().text = a.car.getMake ();
			newRow.transform.GetChild (4).GetComponent<Text> ().text = a.car.getModel ();
			newRow.transform.GetChild (5).GetComponent<Text> ().text = "Pos: " + a.car.lattitude + ", " + a.car.longitude;
			newRow.transform.GetChild (8).GetComponent<Button> ().onClick.AddListener (delegate{rateReciept (newRow, a);});
			// 0 = mechanic name
			// 5 = position
			// 6 = rating input field
			// 7 = rating comment input field
			// 8 = review button
//			newRow.transform.GetChild (7).GetComponent<Text> ().text = "Waiting Acceptance";
		}
	}

	public float getYPos(){
		float x = serviceRequestStartYPos;
		for (int i = 0; i < numberOfRows; i++) {
			x = x + serviceRequestGapDistance;

		}

		return x;

	}

	public void rateReciept(GameObject row, serviceRequestReceipt reciept ){
		//checking if rating or comment are empty
		if (!(row.transform.GetChild (6).GetComponent<InputField> ().text == "") & !(row.transform.GetChild (7).GetComponent<InputField> ().text == "")) {
			reciept.setRating (int.Parse(row.transform.GetChild (6).GetComponent<InputField> ().text));
			reciept.comment = row.transform.GetChild (7).GetComponent<InputField> ().text;
			reciept.setHasReviewed (true);
			Destroy (row, 0);
			loginactivity.saveReceipt (reciept.customerId, reciept);
		


		}




	}

}
