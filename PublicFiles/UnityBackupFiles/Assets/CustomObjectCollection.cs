using System.Collections;
using System.Collections.Generic;
using UnityEngine;
using UnityEngine.UI;
using UnityEngine.Networking;

public class CustomObjectCollection : MonoBehaviour
{
    [SerializeField]
    bool root = false;

    [SerializeField]
    bool activeContainer = false;

    private string secretKey = "mySecretKey"; // Edit this value and make sure it's the same as the one stored on the server
    private string selectScriptURL = "http://prodigalcompany.com/npjTest/selectFromDatabase.php";

    //Text to display the result on
    //public Text statusText;

    [SerializeField]
    GameObject dataObjectPrefab;

    [SerializeField]
    int rowCount = 0;
    List<string> DataList;
    List<string> CodeList;
    List<Transform> DataObjectList;
    TreeObjectCollection<string> dataTree;

    void Start()
    {
        
        if (root == true)
        {
            dataObjectPrefab = (GameObject)Resources.Load("Prefabs/DataObject");
            StartCoroutine(GetDataFromSQL());
            DataList = new List<string>();
            CodeList = new List<string>();
            DataObjectList = new List<Transform>();
        }
        
    }

    public void UpdateMasterAttributeList()
    {

    }

    public void SetDataLists(TreeObjectCollection<string> DataTreeToSet)
    {
        dataObjectPrefab = (GameObject)Resources.Load("Prefabs/DataObject");
        DataList = new List<string>();
        CodeList = new List<string>();
        DataObjectList = new List<Transform>();
        DataList = DataTreeToSet.ToList();
        for (int i = 0; i < DataList.Count; i++)
        {
            CodeList.Add(DataList[i].Split('|')[0].Trim());
        }
        dataTree = DataTreeToSet;
        /*for (int i = 0; i < dataTree.children.Count; i++)
        {
            //Debug.Log("New Children[" + i + "] = " + dataTree.children[i].data);
            GameObject dataObject = Instantiate(dataObjectPrefab, transform);
            dataObject.transform.GetChild(0).GetChild(0).GetComponent<Text>().text = dataTree.children[i].data;
            DataObjectList.Add(dataObject.transform);
            dataObject.transform.GetChild(1).GetComponent<CustomObjectCollection>().SetDataLists(dataTree.children[i]);
        }*/
        
        
    }

    public bool GetActiveContainer()
    {
        return activeContainer;
    }

    public void ActivateAsContainer()
    {
        Debug.Log("ACTIVATE");
        if (transform.parent.parent != null)
        {
            Transform parentContainer = transform.parent.parent;
            if (parentContainer.GetComponent<CustomObjectCollection>() != null)
            {
                activeContainer = true;
                for (int i = 0; i < parentContainer.childCount; i++)
                {
                    if (parentContainer.GetChild(i).GetChild(1).GetComponent<CustomObjectCollection>().GetActiveContainer() == false)
                    {
                        parentContainer.GetChild(i).gameObject.SetActive(false);
                    }
                }
            }
        }
        for (int i = 0; i < dataTree.children.Count; i++)
        {
            //Debug.Log("New Children[" + i + "] = " + dataTree.children[i].data);
            GameObject dataObject = Instantiate(dataObjectPrefab, transform);
            dataObject.transform.GetChild(0).GetChild(0).GetComponent<Text>().text = dataTree.children[i].data;
            DataObjectList.Add(dataObject.transform);
            dataObject.transform.GetChild(1).GetComponent<CustomObjectCollection>().SetDataLists(dataTree.children[i]);
        }
        GetComponent<Microsoft.MixedReality.Toolkit.Utilities.GridObjectCollection>().UpdateCollection();
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
                CodeList.Add(DataList[i].Split('|')[0].Trim());
                
                rowCount++;
                //yield return null;
                //Debug.Log(DataList[i]);
            }
        }
        Debug.Log(rowCount);
        StartCoroutine(BuildTree());
        //StartCoroutine(GenerateCollection());
    }

    IEnumerator BuildTree()
    {
        dataTree = new TreeObjectCollection<string>("Root");
        TreeObjectCollection<string> tempRoot = dataTree;
        List<TreeObjectCollection<string>>[] TwoDList = {new List<TreeObjectCollection<string>>(), new List<TreeObjectCollection<string>>(), new List<TreeObjectCollection<string>>(), new List<TreeObjectCollection<string>>() };
        //Debug.Log("WTF: " + tempRoot.data + " UH: " + tempRoot.children);
        for (int i = 0; i < CodeList.Count; i++)
        {
            //Debug.Log("DataList: " + i + " = " + CodeList[i] + " LENGTH = " + CodeList[i].Length);
            if (CodeList[i].Length == 2)
            {
                //TreeObjectCollection<string> childToAdd = new TreeObjectCollection<string>(CodeList[i], tempRoot);
                
                //tempRoot.AddChildNode(childToAdd);
                TwoDList[0].Add(new TreeObjectCollection<string>(DataList[i], dataTree));
                dataTree.children.Add(TwoDList[0][TwoDList[0].Count - 1]);
                //Debug.Log("Root child: " + dataTree.children[dataTree.children.Count - 1].data);
            }
            else if (CodeList[i].Length == 3)
            {
                TwoDList[1].Add(new TreeObjectCollection<string>(DataList[i]));
            }
            else if (CodeList[i].Length == 4)
            {
                TwoDList[2].Add(new TreeObjectCollection<string>(DataList[i]));
            }
            else if (CodeList[i].Length >= 5)
            {
                TwoDList[3].Add(new TreeObjectCollection<string>(DataList[i]));
            }
            //yield return null;
        }

        Debug.Log("2dCount2 = " + TwoDList[0].Count);
        Debug.Log("2dCount3 = " + TwoDList[1].Count);
        Debug.Log("2dCount4 = " + TwoDList[2].Count);
        Debug.Log("2dCount5 = " + TwoDList[3].Count);
        //TreeObjectCollection<string> currentParent = new TreeObjectCollection<string>();
        for (int i = 3; i > 0; i--)
        {
            for (int j = 0; j < TwoDList[i].Count; j++)
            {
                for (int k = 0; k < TwoDList[i - 1].Count; k++)
                {
                    if (TwoDList[i][j].data.StartsWith(TwoDList[i-1][k].data.Split('|')[0].Trim()))
                    {
                        TwoDList[i][j].parent = TwoDList[i - 1][k];
                        TwoDList[i][j].parent.children.Add(TwoDList[i][j]);
                        //Debug.Log("Data = " + TwoDList[i][j].data + " Parent = " + TwoDList[i][j].parent.data);
                    }
                    //yield return null;
                }
            }
        }
        //Debug.Log("All Done.");
        StartCoroutine(GenerateCollection());
        yield return null;
    }

    IEnumerator GenerateCollection()
    {
        //Debug.Log("Hey");
        for (int i = 0; i < dataTree.children.Count; i++)
        {
            GameObject dataObject = Instantiate(dataObjectPrefab, transform);
            dataObject.transform.GetChild(0).GetChild(0).GetComponent<Text>().text = dataTree.children[i].data;
            DataObjectList.Add(dataObject.transform);
            dataObject.transform.GetChild(1).GetComponent<CustomObjectCollection>().SetDataLists(dataTree.children[i]);
            /*for (int j = 0; j < dataTree.children[i].ToList().Count; j++)
            {
                Debug.Log("TreeToList: " + dataTree.children[i].ToList()[j]);
            }*/
            //Debug.Log("Spawn data object: " + dataObject.transform.GetChild(0).GetChild(0).GetComponent<Text>().text);
            yield return null;
        }
        GetComponent<Microsoft.MixedReality.Toolkit.Utilities.GridObjectCollection>().UpdateCollection();
        //yield return null;
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


}
