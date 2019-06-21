using System.Collections;
using System.Collections.Generic;
using UnityEngine;
using UnityEngine.UI;
using UnityEngine.Networking;

public class CustomObjectCollection : MonoBehaviour
{
    private string secretKey = "mySecretKey"; // Edit this value and make sure it's the same as the one stored on the server
    private string selectScriptURL = "http://prodigalcompany.com/npjTest/selectFromDatabase.php";

    //Text to display the result on
    //public Text statusText;

    [SerializeField]
    GameObject dataObjectPrefab;

    [SerializeField]
    int rowCount = 0;
    List<string> DataList;
    List<Transform> DataObjectList;
    void Start()
    {
        StartCoroutine(GetDataFromSQL());
        
        DataList = new List<string>();
        DataObjectList = new List<Transform>();
    }

    public void UpdateMasterAttributeList()
    {

    }

    IEnumerator GetDataFromSQL()
    {
        Debug.Log("Loading Data");
        UnityWebRequest selectStatement = UnityWebRequest.Get(selectScriptURL);
        yield return selectStatement.SendWebRequest();

        if (selectStatement.error != null)
        {
            Debug.Log("There was an error getting the data: " + selectStatement.error);
        }
        else
        {
            Debug.Log("Text:" + selectStatement.downloadHandler.text); // this is a GUIText that will display the scores in game.
            string outputText = selectStatement.downloadHandler.text;
            string[] outputArray = outputText.Split('~');
            for (int i = 0; i < outputArray.Length; i++)
            {
                DataList.Add(outputArray[i]);
                rowCount++;
                Debug.Log(DataList[i]);
            }
        }
        Debug.Log(rowCount);
        GenerateCollection();
    }

    public string Md5Sum(string strToEncrypt)
    {
        System.Text.UTF8Encoding ue = new System.Text.UTF8Encoding();
        byte[] bytes = ue.GetBytes(strToEncrypt);

        // encrypt bytes
        System.Security.Cryptography.MD5CryptoServiceProvider md5 = new System.Security.Cryptography.MD5CryptoServiceProvider();
        byte[] hashBytes = md5.ComputeHash(bytes);

        // Convert the encrypted bytes back to a string (base 16)
        string hashString = "";

        for (int i = 0; i < hashBytes.Length; i++)
        {
            hashString += System.Convert.ToString(hashBytes[i], 16).PadLeft(2, '0');
        }

        return hashString.PadLeft(32, '0');
    }

    public void GenerateCollection()
    {
        for (int i = 0; i < 20; i++)
        {
            GameObject dataObject = Instantiate(dataObjectPrefab, transform);
            dataObject.transform.GetChild(0).GetChild(0).GetComponent<Text>().text = DataList[i].Split('|')[0];
            DataObjectList.Add(dataObject.transform);
        }
        GetComponent<Microsoft.MixedReality.Toolkit.Utilities.GridObjectCollection>().UpdateCollection();
    }
}
