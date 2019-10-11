//alert("HEY.");
var xmlhttp = new XMLHttpRequest();
xmlhttp.onreadystatechange = function() 
{
    if (this.readyState == 4 && this.status == 200) 
    {
        var benefits = JSON.parse(this.responseText);
        //alert(benefits);
        if (pageNumber != "title")
        {
            if (pageNumber < 8)
            {
                //alert(benefits.QuestionsList[pageNumber]);
                document.getElementById('Question').value = benefits.QuestionsList[pageNumber];
                for (var i = 0; i < 4; i += 1)
                {
                    document.getElementById('BB' + (i+1)).value = benefits.PageList[pageNumber][i].BenefitIndex;
                    //document.getElementById('BL' + (i+1)).value = benefits[pageNumber][i].BenefitLabel;
                    //alert(benefits[pageNumber][i].BenefitLabel);
                    document.getElementById('BI' + (i+1)).src = benefits.PageList[pageNumber][i].BenefitImage;
                    document.getElementById('BI' + (i+1)).style.objectPosition = benefits.PageList[pageNumber][i].ImagePosition;
                    document.getElementById('BI' + (i+1)).style.objectFit = benefits.PageList[pageNumber][i].ImageFitType;
                    document.getElementById('BT' + (i+1)).value = benefits.PageList[pageNumber][i].BenefitText;
                }
            }
            else
            {
                if (pageNumber == 8)
                {
                    document.getElementById('Question').value = benefits.QuestionsList[pageNumber];

                    for (var i = 0; i < 8; i += 1)
                    {
                        var randomIndex = Math.floor(Math.random() * 4);
                        document.getElementById('BB' + (i+1)).value = benefits.PageList[i][randomIndex].BenefitIndex;
                        //document.getElementById('BL' + (i+1)).innerHTML = benefits[i][randomIndex].BenefitLabel;
                        //alert(benefits[pageNumber][i].BenefitLabel);
                        document.getElementById('BI' + (i+1)).src = benefits.PageList[i][randomIndex].BenefitImage;
                        document.getElementById('BI' + (i+1)).style.objectPosition = benefits.PageList[i][randomIndex].ImagePosition;
                        document.getElementById('BI' + (i+1)).style.objectFit = benefits.PageList[i][randomIndex].ImageFitType;
                        document.getElementById('BT' + (i+1)).textContent = benefits.PageList[i][randomIndex].BenefitText;
                    }
                }
                else if (pageNumber > 8)
                {
                    document.getElementById('EssayQuestion1').value = benefits.QuestionsList[pageNumber];
                    document.getElementById('EssayQuestion2').value = benefits.QuestionsList[pageNumber+1];
                }
                
            }
        }
        document.getElementById('headerLogoImage').src = benefits.ClientLogo;
    }
};
xmlhttp.open("GET", surveyJSONFile, true);
xmlhttp.send();