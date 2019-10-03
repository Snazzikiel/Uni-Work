using System.Collections;
using System.Collections.Generic;
using UnityEngine;

public class animationScript : MonoBehaviour {

	public Animator hamburgerMenuAnimCustomer;
	public Animator homeMenuBackgroundCustomer;
	public Animator hamburgerMenuFadeBackgroundCustomer;
	public Animator hamburgerMenuAnimMechanic;
	public Animator homeMenuBackgroundMechanic;
	public Animator hamburgerMenuFadeBackgroundMechanic;
	public Animator signUpBackground;

	// Use this for initialization
	void Start () {
		
	}
	
	public void playHamburgerMenuSlideInCustomer(){
		hamburgerMenuAnimCustomer.Play ("hamburger menu slide in");

	}

	public void playHamburgerMenuSlideInMechanic(){
		hamburgerMenuAnimMechanic.Play ("hamburger menu slide in");

	}


	public void playHamburgerMenuSlideOutCustomer(){
		hamburgerMenuAnimCustomer.Play ("hamburger menu slide out");


	}

	public void playHamburgerMenuSlideOutMechanic(){
		hamburgerMenuAnimMechanic.Play ("hamburger menu slide out");


	}

	public void playHomeMenuBackgroundSlideInCustomer(){

		homeMenuBackgroundCustomer.Play ("home menu background animation in");


	}

	public void playHomeMenuBackgroundSlideInMechanic(){

		homeMenuBackgroundMechanic.Play ("home menu background animation in");


	}

	public void playHomeMenuBackgroundSlideOutCustomer(){

		homeMenuBackgroundCustomer.Play ("home menu background animation out");


	}

	public void playHomeMenuBackgroundSlideOutMechanic(){

		homeMenuBackgroundMechanic.Play ("home menu background animation out");


	}

	public void playHamburgerMenuFadeBackgroundInCustomer(){
		hamburgerMenuFadeBackgroundCustomer.Play ("hamburger menu fade background in");

	}

	public void playHamburgerMenuFadeBackgroundInMechanic(){
		hamburgerMenuFadeBackgroundMechanic.Play ("hamburger menu fade background in");

	}

	public void playHamburgerMenuFadeBackgroundOutCustomer(){
		hamburgerMenuFadeBackgroundCustomer.Play ("hamburger menu fade background out");

	}

	public void playHamburgerMenuFadeBackgroundOutMechanic(){
		hamburgerMenuFadeBackgroundMechanic.Play ("hamburger menu fade background out");

	}

	public void playSignUpBackgroundSlideIn(){
		signUpBackground.Play ("sign up background slide in");

	}

	public void playSignUpBackgroundSlideOut(){
		signUpBackground.Play ("sign up background slide out");


	}

	public void disableMyGameObject(){
		transform.gameObject.SetActive (false);
	}
}
