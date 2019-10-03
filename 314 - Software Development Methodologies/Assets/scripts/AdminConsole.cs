using System.Collections;
using System.Collections.Generic;
using UnityEngine;
using UnityEngine.UI;

public class AdminConsole : MonoBehaviour
{
    activityManager actManager;
    loginActivity actLogin;
    Customer tmpCustomer;
    Mechanic tmpMechanic;
    Staff tmpStaff;

    Dictionary<int, Customer> dictCustomer;// = new Dictionary<int, Customer>();
    Dictionary<int, Mechanic> dictMechanic;// = new Dictionary<int, Mechanic>();
    Dictionary<int, Staff> dictStaff;// = new Dictionary<int, Staff>();


    public Dropdown mainDrop;


    //Selection 1 and 2 -- Modify Customers or Mechancis
    public RectTransform modifyCustMech;
    bool userChoice = false; //true for customer edit, false for mechanic
    public Dropdown custMechSelection;
    public InputField firstName;
    public InputField lastName;
    public InputField email;
    public InputField changePassword;
    public Button saveCustMech;
    public Button deleteCustMech;

    //Selection 3 - Modify Users
    public RectTransform modifyUsers;
    public Dropdown userSelection;
    public InputField userFName;
    public InputField userLName;
    public InputField userEmail;
    public InputField userPass;
    public Dropdown userPermission;
    public Button saveUsers;
    public Button deleteUsers;

    //Selection 4 - View Requests
    public RectTransform viewRequests;
    public List<serviceRequestReceipt> serviceRequestReceipts = new List<serviceRequestReceipt>();
    public Text totalServiceRequest;
    public Dropdown serviceCustomerList;
    public ScrollRect receiptText;
    public Text receiptShow;


    //Selection 5 - Update Settings
    public InputField PAYG;
    public Button saveSettings;



    void Start()
    {
        actManager = transform.GetComponent<activityManager>();
        actLogin = transform.GetComponent<loginActivity>();

        dictCustomer = loginActivity.getCustomerDictionary();
        dictMechanic = loginActivity.getMechanicDictionary();
        dictStaff = loginActivity.getStaffDictionary();
    }

    void Update()
    {

    }

    public void mainDropDown_IndexChanged(int index)
    {
        //dictCustomer = actLogin.getCustomerDictionary();
        //dictMechanic = actLogin.getMechanicDictionary();
        //dictStaff = tmpStaff.dictionaryStaff;

        //dictUsers = actLogin.getUserDictionary();
        List<string> userList = new List<string>();

        //Fill boxes and hide layers
        switch (index)
        {
            case 1:
                if (dictCustomer == null)
                {
                    Customer tmpCustomer = new Customer(1, "harry", "hazelton", "h", "p");
                    dictCustomer.Add(tmpCustomer.getID(), tmpCustomer);
                }
                userChoice = true;
                foreach (KeyValuePair<int, Customer> cust in dictCustomer)
                {
                    userList.Add(cust.Value.getEmail());
                }

                break;

            case 2:
                if (dictMechanic == null)
                {
                    Mechanic tmpMechanic = new Mechanic(2, "Steve", "Harvey", "s", "p");
                    dictMechanic.Add(tmpMechanic.getID(), tmpMechanic);
                }
                userChoice = false;
                foreach (KeyValuePair<int, Mechanic> mech in dictMechanic)
                {
                    userList.Add(mech.Value.getEmail());
                }
                custMechSelection.AddOptions(userList);

                // modifyUsers.SetActive = false;
                //appSettings.SetActive = true;
                break;

            case 3:
                if (dictStaff == null)
                {
                    Staff tmpStaff = new Staff(3, "David", "Azzi", "d", "a", "Admin");
                }
                foreach (KeyValuePair<int, Staff> staf in dictStaff)
                {
                    userList.Add(staf.Value.getEmail());
                }
                //dunno the settings yet
                break;

            case 4: //service requests
                if (dictCustomer == null)
                {
                    Customer tmpCustomer = new Customer(1, "harry", "hazelton", "h", "p");
                    dictCustomer.Add(tmpCustomer.getID(), tmpCustomer);
                }
                userChoice = true;
                foreach (KeyValuePair<int, Customer> cust in dictCustomer)
                {
                    userList.Add(cust.Value.getEmail());
                }
                getServiceRequestList();
                fillTextWithServiceRequest();
                break;

            case 5: //application settings
                //PAYG textbox to be dealt with and change global static variable
                updateApplicationSettings();
                break;

            default:
                break;
        }


    }

    //Customer/Mechanic Update Selection
    public void custMechSelection_IndexChanged(int index)
    {
        if (userChoice)
        {
            tmpCustomer = dictCustomer[index];
            firstName.text = tmpCustomer.getFirstName();
            lastName.text = tmpCustomer.getLastName();
            email.text = tmpCustomer.getEmail();
            changePassword.text = tmpCustomer.getPassword();

        }
        else
        {
            tmpMechanic = dictMechanic[index];
            firstName.text = tmpMechanic.getFirstName();
            lastName.text = tmpMechanic.getLastName();
            email.text = tmpMechanic.getEmail();
            changePassword.text = tmpMechanic.getPassword();
        }
    }
    public void btnSave_mechCust_clicked()
    {
        if (firstName.text != "" || lastName.text != "" || email.text != "" || changePassword.text != "")
        {
            if (userChoice)
            {
                setCustomerDetails();
            }
            else
            {
                setMechanicDetails();
            }
        }
    }
    public void btnDelete_mechCust_clicked()
    {
        if (firstName.text != "" || lastName.text != "" || email.text != "" || changePassword.text != "")
        {
            if (userChoice)
            {
                dictCustomer.Remove(tmpCustomer.getID());
            }
            else
            {
                dictMechanic.Remove(tmpMechanic.getID());
            }
        }
    }

    public void setCustomerDetails()
    {
        string fName = firstName.text;
        string lName = lastName.text;
        string cEmail = email.text;
        string pass = changePassword.text;

        tmpCustomer.setFirstName(fName);
        tmpCustomer.setLastName(lName);
        tmpCustomer.setPassword(pass);
        tmpCustomer.setEmail(cEmail);
        dictCustomer[tmpCustomer.getID()] = tmpCustomer;
    }
    public void setMechanicDetails()
    {
        string fName = firstName.text;
        string lName = lastName.text;
        string cEmail = email.text;
        string pass = changePassword.text;

        tmpMechanic.setFirstName(fName);
        tmpMechanic.setLastName(lName);
        tmpMechanic.setPassword(pass);
        tmpMechanic.setEmail(cEmail);

        dictMechanic[tmpMechanic.getID()] = tmpMechanic;

    }


    //User Update
    public void userSelection_IndexChanged(int index)
    {
        tmpStaff = dictStaff[index];
        firstName.text = tmpStaff.getFirstName();
        lastName.text = tmpStaff.getLastName();
        email.text = tmpStaff.getEmail();
        changePassword.text = tmpStaff.getPassword();
        userPermission.SetValueWithoutNotify(tmpStaff.permissionLevels.IndexOf(tmpStaff.getPermission()));
    }

    public void setUserDetails()
    {
        string fName = firstName.text;
        string lName = lastName.text;
        string cEmail = email.text;
        string pass = changePassword.text;

        tmpStaff.setFirstName(fName);
        tmpStaff.setLastName(lName);
        tmpStaff.setPassword(pass);
        tmpStaff.setEmail(cEmail);
        tmpStaff.setPassword(pass);
        tmpStaff.setPermission(userPermission.options[userPermission.value].text);
        dictStaff[tmpStaff.getID()] = tmpStaff;
    }
    public void btnSave_user_clicked()
    {
        if (firstName.text != "" || lastName.text != "" || email.text != "" || changePassword.text != "")
        {
            setUserDetails();
        }
    }
    public void btnDelete_user_clicked()
    {
        if (firstName.text != "" || lastName.text != "" || email.text != "" || changePassword.text != "")
        {
            dictStaff.Remove(tmpStaff.getID());
        }
    }


    //Service Requests
    public void getServiceRequestList()
    {
        foreach (KeyValuePair<int, Customer> cust in dictCustomer)
        {
            if (cust.Value.getServiceRequestSize() >= 1)
            {
                for (int i = 0; i < cust.Value.getServiceRequestSize(); i++)
                {
                    serviceRequestReceipts.Add(cust.Value.getServiceRequest(i));
                }
            }
        }

    }
    public void fillTextWithServiceRequest()
    {
        string fillText = "";
        int iCounter = 1;
        if (serviceRequestReceipts.Count != 0)
        {
            foreach (serviceRequestReceipt sr in serviceRequestReceipts)
            {
                fillText += "Service Receipt# " + iCounter + "    (CustID# " + sr.getCustomerID() + ")\n";
                fillText += "Status: " + sr.getStatus() + "\n";
                fillText += "Car Model: " + sr.car.getModel() + "\n";
                fillText += "Car Year: " + sr.car.getYear() + "\n";
                fillText += "Customer Name: " + sr.getName() + "\n";
                fillText += "Mechanic ID: " + sr.getMechanicID() + "\n";
                fillText += "Price: " + sr.getPrice() + "\n";
                fillText += "\n\n";
                iCounter++;
            }
        }
        else
        {
            fillText = "No Service Requests have been logged for this customer.";
        }
        receiptShow.text = fillText;

    }

    //Application Settings
    public void updateApplicationSettings()
    {
        double PAYGretrieve;
        string PAYGstr = "";

        PAYGretrieve = billingMenuScriptCustomer.PAYGamount;
        PAYG.text = PAYGretrieve.ToString(PAYGstr);

    }
    public void btnSave_setting_clicked()
    {
        Debug.Log("PAYG: " + PAYG.text);
        Debug.Log("PAYG: " + billingMenuScriptCustomer.PAYGamount.ToString(PAYG.text));
        billingMenuScriptCustomer.PAYGamount = double.Parse(PAYG.text);
        Debug.Log("PAYG: " + PAYG.text);
        Debug.Log("PAYG: " + billingMenuScriptCustomer.PAYGamount.ToString(PAYG.text));
    }


}
