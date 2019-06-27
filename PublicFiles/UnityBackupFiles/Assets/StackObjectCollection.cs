using System.Collections;
using System.Collections.Generic;
using UnityEngine;

//      The StackObjectCollection contains the parents of the children currently displayed, AKA the Active Containers, this
//  allows users to travel up and down the branches of the tree of DataObjects with relative ease.
//  
public class StackObjectCollection : MonoBehaviour
{
    //The central data structure of this class, a List restricted to push and pop operations, not a true stack
    List<Transform> objectStack;


    //The first containerPositionOffset is for bringing the parent to the proper center for displaying its children
    [SerializeField]
    Vector3 containerPositionOffset = new Vector3(0,1,1);

    //The second containerOffsetPosition is for the Active Container's avatar to be displayed seperately from its children
    [SerializeField]
    Vector3 containerPositionOffset2 = new Vector3(-2, 0.3f, 0.5f);
    
    
    //OffsetX is for arranging the dynamic list of active containers horizontally
    float offsetX = 0;

    //OffsetX is for arranging the dynamic list of active containers vertically
    float offsetY = 0;


    //Set up an empty stack on Start()
    void Start()
    {
        objectStack = new List<Transform>();   
    }

    //This is the only way to Insert new Active Containers, by adding them to the top of the stack
    public void PushContainerObject(Transform newContainer)
    {
        objectStack.Add(newContainer);
        ArrangeObjectsInStack();
    }

    //This is the only way to retrieve and remove Active Containers, by referencing the top of the stack and removing it 
    public Transform PopContainerObject()
    {
        Transform containerToReturn = objectStack[objectStack.Count - 1];
        objectStack.RemoveAt(objectStack.Count - 1);
        containerToReturn.GetChild(0).SetPositionAndRotation(containerToReturn.position, containerToReturn.rotation);
        containerToReturn.GetChild(1).GetComponent<Microsoft.MixedReality.Toolkit.Utilities.GridObjectCollection>().UpdateCollection();
        return containerToReturn;
    }

    //Calculates offsetX and offsetY and rearranges the Active Containers accordingly as well as updating the current container's collection
    void ArrangeObjectsInStack()
    {
        for (int i = 0; i < objectStack.Count; i++)
        {
            offsetX = (-objectStack.Count + (1+(i*2)));
            offsetY = (-objectStack.Count + (1+(i*2)));
            objectStack[i].SetPositionAndRotation(transform.position + (containerPositionOffset), transform.rotation);
            objectStack[i].GetChild(1).GetComponent<Microsoft.MixedReality.Toolkit.Utilities.GridObjectCollection>().UpdateCollection();
            objectStack[i].GetChild(0).SetPositionAndRotation(transform.position + (containerPositionOffset2 + new Vector3(0,offsetY,0)), Quaternion.Euler(0,-90,0));
            //Debug.Log("Object Stack " + i + " new position = " + objectStack[i].position + " == " + (transform.position + (containerPositionOffset + new Vector3(offsetX, 0, 0))));
        }
    }
}
