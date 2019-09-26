
                var indexArray = [0,1,2,3];
                var indexOptionList = [0,1,2,3];
                
                var tempIndexList = [indexOptionList];
                for (var i = 0; i < 4; i++)
                {
                    var randomInt = Math.floor(Math.random()*(4-i));
                    indexArray[i] = tempIndexList[i][randomInt];
                    tempIndexList[i].splice(randomInt, 1);
                    tempIndexList.push(tempIndexList[i]);
                    
                }
                for (var i = 0; i < 4; i++)
                {
                    var currentParent = document.getElementById('B'.concat(i+1));
                    currentParent.appendChild(document.getElementById('BB'.concat(indexArray[i]+1)).cloneNode(true));
                    //currentParent.appendChild(document.getElementById('BC'.concat(indexArray[i]+1)).cloneNode(true));
                }
                for (var i = 0; i < 4; i++)
                {
                    var currentParent = document.getElementById('B'.concat(i + 1));
                    currentParent.removeChild(currentParent.childNodes[1]);
                    //currentParent.removeChild(currentParent.firstChild);
                    //currentParent.removeChild(currentParent.firstChild);
                    //currentParent.removeChild(currentParent.firstChild);
                }