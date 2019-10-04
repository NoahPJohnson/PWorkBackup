dragElement(document.getElementById("BI1"), "IP1");
dragElement(document.getElementById("BI2"), "IP2");
dragElement(document.getElementById("BI3"), "IP3");
dragElement(document.getElementById("BI4"), "IP4");

for (var i = 0; i < 4; i += 1)
{
    if (document.getElementById('BI' + (i+1)).src != '')
    {
        document.getElementById('BU' + (i+1)).disabled = true;
    }
}


function dragElement(imageToManipulate, imagePositionTrackerID) {
  var pos1 = 0;
  var pos2 = 0;
  var pos3 = 0;
  var pos4 = 0;

  imageToManipulate.onmousedown = dragMouseDown;

  function dragMouseDown(e) {
    e = e || window.event;
    e.preventDefault();
    // get the mouse cursor position at startup:
    pos3 = e.clientX;
    pos4 = e.clientY;
    document.onmouseup = closeDragElement;
    // call a function whenever the cursor moves:
    document.onmousemove = elementDrag;
  }

  function elementDrag(e) {
    e = e || window.event;
    e.preventDefault();
    // calculate the new cursor position:
    pos1 = pos3 - e.clientX;
    pos2 = pos4 - e.clientY;
    pos3 = e.clientX;
    pos4 = e.clientY;
    // set the element's new position:
    //document.getElementById('BT1').innerHTML = imageToManipulate.style.objectPosition + "px / " + "px";
    imageX = parseInt(imageToManipulate.style.objectPosition.split(" ")[0])-pos1;
    imageY = parseInt(imageToManipulate.style.objectPosition.split(" ")[1])-pos2;
    imageToManipulate.style.objectPosition = (imageX) + "px " + (imageY) + "px";
    
    //imageToManipulate.style.left = (imageToManipulate.offsetLeft - pos1) + "px";
  }

  function closeDragElement() {
    // stop moving when mouse button is released:
    document.onmouseup = null;
    document.onmousemove = null;
    document.getElementById(imagePositionTrackerID).value = imageToManipulate.style.objectPosition;
  }
}

function ChangeImageFit(fitValue, imageID)
{
    document.getElementById(imageID).style.objectFit = fitValue;
    document.getElementById(imageID).style.objectPosition = '50% 50%';
}

function DeleteImage(imageID, uploadID)
{
    document.getElementById(imageID).src = '';
    document.getElementById(uploadID).disabled = false;
}

function DisableUpload(uploadID)
{
    document.getElementById(uploadID).disabled = false;
}