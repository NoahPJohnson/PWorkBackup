using System.Collections;
using System.Collections.Generic;
using UnityEngine;

public class StackObjectCollection : MonoBehaviour
{
    // Start is called before the first frame update

    List<Transform> objectStack;
    [SerializeField]
    Vector3 containerPositionOffset = new Vector3(0,1,1);
    float offsetX = 0;
    void Start()
    {
        objectStack = new List<Transform>();   
    }

    public void PushContainerObject(Transform newContainer)
    {
        objectStack.Add(newContainer);
        ArrangeObjectsInStack();
    }

    void ArrangeObjectsInStack()
    {
        for (int i = 0; i < objectStack.Count; i++)
        {
            offsetX = (-objectStack.Count + (1+(i*2)));
            objectStack[i].SetPositionAndRotation(transform.position + (containerPositionOffset + new Vector3(offsetX,0,0)), transform.rotation);
        }
    }
}
