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
                var randomizedIndexArray = ShuffleIndexes(4);
                document.getElementById('PageQuestion').textContent = benefits.QuestionsList[pageNumber];
                for (var i = 0; i < 4; i += 1)
                {
                    document.getElementById('BB' + (randomizedIndexArray[i]+1)).value = benefits.PageList[pageNumber][i].BenefitIndex;
                    document.getElementById('Index' + (randomizedIndexArray[i]+1)).value = benefits.PageList[pageNumber][i].BenefitIndex;
                    //document.getElementById('BL' + (randomizedIndexArray[i]+1)).innerHTML = benefits[pageNumber][i].BenefitLabel;
                    //alert(benefits[pageNumber][i].BenefitLabel);
                    document.getElementById('BI' + (randomizedIndexArray[i]+1)).src = benefits.PageList[pageNumber][i].BenefitImage;
                    document.getElementById('BI' + (randomizedIndexArray[i]+1)).style.objectPosition = benefits.PageList[pageNumber][i].ImagePosition;
                    document.getElementById('BI' + (randomizedIndexArray[i]+1)).style.objectFit = benefits.PageList[pageNumber][i].ImageFitType;
                    document.getElementById('BT' + (randomizedIndexArray[i]+1)).innerHTML = benefits.PageList[pageNumber][i].BenefitText;
                }
            }
            else
            {
                var randomizedIndexArray = ShuffleIndexes(8);
                for (var i = 0; i < 8; i += 1)
                {
                    //var randomIndex = Math.floor(Math.random() * 4);

                    var selectedIndex = finalBenefitArray[i];
                    var finalIndex = 0;
                    if (selectedIndex[2] == 'a')
                    {
                        finalIndex = 0;
                    }
                    else if (selectedIndex[2] == 'b')
                    {
                        finalIndex = 1;
                    }
                    else if (selectedIndex[2] == 'c')
                    {
                        finalIndex = 2;
                    }
                    else if (selectedIndex[2] == 'd')
                    {
                        finalIndex = 3;
                    }


                    document.getElementById('BB' + (randomizedIndexArray[i]+1)).value = benefits.PageList[i][finalIndex].BenefitIndex;
                    document.getElementById('Index' + (randomizedIndexArray[i]+1)).value = benefits.PageList[i][finalIndex].BenefitIndex;
                    //document.getElementById('BL' + (randomizedIndexArray[i]+1)).innerHTML = benefits[i][finalIndex].BenefitLabel;
                    //alert(benefits[pageNumber][i].BenefitLabel);
                    document.getElementById('BI' + (randomizedIndexArray[i]+1)).src = benefits.PageList[i][finalIndex].BenefitImage;
                    document.getElementById('BI' + (randomizedIndexArray[i]+1)).style.objectPosition = benefits.PageList[i][finalIndex].ImagePosition;
                    document.getElementById('BI' + (randomizedIndexArray[i]+1)).style.objectFit = benefits.PageList[i][finalIndex].ImageFitType;
                    document.getElementById('BT' + (randomizedIndexArray[i]+1)).innerHTML = benefits.PageList[i][finalIndex].BenefitText;
                }
            }
        }
    }
};
xmlhttp.open("GET", surveyJSONFile, true);
xmlhttp.send();

function ShuffleIndexes(indexCount) 
{
    var indexArray = [];
    var indexOptionList = [];
    for (var i = 0; i < indexCount; i += 1)
    {
        indexArray.push(i);
        indexOptionList.push(i);
    }
    
    
    var tempIndexList = [indexOptionList];
    for (var i = 0; i < 4; i++)
    {
        var randomInt = Math.floor(Math.random()*(4-i));
        indexArray[i] = tempIndexList[i][randomInt];
        tempIndexList[i].splice(randomInt, 1);
        tempIndexList.push(tempIndexList[i]);
        
    }
    return indexArray;
}