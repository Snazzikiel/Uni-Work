using System.Collections;
using System.Collections.Generic;
using UnityEngine;
using UnityEngine.UI;

public class profileMenuScriptCustomer : MonoBehaviour {
	public GameObject canvas;

	public Animator profileAnim;
	public InputField firstNameField;
	public InputField lastNameField;
	public InputField emailField;
	public InputField passwordField;

	public activityManager activitymanager;

	// Use this for initialization
	void Start () {
		
	}

	public void backButtonProfileClicked(){

		profileAnim.Play ("profile background slide out");



	}

	public void profileActivated(){


	}

	public void setInputFields(){
		firstNameField.text = activitymanager.getCustomerLoggedIn ().getFirstName ();
		lastNameField.text = activitymanager.getCustomerLoggedIn ().getLastName ();
		emailField.text = activitymanager.getCustomerLoggedIn ().getEmail ();
		passwordField.text = activitymanager.getCustomerLoggedIn ().getPassword ();
	}

	public void saveInfo(){

		//checking if fields are empty
		if (firstNameField.text == "" | lastNameField.text == "" | emailField.text == "" | passwordField.text == "") {
			print ("a" + firstNameField.text + lastNameField.text + emailField.text + passwordField.text);
			//input field message
			SSTools.ShowMessage ("input field empty", SSTools.Position.bottom, SSTools.Time.twoSecond);
			return;
		} else {
			string x;
			x = activitymanager.getCustomerLoggedIn ().getEmail ();
			print ("x" + x);
			//fields not empty
			activitymanager.getCustomerLoggedIn().setFirstName(firstNameField.text);
			activitymanager.getCustomerLoggedIn().setLastName(lastNameField.text);
			activitymanager.getCustomerLoggedIn ().setEmail (emailField.text);

			activitymanager.getCustomerLoggedIn ().setPassword (passwordField.text);
			print ("x" + x);
			//only neccessary if email changes
			//if(emailField.text != x){


			//	canvas.GetComponent<loginActivity> ().editCustomerInfo (activitymanager.getCustomerLoggedIn().getID());
			//}
			canvas.GetComponent<loginActivity> ().saveCustomer(activitymanager.getCustomerLoggedIn());


			SSTools.ShowMessage ("info saved", SSTools.Position.bottom, SSTools.Time.twoSecond);

		}



	}
	


}
