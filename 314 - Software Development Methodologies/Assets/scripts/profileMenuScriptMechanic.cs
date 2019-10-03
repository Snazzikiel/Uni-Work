using System.Collections;
using System.Collections.Generic;
using UnityEngine;
using UnityEngine.UI;

public class profileMenuScriptMechanic : MonoBehaviour {
	public GameObject canvas;

	public Animator profileAnim;
	public InputField firstNameField;
	public InputField lastNameField;
	public InputField emailField;
	public InputField passwordField;
	public InputField lattitudeField;
	public InputField longitudeField;

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
		firstNameField.text = activitymanager.getMechanicLoggedIn ().getFirstName ();
		lastNameField.text = activitymanager.getMechanicLoggedIn ().getLastName ();
		emailField.text = activitymanager.getMechanicLoggedIn ().getEmail ();
		passwordField.text = activitymanager.getMechanicLoggedIn ().getPassword ();
		lattitudeField.text = activitymanager.getMechanicLoggedIn ().lattitude.ToString ();
		longitudeField.text = activitymanager.getMechanicLoggedIn ().longitude.ToString ();

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
			x = activitymanager.getMechanicLoggedIn ().getEmail ();
			print ("x" + x);
			//fields not empty
			float memeValue;
			activitymanager.getMechanicLoggedIn().setFirstName(firstNameField.text);
			activitymanager.getMechanicLoggedIn().setLastName(lastNameField.text);
			activitymanager.getMechanicLoggedIn ().setEmail (emailField.text);

			activitymanager.getMechanicLoggedIn ().setPassword (passwordField.text);
			if (float.TryParse (lattitudeField.text, out memeValue) & float.TryParse (longitudeField.text, out memeValue)) {
				activitymanager.getMechanicLoggedIn().lattitude = float.Parse(lattitudeField.text);
				activitymanager.getMechanicLoggedIn().longitude = float.Parse(longitudeField.text);


			}



			print ("x" + x);

			canvas.GetComponent<loginActivity> ().saveMechanic(activitymanager.getMechanicLoggedIn());


			SSTools.ShowMessage ("info saved", SSTools.Position.bottom, SSTools.Time.twoSecond);

		}



	}
	


}
