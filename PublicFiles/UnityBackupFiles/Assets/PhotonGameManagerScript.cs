using System.Collections;
using System.Collections.Generic;
using UnityEngine;

using UnityEngine.SceneManagement;

using Photon;
using Photon.Realtime;


public class PhotonGameManagerScript : Photon.PunBehaviour
{
    // Start is called before the first frame update
    void Start()
    {
        
    }

    // Update is called once per frame
    void Update()
    {
        
    }

    public override void OnLeftRoom()
    {
        SceneManager.LoadScene(0);
    }

    public void LeaveRoom()
    {
        PhotonNetwork.LeaveRoom();
    }

    void LoadArena()
    {
        if (PhotonNetwork.isMasterClient == false)
        {
            Debug.Log("Cannot load level unless master client.");
        }
        PhotonNetwork.LoadLevel("Room" + (PhotonNetwork.room.PlayerCount));
    }

    public override void OnPhotonPlayerConnected(PhotonPlayer newPlayer)
    {
        Debug.Log("Connected.");
        if (PhotonNetwork.isMasterClient == true)
        {
            LoadArena();
        }
    }

    public override void OnPhotonPlayerDisconnected(PhotonPlayer otherPlayer)
    {
        Debug.Log("Disconnected!");
        if (PhotonNetwork.isMasterClient == true)
        {
            LoadArena();
        }
    }
}
