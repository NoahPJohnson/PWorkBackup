using System.Collections;
using System.Collections.Generic;
using UnityEngine;
using UnityEngine.UI;
using UnityEngine.Networking;


//      The CustomObjectCollection serves as the connection between TreeObjectCollection and GridObjectCollection
//  to allow the GridObjectCollections in each DataObject to be displayed in a layored format based on TreeObjectCollection.
//
//
public class CustomObjectCollection : MonoBehaviour
{
    //The root boolean marks a DataObject as the origin of the tree and sets its data lists on Start()
    [SerializeField]
    bool root = false;


    //This is used in the ActivateAsContainer function to prevent the DataObject from being cleared along with its siblings
    [SerializeField]
    bool activeContainer = false;


    //SecretKey is currently unused.
    //private string secretKey = "mySecretKey"; // Edit this value and make sure it's the same as the one stored on the server
    
    //This is the URL for the PHP script that selects data from a MySQL Database.
    private string selectScriptURL = "http://prodigalcompany.com/npjTest/selectFromDatabase.php";

    //Text to display the result on
    //public Text statusText;


    //Reference to the DataObject prefab for spawning recursive child DataObjects at runtime.
    [SerializeField]
    GameObject dataObjectPrefab;


    //RowCount is primarily a debug variable.
    [SerializeField]
    int rowCount = 0;

    //DataList contains the extended results of the SELECT query
    List<string> DataList;

    //CodeList contains the first index of the results (The NAICS Code in this case.)
    List<string> CodeList;

    //DataObjectList is a reference to all the DataObjects that correspond to the data in the above lists.
    List<Transform> DataObjectList;

    //DataTree is the root node in which all the DataObjects beneath this one are included
    TreeObjectCollection<string> dataTree;

    

    void Start()
    {
        //If this is the Root DataObject in the tree, establish its parameters on Start()
        if (root == true)
        {
            dataObjectPrefab = (GameObject)Resources.Load("Prefabs/DataObject");
            StartCoroutine(GetDataFromSQL());
            DataList = new List<string>();
            CodeList = new List<string>();
            DataObjectList = new List<Transform>();
        }
        
    }

    /*public void UpdateMasterAttributeList()
    {

    }*/

    //Called to Instantiate new DataObjects and populate them with Data from their respective parents
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
        
    }

    //Simple Get() for the activeContainer variable
    public bool GetActiveContainer()
    {
        return activeContainer;
    }

    //Called when the user finishes manipulating this DataObject
    public void ActivateAsContainer()
    {
        //Case for DataObject displayed as a child
        if (activeContainer == false)
        {
            //Debug.Log("ACTIVATE");
            //Make sure this isn't the root and there is indeed a container above this 
            if (transform.parent.parent != null)
            {
                Transform parentContainer = transform.parent.parent;
                if (parentContainer.GetComponent<CustomObjectCollection>() != null)
                {
                    activeContainer = true;
                    for (int i = 0; i < parentContainer.childCount; i++)
                    {
                        //Deactivate all of this object's siblings
                        if (parentContainer.GetChild(i).GetChild(1).GetComponent<CustomObjectCollection>().GetActiveContainer() == false)
                        {
                            parentContainer.GetChild(i).gameObject.SetActive(false);
                        }
                    }
                }
            }
            //Instantiate this object's children
            for (int i = 0; i < dataTree.children.Count; i++)
            {
                //Debug.Log("New Children[" + i + "] = " + dataTree.children[i].data);
                GameObject dataObject = Instantiate(dataObjectPrefab, transform);
                dataObject.transform.GetChild(0).GetChild(0).GetChild(0).GetComponent<Text>().text = dataTree.children[i].data;
                DataObjectList.Add(dataObject.transform);
                dataObject.transform.GetChild(1).GetComponent<CustomObjectCollection>().SetDataLists(dataTree.children[i]);
            }
            //Add this object to a seperate collection of the Active Containers that hold the children currently displayed
            GetComponent<Microsoft.MixedReality.Toolkit.Utilities.GridObjectCollection>().UpdateCollection();
            GameObject.FindGameObjectWithTag("FixedView").GetComponent<StackObjectCollection>().PushContainerObject(transform.parent);
        }
        //Case for DataObject displayed and stored as a parent of the children currently displayed
        else
        {
            //Debug.Log("deactivate");
            //Remove and reset all the other parents above this one in the collection of parents
            Transform currentContainer = GameObject.FindGameObjectWithTag("FixedView").GetComponent<StackObjectCollection>().PopContainerObject().GetChild(1);
            while (currentContainer != null)
            {
                for (int i = 0; i < currentContainer.childCount; i++)
                {
                    GameObject.Destroy(currentContainer.GetChild(i).gameObject);
                }
                if (currentContainer.parent.parent != null)
                {
                    Transform parentContainer = currentContainer.parent.parent;
                    if (parentContainer.GetComponent<CustomObjectCollection>() != null)
                    {
                        activeContainer = false;
                        for (int i = 0; i < parentContainer.childCount; i++)
                        {
                            parentContainer.GetChild(i).gameObject.SetActive(true);
                        }
                        parentContainer.GetComponent<Microsoft.MixedReality.Toolkit.Utilities.GridObjectCollection>().UpdateCollection();
                    }
                }
                if (currentContainer == transform)
                {
                    break;
                }
                currentContainer = GameObject.FindGameObjectWithTag("FixedView").GetComponent<StackObjectCollection>().PopContainerObject().GetChild(1);

            }
        }
    }

    //This calls the PHP scripts which pull the data from SQL and fills the DataList and Code List accordingly, only called by the root
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

    //This fills the root's tree, again only the root does this, the other DataObjects simply copy from this tree
    IEnumerator BuildTree()
    {
        //Set an arbitrary root node for the tree, this shouldn't be displayed
        dataTree = new TreeObjectCollection<string>("Root");
        //The 2D List contains several rows of Trees organized by their NAICS Code digits
        List<TreeObjectCollection<string>>[] TwoDList = {new List<TreeObjectCollection<string>>(), new List<TreeObjectCollection<string>>(), new List<TreeObjectCollection<string>>(), new List<TreeObjectCollection<string>>() };
        for (int i = 0; i < CodeList.Count; i++)
        {
            //Debug.Log("DataList: " + i + " = " + CodeList[i] + " LENGTH = " + CodeList[i].Length);
            if (CodeList[i].Length == 2)
            {
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

        //Debug.Log("2dCount2 = " + TwoDList[0].Count);
        //Debug.Log("2dCount3 = " + TwoDList[1].Count);
        //Debug.Log("2dCount4 = " + TwoDList[2].Count);
        //Debug.Log("2dCount5 = " + TwoDList[3].Count);
        
        //Now that the 2D List is established, start from the bottom row and point the trees to their parents and those parents to them
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

    //This instantiates the DataObject's children and fills out their respective lists so they are prepared to spawn their own children
    IEnumerator GenerateCollection()
    {
        //Only do the first tier of children just beneath this DataObject 
        for (int i = 0; i < dataTree.children.Count; i++)
        {
            GameObject dataObject = Instantiate(dataObjectPrefab, transform);
            dataObject.transform.GetChild(0).GetChild(0).GetChild(0).GetComponent<Text>().text = dataTree.children[i].data;
            DataObjectList.Add(dataObject.transform);
            dataObject.transform.GetChild(1).GetComponent<CustomObjectCollection>().SetDataLists(dataTree.children[i]);
            //Debug.Log("Spawn data object: " + dataObject.transform.GetChild(0).GetChild(0).GetComponent<Text>().text);
            yield return null;
        }
        //Call the GridObjectCollection's UpdateCollection function to make sure the children are displayed properly 
        GetComponent<Microsoft.MixedReality.Toolkit.Utilities.GridObjectCollection>().UpdateCollection();
        //yield return null;
    }

    //Unused encryption function
    /*public string Md5Sum(string strToEncrypt)
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
    }*/


}
