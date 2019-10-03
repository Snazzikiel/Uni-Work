using System.Collections;
using System.Collections.Generic;
using UnityEngine;

[System.Serializable]
public class serviceRequestReceipt
{
    public Car car;
    public string name;
    public float price;
    public int customerId;
    public int mechanicId;
    public int id;
    public int rating;
    public bool hasReviewed;
    public string comment;
    public int status;// 0 = awaiting acceptance from mechanic, 1 = mechanic accepted, 2 = finished



    // Use this for initialization
    void Start()
    {

    }

    public serviceRequestReceipt()
    {


    }


    public serviceRequestReceipt(int id, int customerId, string name, float price)
    {
        this.customerId = customerId;
        this.id = id;
        this.name = name;
        this.price = price;

    }

    public void setName(string name)
    {
        this.name = name;
    }

    public void setPrice(float price)
    {
        this.price = price;
    }

    public string getName()
    {
        return name;
    }

    public float getPrice()
    {
        return price;
    }

    public int getCustomerID()
    {
        return customerId;

    }

    public int getMechanicID()
    {
        return mechanicId;

    }

    public void setRating(int i)
    {
        rating = i;
    }

    public int getRating()
    {

        return rating;
    }

    public int getStatus()
    {
        return status;
    }

    public void setStatus(int i)
    {
        status = i;

    }

    public bool getHasReviewed()
    {

        return hasReviewed;

    }

    public void setHasReviewed(bool hasReviewed)
    {
        this.hasReviewed = hasReviewed;

    }



    //Service Receipts
    public List<serviceRequestReceipt> getCustomersServiceReceipts(Customer tmpCust)
    {
        List<serviceRequestReceipt> serviceRequestReceipts = new List<serviceRequestReceipt>();

        if (tmpCust.getServiceRequestSize() >= 1)
        {
            for (int i = 0; i < tmpCust.getServiceRequestSize(); i++)
            {
                serviceRequestReceipts.Add(tmpCust.getServiceRequest(i));
            }
        }

        return serviceRequestReceipts;
    }


}
