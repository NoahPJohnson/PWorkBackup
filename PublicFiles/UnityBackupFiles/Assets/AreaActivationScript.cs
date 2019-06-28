using System.Collections;
using System.Collections.Generic;
using UnityEngine;

public class AreaActivationScript : MonoBehaviour
{
    [SerializeField]
    bool inActiveArea = false;

    [SerializeField]
    Transform activeArea = null;

    [SerializeField]
    Color activatedColor;

    [SerializeField]
    Color deactivatedColor;

    void OnTriggerEnter(Collider other)
    {
        Debug.Log("Entered.");
        if (other.tag == "Area")
        {
            //other.GetComponent<MeshRenderer>().material
            if (inActiveArea == false && other.transform != activeArea)
            {
                inActiveArea = true;
                activeArea = other.transform;
            }
        }
    }

    void OnTriggerExit(Collider other)
    {
        if (other.tag == "Area")
        {
            //other.GetComponent<MeshRenderer>().material
            if (inActiveArea == true && other.transform == activeArea)
            {
                inActiveArea = false;
                activeArea = null;
            }
        }
    }

    public bool GetInActiveArea()
    {
        return inActiveArea;
    }

    public Transform GetActiveArea()
    {
        return activeArea;
    }
}
