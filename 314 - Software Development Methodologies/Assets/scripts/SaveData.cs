using UnityEngine;
using System.Collections;
using System.Runtime.Serialization.Formatters.Binary;
using System.IO;
using System.Xml;
using System.Xml.Serialization;


public class SaveData{

	static public Customer loadCustomer(int id){
		Customer cus = new Customer();
		XmlSerializer serializer = new XmlSerializer (typeof(Customer));
		string text = PlayerPrefs.GetString (id.ToString ()); 
		if (text.Length == 0) {


		}else{
			using (var reader = new System.IO.StringReader (text)) {
				cus = serializer.Deserialize (reader)as Customer;

			}

		}
		return cus;
	}


	static public void saveCustomer(Customer cus){
		XmlSerializer serializer = new XmlSerializer (typeof(Customer));
		using (StringWriter sw = new StringWriter ()) {
			serializer.Serialize (sw, cus);
			PlayerPrefs.SetString (cus.getID ().ToString (), sw.ToString ());
			Debug.Log (sw.ToString ());

		}
	}

	static public Mechanic loadMechanic(int id){
		Mechanic mech = new Mechanic();
		XmlSerializer serializer = new XmlSerializer (typeof(Mechanic));
		string text = PlayerPrefs.GetString (id.ToString ()); 
		if (text.Length == 0) {
			Debug.Log ("cant find match for mechanic");

		}else{
			using (var reader = new System.IO.StringReader (text)) {
				mech = serializer.Deserialize (reader)as Mechanic;

			}

		}
		return mech;
	}


	static public void saveMechanic(Mechanic mech){
		XmlSerializer serializer = new XmlSerializer (typeof(Mechanic));
		using (StringWriter sw = new StringWriter ()) {
			serializer.Serialize (sw, mech);
			PlayerPrefs.SetString (mech.getID ().ToString (), sw.ToString ());
			Debug.Log (sw.ToString ());

		}
	}
    static public Staff loadStaff(int id)
    {
        Staff user = new Staff();
        XmlSerializer serializer = new XmlSerializer(typeof(Staff));
        string text = PlayerPrefs.GetString(id.ToString());
        if (text.Length == 0)
        {
            Debug.Log("cant find match for Staff");

        }
        else
        {
            using (var reader = new System.IO.StringReader(text))
            {
                user = serializer.Deserialize(reader) as Staff;

            }

        }
        return user;
    }
    static public void saveStaff(Staff user)
    {
        XmlSerializer serializer = new XmlSerializer(typeof(Staff));
        using (StringWriter sw = new StringWriter())
        {
            serializer.Serialize(sw, user);
            PlayerPrefs.SetString(user.getID().ToString(), sw.ToString());
            Debug.Log(sw.ToString());

        }
    }

    static public serviceRequestReceipt loadserviceRequestReciept(int id){
        serviceRequestReceipt cus = new serviceRequestReceipt();
		XmlSerializer serializer = new XmlSerializer (typeof(serviceRequestReceipt));
		string text = PlayerPrefs.GetString (id.ToString ()); 
		if (text.Length == 0) {
			Debug.Log ("cant find match for service request reciept");

		}else{
			using (var reader = new System.IO.StringReader (text)) {
				cus = serializer.Deserialize (reader)as serviceRequestReceipt;

			}

		}
		return cus;
	}


	static public void saveserviceRequestReciept(serviceRequestReceipt mech){
		XmlSerializer serializer = new XmlSerializer (typeof(serviceRequestReceipt));
		using (StringWriter sw = new StringWriter ()) {
			serializer.Serialize (sw, mech);
			PlayerPrefs.SetString (mech.customerId.ToString(), sw.ToString ());
			Debug.Log (sw.ToString ());

		}
	}

	public static float DistanceBetween(float lat1, float lon1, float lat2, float lon2)
	{
		float rlat1 = Mathf.PI*lat1/180f;
		float rlat2 = Mathf.PI*lat2/180f;
		float theta = lon1 - lon2;
		float rtheta = Mathf.PI*theta/180f;
		float dist =
			Mathf.Sin(rlat1)*Mathf.Sin(rlat2) + Mathf.Cos(rlat1)*
			Mathf.Cos(rlat2)*Mathf.Cos(rtheta);
		dist = Mathf.Acos(dist);
		dist = dist*180f/Mathf.PI;
		dist = dist*60f*1.1515f;


			return dist*1.609344f;
	


	}








}