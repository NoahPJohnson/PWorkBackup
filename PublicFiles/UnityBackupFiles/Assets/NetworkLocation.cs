using System.Collections;
using System.Collections.Generic;
using UnityEngine;

public class NetworkLocation : MonoBehaviour
{

    PhotonView photonView;

    // Start is called before the first frame update
    void Start()
    {
        photonView = GetComponent<PhotonView>();
    }

    // Update is called once per frame
    void Update()
    {
        if (photonView.isMine == false && PhotonNetwork.connected == true)
        {
            transform.position = new Vector3(1.0f, 0.0f, 5.0f);
        }
        else
        {
            transform.position = new Vector3(0.0f, 0.0f, 0.0f);
        }
    }
}
