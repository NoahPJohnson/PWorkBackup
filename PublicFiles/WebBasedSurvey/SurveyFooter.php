<div class="row page-footer footer">
    <div class="footerContent">
        <div>Page: <?php echo $pageNumber + 1;?></div>
    </div>
</div>
</div>
</body>
<script>
if (pageNumber < 8)
{
    document.getElementById("BB1").addEventListener("click", function() { SelectBenefit("BB1", "Index1", 4); });
    document.getElementById("BB2").addEventListener("click", function() { SelectBenefit("BB2", "Index2", 4); });
    document.getElementById("BB3").addEventListener("click", function() { SelectBenefit("BB3", "Index3", 4); });
    document.getElementById("BB4").addEventListener("click", function() { SelectBenefit("BB4", "Index4", 4); });
            /*for (var i = 0; i < 4; i += 1)
            {
                document.getElementsByClassName("BenefitButton")[i].addEventListener("click", function() { alert(i); });
            }*/
}
else if (pageNumber == 8)
{
    document.getElementById("BB1").addEventListener("click", function() { SelectBenefit("BB1", "Index1", 8); });
    document.getElementById("BB2").addEventListener("click", function() { SelectBenefit("BB2", "Index2", 8); });
    document.getElementById("BB3").addEventListener("click", function() { SelectBenefit("BB3", "Index3", 8); });
    document.getElementById("BB4").addEventListener("click", function() { SelectBenefit("BB4", "Index4", 8); });
    document.getElementById("BB5").addEventListener("click", function() { SelectBenefit("BB5", "Index5", 8); });
    document.getElementById("BB6").addEventListener("click", function() { SelectBenefit("BB6", "Index6", 8); });
    document.getElementById("BB7").addEventListener("click", function() { SelectBenefit("BB7", "Index7", 8); });
    document.getElementById("BB8").addEventListener("click", function() { SelectBenefit("BB8", "Index8", 8); });
}
function SelectBenefit(index, index2, benefitCount) {
    for (var j = 0; j < benefitCount; j += 1)
    {
        document.getElementsByClassName("BenefitButton")[j].classList.remove("Selected");
        document.getElementsByClassName("BenefitIndex")[j].setAttribute("name","");
    }
    document.getElementById(index).classList.add("Selected");
    document.getElementById(index2).setAttribute("name","Selected");
    document.getElementById('SubmitBenefitButton').disabled = false;
    //alert("Index: " + index);
}

function CreateSurveyShareLink(surveyName) {
    document.getElementById("SurveyLinkField").innerHTML = "https://www.prodigalcompany.com/npjTest/SurveyStuff/WebBasedSurveyApp/SurveyIndex.php?surveyname=" + surveyName;
}
</script>
</html>