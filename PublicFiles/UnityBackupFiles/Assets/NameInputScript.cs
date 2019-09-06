using System.Collections;
using System.Collections.Generic;
using UnityEngine;
using UnityEngine.UI;


using Photon;
using Photon.Realtime;

[RequireComponent(typeof(InputField))]
public class NameInputScript : Photon.PunBehaviour
{
    const string playerNamePrefKey = "playerName";

    // Start is called before the first frame update
    void Start()
    {
        string defaultName = "";
        InputField inputField = this.GetComponent<InputField>();
        if (inputField != null)
        {
            if (PlayerPrefs.HasKey(playerNamePrefKey))
            {
                defaultName = PlayerPrefs.GetString(playerNamePrefKey);
                inputField.text = defaultName;
            }
        }
        PhotonNetwork.playerName = inputField.text;
    }

    // Update is called once per frame
    void Update()
    {
        
    }

    public void SetPlayerName(string newName)
    {
        // #Important
        if (string.IsNullOrEmpty(newName))
        {
            Debug.LogError("Player Name is null or empty");
            return;
        }
        PhotonNetwork.playerName = newName;


        PlayerPrefs.SetString(playerNamePrefKey, newName);
    }
}
