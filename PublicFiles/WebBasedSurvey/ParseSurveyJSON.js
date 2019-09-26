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
                for (var i = 0; i < 4; i += 1)
                {
                    document.getElementById('BB' + (i+1)).value = benefits[pageNumber][i].BenefitIndex;
                    document.getElementById('BL' + (i+1)).value = benefits[pageNumber][i].BenefitLabel;
                    //alert(benefits[pageNumber][i].BenefitLabel);
                    document.getElementById('BI' + (i+1)).src = benefits[pageNumber][i].BenefitImage;
                    document.getElementById('BT' + (i+1)).value = benefits[pageNumber][i].BenefitText;
                }
            }
            else
            {
                for (var i = 0; i < 8; i += 1)
                {
                    var randomIndex = Math.floor(Math.random() * 4);
                    document.getElementById('BB' + (i+1)).value = benefits[i][randomIndex].BenefitIndex;
                    document.getElementById('BL' + (i+1)).innerHTML = benefits[i][randomIndex].BenefitLabel;
                    //alert(benefits[pageNumber][i].BenefitLabel);
                    document.getElementById('BI' + (i+1)).src = benefits[i][randomIndex].BenefitImage;
                    document.getElementById('BT' + (i+1)).innerHTML = benefits[i][randomIndex].BenefitText;
                }
            }
        }
    }
};
xmlhttp.open("GET", surveyJSONFile, true);
xmlhttp.send();