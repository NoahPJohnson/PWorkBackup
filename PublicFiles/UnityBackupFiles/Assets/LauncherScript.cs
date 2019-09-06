using System.Collections;
using System.Collections.Generic;
using UnityEngine;
using Photon.Realtime;

public class LauncherScript : Photon.PunBehaviour
{
    string gameVersion = "1";

    [Tooltip("The maximum number of players per room. When a room is full, it can't be joined by new players, and so new room will be created")]
    [SerializeField]
    private byte maxPlayersPerRoom = 4;

    [SerializeField]
    GameObject startingControlPanel;

    [SerializeField]
    GameObject connectingText;


    bool isConnecting;
    private void Awake()
    {
        PhotonNetwork.automaticallySyncScene = true;
    }

    // Start is called before the first frame update
    void Start()
    {
        //Connect();
        startingControlPanel.SetActive(true);
        connectingText.SetActive(false);
    }

    // Update is called once per frame
    void Update()
    {
        
    }

    public void Connect()
    {
        isConnecting = true;
        startingControlPanel.SetActive(false);
        connectingText.SetActive(true);
        if (PhotonNetwork.connected == true)
        {
            Debug.Log("connected.");
            PhotonNetwork.JoinRandomRoom();
        }
        else
        {
            Debug.Log("Not Connected.");
            PhotonNetwork.gameVersion = gameVersion;
            PhotonNetwork.ConnectUsingSettings(PhotonNetwork.gameVersion);
        }
    }

    public override void OnConnectedToMaster()
    {
        Debug.Log("PUN Basics Tutorial/Launcher: OnConnectedToMaster() was called by PUN");
        if (isConnecting == true)
        {
            PhotonNetwork.JoinRandomRoom();
        }
    }


    public override void OnDisconnectedFromPhoton()
    {
        startingControlPanel.SetActive(true);
        connectingText.SetActive(false);
        Debug.LogWarningFormat("PUN Basics Tutorial/Launcher: OnDisconnected() was called by PUN with reason");
    }

    public override void OnPhotonRandomJoinFailed(object[] strmessage)
    {
        Debug.Log("PUN Basics Tutorial/Launcher:OnJoinRandomFailed() was called by PUN. No random room available, so we create one.\nCalling: PhotonNetwork.CreateRoom");

        // #Critical: we failed to join a random room, maybe none exists or they are all full. No worries, we create a new room.
        PhotonNetwork.CreateRoom(null);
    }

    public override void OnJoinedRoom()
    {
        Debug.Log("PUN Basics Tutorial/Launcher: OnJoinedRoom() called by PUN. Now this client is in a room.");
        if (PhotonNetwork.room.PlayerCount == 1)
        {
            Debug.Log("We load the 'Room1' ");


            // #Critical
            // Load the Room Level.
            PhotonNetwork.LoadLevel("Room1");
        }
    }

}
