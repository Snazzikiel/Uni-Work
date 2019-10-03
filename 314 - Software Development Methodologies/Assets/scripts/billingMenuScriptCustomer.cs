using System.Collections;
using System.Collections.Generic;
using UnityEngine;
using UnityEngine.UI;

public class billingMenuScriptCustomer : MonoBehaviour {
	public GameObject canvas;

	public Animator billingAnim;
	public InputField firstNameField;
	public InputField lastNameField;
	public InputField emailField;
	public InputField passwordField;

	public ToggleGroup toggleGroup;
	public Toggle monthlyToggle;
	public Toggle halfYearlyToggle;
	public Toggle yearlyToggle;

    public static double PAYGamount = 0.5;
    public activityManager activitymanager;

	// Use this for initialization
	void Start () {
		
	}

	public void backButtonProfileClicked(){

		billingAnim.Play ("profile background slide out");



	}

	public void profileActivated(){


	}

	public void buySubscription(){
		// May have several selected toggles
		string x = "";
		foreach( Toggle toggle in toggleGroup.ActiveToggles() ){
			x = toggle.name;
		}

		if (x == "monthly toggle") {


		} else if (x == "half yearly toggle") {



		} else if (x == "yearly toggle") {


		}





	}

    public void setPAYGamount(double PAYGamount)
    {
        billingMenuScriptCustomer.PAYGamount = PAYGamount;
    }

    public double getPAYGamount()
    {
        return billingMenuScriptCustomer.PAYGamount;
    }




}
