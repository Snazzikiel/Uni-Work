using System.Collections;
using System.Collections.Generic;
using UnityEngine;


[System.Serializable]
public class Staff
{

    //used to add new, retrieve and delete staff members
    //Serializable dictionary item in loginActivity script
    string firstName;
    string lastName;
    string email;
    string password;
    string permission;
    int id;

    //public static List<Staff> allStaff;
    public Dictionary<int, Staff> dictionaryStaff;
    public List<string> permissionLevels = new List<string>() { "Admin", "FrontUser", "BackUser" };

    public Staff()
    {

    }

    public Staff(int id, string firstName, string lastName, string email, string password, string permission)
    {
        this.firstName = firstName;
        this.lastName = lastName;
        this.email = email;
        this.password = password;
        this.id = id;
        this.permission = permission;
    }

    //methods
    public void addUser(Staff tmpStaff)
    {
        dictionaryStaff.Add(tmpStaff.id, tmpStaff);
    }


    //get methods
    public int getID()
    {

        return id;
    }
    public string getFirstName()
    {

        return firstName;
    }
    public string getLastName()
    {

        return lastName;
    }
    public string getEmail()
    {

        return email;
    }
    public string getPassword()
    {

        return password;
    }
    public string getPermission()
    {
        return permission;
    }

    //set methods
    public void setFirstName(string firstName)
    {

        this.firstName = firstName;
    }
    public void setLastName(string lastName)
    {

        this.lastName = lastName;
    }
    public void setEmail(string email)
    {

        this.email = email;
    }
    public void setPassword(string password)
    {

        this.password = password;
    }
    public void setPermission(string permission)
    {
        this.permission = permission;
    }






}


