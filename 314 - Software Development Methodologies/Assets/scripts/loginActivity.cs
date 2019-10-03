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

	public static Dictionary<int,Customer> dictionaryCustomer = new Dictionary<int, Customer>();
	public static Dictionary<int,Mechanic> dictionaryMechanic = new Dictionary<int, Mechanic>();
    public static Dictionary<int, Staff> dictionaryStaff = new Dictionary<int, Staff>();



    // sign up variables
    //public List<Customer> customer  = new List<Customer>();


    public InputField signUpFirstName;
	public InputField signUpLastName;
	public InputField signUpPassword;
	public InputField signUpEmail;

	public homeMenuScript homemenuscriptCustomer;
	public homeMenuScriptMechanic homemenuscriptmechanic;

	public int totalIDCount = 0;
	List<int> listOfCustomerID = new List<int>();
	List<int> listOfMechanicID = new List<int>();
    List<int> listOfStaffID = new List<int>();

    public List<serviceRequestReceipt> serviceRequestReciepts = new List <serviceRequestReceipt>();


	// Use this for initialization
	void Start () {


		animationscript = transform.GetComponent<animationScript>();
		activitymanager = transform.GetComponent<activityManager> ();


		//creating customers
		//Customer customer1 = new Customer(1,"harry","hazelton","h","p");
		//Customer customer2 = new Customer(2,"Connor","Jones","c","p");

		//adding customers to dictionary

		//dictionaryCustomer.Add (customer1.getID(), customer1);
		//dictionaryCustomer.Add (customer2.getID(), customer2);



		//Mechanic mechanic1 = new Mechanic(3,"Steve","Harvey","s","p");
		//Mechanic mechanic2 = new Mechanic(4,"Aladin","Harvey","a","p");

		//adding mechanics to dictionary
		//dictionaryMechanic.Add (mechanic1.getID, mechanic1);
		//dictionaryMechanic.Add (mechanic2.getID, mechanic2);

		//use to delete all saved variables
		//PlayerPrefs.DeleteAll ();

		loadTotalIDCount();
		loadCustomerIDList ();
		loadCustomersIntoDictionary ();

		loadMechanicIDList ();
		loadMechanicsIntoDictionary ();

		loadReciepts ();
		activitymanager.serviceRequestReceipts = serviceRequestReciepts;
		print(activitymanager.serviceRequestReceipts.Count);

        // creating customers
        if (dictionaryCustomer.Count == 0)
        {
            Customer customer1 = new Customer(1, "harry", "hazelton", "h", "p");
            Customer customer2 = new Customer(2, "Connor", "Jones", "c", "p");

            //adding customers to dictionary
            listOfCustomerID.Add(1);
            listOfCustomerID.Add(2);
            saveCustomer(customer1);
            saveCustomer(customer2);
            dictionaryCustomer.Add(customer1.getID(), customer1);
            dictionaryCustomer.Add(customer2.getID(), customer2);
        }
        if (dictionaryMechanic.Count == 0)
        {
            Mechanic mechanic1 = new Mechanic(3, "Steve", "Harvey", "s", "p");
            Mechanic mechanic2 = new Mechanic(4, "Aladin", "Harvey", "a", "p");

            //adding mechanics to dictionary
            listOfMechanicID.Add(3);
            listOfMechanicID.Add(4);
            saveMechanic(mechanic1);
            saveMechanic(mechanic2);
            dictionaryMechanic.Add(mechanic1.getID(), mechanic1);
            dictionaryMechanic.Add(mechanic2.getID(), mechanic2);
        }
        if (dictionaryStaff.Count == 0)
        {
            Staff staff1 = new Staff(5, "David", "Azzi", "d", "a", "admin");
            Staff staff2 = new Staff(6, "Peter", "Alexander", "d", "a", "frontend");
            listOfStaffID.Add(5);
            listOfStaffID.Add(6);
            saveStaff(staff1);
            saveStaff(staff2);
            dictionaryStaff.Add(staff1.getID(), staff1);
            dictionaryStaff.Add(staff2.getID(), staff2);
        }



    }
	
	// Update is called once per frame
	void Update () {
		
	}
	//saving and loading methods
	public void loadCustomersIntoDictionary(){
		for (int i = 0; i < listOfCustomerID.Count; i++) {
			
			dictionaryCustomer.Add (listOfCustomerID [i], SaveData.loadCustomer (listOfCustomerID [i]));


		}

	}

	public void loadMechanicsIntoDictionary(){
		for (int i = 0; i < listOfMechanicID.Count; i++) {
			dictionaryMechanic.Add (listOfMechanicID [i], SaveData.loadMechanic (listOfMechanicID [i]));

		}

	}
    public void loadStaffIntoDictionary()
    {
        for (int i = 0; i < listOfStaffID.Count; i++)
        {
            dictionaryStaff.Add(listOfStaffID[i], SaveData.loadStaff(listOfStaffID[i]));

        }

    }

    //customer save/load
    public void saveCustomer(Customer a){
		if (listOfCustomerID.Contains (a.getID ())) {


		} else {
			listOfCustomerID.Add (a.getID ());
			saveCustomerIDList ();
		}

		SaveData.saveCustomer(a);

	}

	public void loadCustomerIDList(){
		int[] tempCustomerList;

		tempCustomerList = PlayerPrefsX.GetIntArray ("listOfCustomerID");
		//print (tempCustomerList.Length);
		for(int i = 0; i < tempCustomerList.Length; i++){
			
			listOfCustomerID.Add(tempCustomerList [i]);
			print (listOfCustomerID[i]);

		}


	}
	public void saveCustomerIDList(){
		int[] tempCustomerList = new int[listOfCustomerID.Count];
		for(int i = 0; i < listOfCustomerID.Count; i++){
			tempCustomerList [i] = listOfCustomerID [i];


		}
		PlayerPrefsX.SetIntArray ("listOfCustomerID",tempCustomerList);


	}

	//mechanic save/load

	public void saveMechanic(Mechanic a){

		if (listOfMechanicID.Contains (a.getID ())) {


		} else {
			listOfMechanicID.Add (a.getID ());
			saveMechanicIDList ();
		}

		SaveData.saveMechanic(a);

	}

	public void loadMechanicIDList(){
		int[] tempMechanicList;

		tempMechanicList = PlayerPrefsX.GetIntArray ("listOfMechanicID");
		for(int i = 0; i < tempMechanicList.Length; i++){

			listOfMechanicID.Add(tempMechanicList [i]);


		}

	}
	public void saveMechanicIDList(){
		int[] tempMechanicList = new int[listOfMechanicID.Count];
		for(int i = 0; i < listOfMechanicID.Count; i++){
			tempMechanicList [i] = listOfMechanicID [i];


		}
		PlayerPrefsX.SetIntArray ("listOfMechanicID",tempMechanicList);


	}

    //User save/load
    public void saveStaff(Staff a)
    {

        if (listOfStaffID.Contains(a.getID()))
        {


        }
        else
        {
            listOfStaffID.Add(a.getID());
            saveStaffIDList();
        }

        //SaveData.saveStaff(a);

    }
    public void loadStaffIDList()
    {
        int[] tempStaffList;

        tempStaffList = PlayerPrefsX.GetIntArray("listOfStaffID");
        for (int i = 0; i < tempStaffList.Length; i++)
        {

            listOfStaffID.Add(tempStaffList[i]);


        }

    }
    public void saveStaffIDList()
    {
        int[] tempStaffList = new int[listOfStaffID.Count];
        for (int i = 0; i < listOfStaffID.Count; i++)
        {
            tempStaffList[i] = listOfStaffID[i];


        }
        PlayerPrefsX.SetIntArray("listOfStaffID", tempStaffList);


    }


    public void loadReciepts(){
		for (int i = 0; i< listOfCustomerID.Count; i++) {
			if (dictionaryCustomer.ContainsKey (listOfCustomerID [i])) {
				//accessed customer
				//dictionaryCustomer [listOfCustomerID [i]].serviceRequestReciepts
				for(int b = 0; b < dictionaryCustomer [listOfCustomerID [i]].serviceRequestReceipts.Count; b++){
					//access reciepts in customer
					serviceRequestReciepts.Add(dictionaryCustomer [listOfCustomerID [i]].serviceRequestReceipts[b]);
					print (dictionaryCustomer [listOfCustomerID [i]].serviceRequestReceipts[b].name);
				}
			}

		}
	}

	public void saveReceipt(int customerid, serviceRequestReceipt a){
		int index;
		if (doesCustomerContainReciept (customerid, a)) {
			index = getCustomerMatchingReciept (customerid, a);
			dictionaryCustomer [customerid].serviceRequestReceipts[index] = a;
			
		} else {
			dictionaryCustomer [customerid].serviceRequestReceipts.Add (a);


		}

		for (int i = 0; i < dictionaryCustomer [customerid].serviceRequestReceipts.Count; i++) {
			if (dictionaryCustomer [customerid].serviceRequestReceipts[i].id == a.id) {
			}

		}

		saveCustomer (dictionaryCustomer [customerid]);
	}

	public bool doesCustomerContainReciept(int customerid, serviceRequestReceipt a){
		bool answer = false;
		for (int i = 0; i < dictionaryCustomer [customerid].serviceRequestReceipts.Count; i++) {
			if (dictionaryCustomer [customerid].serviceRequestReceipts[i].id == a.id) {
				answer = true;

			}




		}
		return answer;
	}

	public int getCustomerMatchingReciept(int customerid, serviceRequestReceipt a){
		int index = 0;
		for (int i = 0; i < dictionaryCustomer [customerid].serviceRequestReceipts.Count; i++) {
			if (dictionaryCustomer [customerid].serviceRequestReceipts[i].id == a.id) {
				index = i;

			}




		}
		return index;
	}


	public void saveTotalIDCount(){
		PlayerPrefs.SetInt("totalIDCount",totalIDCount);
	}

	public void loadTotalIDCount(){
		totalIDCount = PlayerPrefs.GetInt ("totalIDCount");
	}

	// getting customer
	public bool dictionaryContainsCustomerEmail(string email){
		bool a = false;
		for (int i = 0; i < listOfCustomerID.Count; i++) {
			if (dictionaryCustomer.ContainsKey (listOfCustomerID [i])) {

				if (dictionaryCustomer [listOfCustomerID [i]].getEmail () == email) {
					//customer with matching email found
					a = true;
				}
			}
		}

		return a;

	}
	public Customer getCustomerByEmail(string email){
		Customer a = new Customer ();
		for (int i = 0; i < listOfCustomerID.Count; i++) {
			if (dictionaryCustomer.ContainsKey (listOfCustomerID [i])) {
				
				if (dictionaryCustomer [listOfCustomerID [i]].getEmail () == email) {
					//customer with matching email found
					a = dictionaryCustomer [listOfCustomerID [i]];
				}
			}
		}
		return a;

	}

	//getting mechanic

	public bool dictionaryContainsMechanicEmail(string email){
		bool a = false;
		for (int i = 0; i < listOfMechanicID.Count; i++) {
			if (dictionaryMechanic.ContainsKey (listOfMechanicID [i])) {

				if (dictionaryMechanic [listOfMechanicID [i]].getEmail () == email) {
					//customer with matching email found
					a = true;
				}
			}
		}

		return a;

	}
	public Mechanic getMechanicByEmail(string email){
		Mechanic a = new Mechanic ();
		for (int i = 0; i < listOfMechanicID.Count; i++) {
			if (dictionaryMechanic.ContainsKey (listOfMechanicID [i])) {

				if (dictionaryMechanic [listOfMechanicID [i]].getEmail () == email) {
					//customer with matching email found
					a = dictionaryMechanic [listOfMechanicID [i]];
				}
			}
		}
		return a;

	}

    //getting staff
    public bool dictionaryContainsStaffEmail(string email)
    {
        bool a = false;
        for (int i = 0; i < listOfStaffID.Count; i++)
        {
            if (dictionaryStaff.ContainsKey(listOfStaffID[i]))
            {

                if (dictionaryStaff[listOfStaffID[i]].getEmail() == email)
                {
                    //customer with matching email found
                    a = true;
                }
            }
        }

        return a;

    }
    public Staff getStaffByEmail(string email)
    {
        Staff a = new Staff();
        for (int i = 0; i < listOfStaffID.Count; i++)
        {
            if (dictionaryStaff.ContainsKey(listOfStaffID[i]))
            {

                if (dictionaryStaff[listOfStaffID[i]].getEmail() == email)
                {
                    //customer with matching email found
                    a = dictionaryStaff[listOfStaffID[i]];
                }
            }
        }
        return a;

    }



    public void signInClicked(){
		
		// checking login for customers
		errorMessage = "";
		if (dictionaryContainsCustomerEmail (email.text)) {
			//dictionary does contain customer with email
				
			//correct email, now checking password
			if (getCustomerByEmail (email.text).getPassword () == password.text) {
				//correct password
				errorMessage = "login successful";
				// login customer
				activitymanager.setCustomerLoggedIn (getCustomerByEmail (email.text));

				changeActivityToHomeMenuCustomer ();

			} else {
				//correct email, incorrect password

				errorMessage = "Incorrect Password";
			}
			// checking login for mechanics
		} else if (dictionaryContainsMechanicEmail (email.text)) {
			print ("contains mechanic");
			//dictionary does contain mechanic with email

			//correct email, now checking password
			if (getMechanicByEmail (email.text).getPassword () == password.text) {
				//correct password
				errorMessage = "login successful";
				// login customer
				activitymanager.setMechanicLoggedIn (getMechanicByEmail (email.text));

				changeActivityToHomeMenuMechanic ();
			} else {
				//correct email, incorrect password

				errorMessage = "Incorrect Password";
			}
		}
        else if (dictionaryContainsStaffEmail(email.text))
        {
            print("contains user");

            //correct email, now checking password
            if (getStaffByEmail(email.text).getPassword() == password.text)
            {
                //correct password
                errorMessage = "login successful";
                // login customer
                activitymanager.setStaffLoggedIn(getStaffByEmail(email.text));

                changeActivityToHomeMenuStaff();
            }
            else
            {
                //correct email, incorrect password

                errorMessage = "Incorrect Password-staff";
            }
        }
        if (errorMessage == "") {
			errorMessage = "Incorrect username";
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

    public void changeActivityToHomeMenuStaff()
    {
        //AdminConsole.SetActive(true);
        //animationscript.playHomeMenuBackgroundSlideInStaff();
        //homemenuscriptstaff.createRowsOfRequests();
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
			if (!dictionaryContainsMechanicEmail(signUpEmail.text)) {
				totalIDCount++;
				saveTotalIDCount ();
				//creates customer account by adding customer object to dictionary
				Mechanic mechanica;
				mechanica = new Mechanic (totalIDCount, signUpFirstName.text, signUpLastName.text, signUpEmail.text, signUpPassword.text);
				dictionaryMechanic.Add (totalIDCount, mechanica);
				saveMechanic (mechanica);
				SSTools.ShowMessage ("new account created", SSTools.Position.bottom, SSTools.Time.twoSecond);
			} else {
				SSTools.ShowMessage ("email account already in use", SSTools.Position.bottom, SSTools.Time.twoSecond);


			}
		} else {
			//checks if email already in use
			if (!dictionaryContainsCustomerEmail(signUpEmail.text)) {
				totalIDCount++;
				saveTotalIDCount ();
				//creates customer account by adding customer object to dictionary
				Customer customera;
				customera = new Customer (totalIDCount, signUpFirstName.text, signUpLastName.text, signUpEmail.text, signUpPassword.text);
				dictionaryCustomer.Add (totalIDCount, customera);
				saveCustomer (customera);
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

	public void editCustomerInfo(int id){
		//print (dictionaryCustomer [activitymanager.getCustomerLoggedIn().getEmail()].getLastName());

		dictionaryCustomer.Remove (id);
		dictionaryCustomer.Add (activitymanager.getCustomerLoggedIn ().getID(), activitymanager.getCustomerLoggedIn ());

	}


	public void editMechanicInfo(int id){
		//print (dictionaryCustomer [activitymanager.getCustomerLoggedIn().getEmail()].getLastName());

		dictionaryMechanic.Remove (id);
		dictionaryMechanic.Add (activitymanager.getMechanicLoggedIn ().getID(), activitymanager.getMechanicLoggedIn ());

	}

    public static Dictionary<int, Customer> getCustomerDictionary()
    {
        Dictionary<int, Customer> tmpDict = new Dictionary<int, Customer>();

        if (getCustomerDictionarySize() >= 1)
        {
            return dictionaryCustomer;

        }
        else
        {
            return tmpDict;
        }

    }
    public static Dictionary<int, Mechanic> getMechanicDictionary()
    {
        Dictionary<int, Mechanic> tmpDict = new Dictionary<int, Mechanic>();

        if (getMechanicDictionarySize() >= 1)
        {
            return dictionaryMechanic;

        }
        else
        {
            return tmpDict;
        }
    }
    public static Dictionary<int, Staff> getStaffDictionary()
    {
        Dictionary<int, Staff> tmpDict = new Dictionary<int, Staff>();

        if (getStaffDictionarySize() >= 1)
        {
            return dictionaryStaff;
        }
        else
        {
            return tmpDict;
        }
    }

    public static int getCustomerDictionarySize()
    {
        return dictionaryCustomer.Count;
    }
    public static int getMechanicDictionarySize()
    {
        return dictionaryMechanic.Count;
    }
    public static int getStaffDictionarySize()
    {
        return dictionaryStaff.Count;
    }



}
