using System;
using System.Collections.Generic;
using System.Collections.ObjectModel;
using System.Diagnostics;
using System.IO;
using System.Linq;
using System.Net;
using System.Net.Http;
using System.Runtime.Serialization.Json;
using System.Text;
using System.Threading.Tasks;
using Windows.ApplicationModel;
using Windows.ApplicationModel.DataTransfer;
using Windows.Graphics.Imaging;
using Windows.Security.Cryptography.Certificates;
using Windows.Storage;
using Windows.Storage.Streams;
using Windows.UI.Xaml.Media.Imaging;
using Windows.Web.Http;

namespace TestSurveyApp
{
    public class SurveyPage
    {

        //public ObservableCollection<ObservableCollection<Benefit>> FinalBenefitList { get; set; }
        //public BenefitCollection SurveyBenefitCollection { get; set; }
        public ObservableCollection<Benefit> CurrentBenefitCollection { get; set; }
        public Windows.Storage.StorageFolder storageFolder { get; set; }
        Windows.Storage.Pickers.FileSavePicker filePicker;
        Windows.Storage.Pickers.FileOpenPicker fileOpenPicker;
        Windows.Storage.Pickers.FolderPicker folderPicker;

        string rootURL = "https://prodigalcompany.com/npjTest/SurveyStuff";

        public string[] staticTemplateArray { get; set; }
        public string[] dynamicTemplateArray { get; set; }

        int[] indexArray;

        public string surveyTemplateString;

        public string surveyName;

        int pageNumber;

       

        public SurveyPage(int newPageNumber)
        {
            

            pageNumber = newPageNumber;


            CurrentBenefitCollection = App.SurveyBenefitCollection.FinalBenefitList[pageNumber];

            staticTemplateArray = new string[]
            {
                @"<?php

//require_once ""surveyConfig.php"";

$jsonData = file_get_contents(",  @");
$pageArray = json_decode($jsonData);
if ($_SERVER[""REQUEST_METHOD""] == ""POST"")
{
    session_start();
    $_SESSION[""pageNumber""] += 1;
    $pageNumber = $_SESSION[""pageNumber""];
    if ($_POST['BenefitButton'] == '1')
    {
        $_SESSION[""finalBenefitArray""][] = $pageArray[$pageNumber-1][0];
        
    }
    else if ($_POST['BenefitButton'] == '2')
    {
        $_SESSION[""finalBenefitArray""][] = $pageArray[$pageNumber-1][1];
        
    }
    else if ($_POST['BenefitButton'] == '3')
    {
        $_SESSION[""finalBenefitArray""][] = $pageArray[$pageNumber-1][2];
        
    }
    else if ($_POST['BenefitButton'] == '4')
    {
        $_SESSION[""finalBenefitArray""][] = $pageArray[$pageNumber-1][3];
        
    }
    $finalBenefitArray = $_SESSION[""finalBenefitArray""];
    if ($pageNumber >= 8)
    {
        if (isset($_SESSION[""finalBenefitArray""]))
        {
            header(""location: surveyFinalPage.php"");

            exit();
        }
    }
}


if (!isset($_SESSION[""pageNumber""]) || $_SESSION[""pageNumber""] == 0)
{
    $finalBenefitArray = array();
    $pageNumber = 0;
    //echo ""S: "" . $_SESSION[""pageNumber""];
}

class Benefit
{
        public $BenefitText;
        public $BenefitImage;
        public $BenefitLabel;
        public $BeneiftIndex;

        function __construct()
        {
            $this->BenefitText = ""BenefitText"";
            $this->BenefitImage = ""./Assets"";
            $this->BenefitLabel = ""Benefit Title"";
            $this->BenefitIndex = """";
        }
    }

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Survey Page</title>
    
    <!-- Bootstrap -->
    <link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css' integrity='sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu' crossorigin='anonymous'>
    <style>


    .BenefitRow {
        margin: auto;
        padding: 10px 0;
        height: 45%;
    }

    .Benefit {

        border: 1px solid blue;
        margin: 10px;
        padding: 5px;
        height: 300px;
    }

    .BenefitTitle {
        text-align: center;
        height: 10%;
    }

    .BenefitImage {
        padding: 5px 0;
        object-fit: contain;
    }
    </style>

</head>
<body>
    <header>Survey: Question</header>
    <div class='Survey Page'>
        <div class='SurveyQuestion'>Question</div>
        <form class='BenefitsCollection container' action='<?php echo htmlspecialchars($_SERVER[""PHP_SELF""]); ?>' method='post'>
            <div class='BenefitRow row'>
                <button id='BB1' name='BenefitButton' value='1' class='Benefit col-md-5' type='submit'>
                    <div id='BL1' class='row'>
                        <div class='BenefitTitle'><?php echo $pageArray[$pageNumber][0]->BenefitLabel ?></div>
                    </div>
                    <div id='BC1' class='row'>
                        <img id='BI1' class='BenefitImage col-md-6' src='<?php echo $pageArray[$pageNumber][0]->BenefitImage ?>'></img>
                        <div id='BT1' class='BenefitText col-md-6'><?php echo $pageArray[$pageNumber][0]->BenefitText ?></div>
                        
                    </div>
                </button>
                <button id='BB2' name='BenefitButton' value='2' class='Benefit col-md-5' type='submit'>
                    <div id='BL2' class='row'>
                        <div class='BenefitTitle'><?php echo $pageArray[$pageNumber][1]->BenefitLabel ?></div>
                    </div>
                    <div id='BC2' class='row'>
                        <img id='BI2' class='BenefitImage col-md-6' src='<?php echo $pageArray[$pageNumber][1]->BenefitImage ?>'></img>
                        <div id='BT2' class='BenefitText col-md-6'><?php echo $pageArray[$pageNumber][1]->BenefitText ?></div>
                        
                    </div>
                </button>
            </div>
            <div class='BenefitRow row'>
                <button id='BB3' name='BenefitButton' value='3' class='Benefit col-md-5' type='submit'>
                    <div id='BL3' class='row'>
                        <div class='BenefitTitle'><?php echo $pageArray[$pageNumber][2]->BenefitLabel ?></div>
                    </div>
                    <div id='BC3' class='row'>
                        
                        <img id='BI3' class='BenefitImage col-md-6' src='<?php echo $pageArray[$pageNumber][2]->BenefitImage ?>'></img>
                        <div id='BT3' class='BenefitText col-md-6'><?php echo $pageArray[$pageNumber][2]->BenefitText ?></div>
                        
                    </div>
                </button>
                <button  id='BB4' name='BenefitButton' value='4' class='Benefit col-md-5' type='submit'>
                    <div id='BL4' class='row'>
                        <div class='BenefitTitle'><?php echo $pageArray[$pageNumber][3]->BenefitLabel ?></div>
                    </div>
                    <div id='BC4' class='row'>
                        <img id='BI4' class='BenefitImage col-md-6' src='<?php echo $pageArray[$pageNumber][3]->BenefitImage ?>'></img>
                        <div id='BT4' class='BenefitText col-md-6'><?php echo $pageArray[$pageNumber][3]->BenefitText ?></div>
                    </div>
                </button>
            </div>
        </form>
        <script>
        
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
                    var currentParent = document.getElementById('BB'.concat(i+1));
                    currentParent.appendChild(document.getElementById('BL'.concat(indexArray[i]+1)).cloneNode(true));
                    currentParent.appendChild(document.getElementById('BC'.concat(indexArray[i]+1)).cloneNode(true));
                }
                for (var i = 0; i < 4; i++)
                {
                    var currentParent = document.getElementById('BB'.concat(i + 1));
                    currentParent.removeChild(currentParent.firstChild);
                    currentParent.removeChild(currentParent.firstChild);
                    currentParent.removeChild(currentParent.firstChild);
                    currentParent.removeChild(currentParent.firstChild);
                }
        </script>
    </div>
    <footer>Page: <?php echo $pageNumber?></footer>
</body>
</html>"
            };

            //dynamicTemplateArray = new string[] {  };

            /*surveyTemplateString = staticTemplateArray[0]
                + CurrentBenefitCollection[0].BenefitLabel + staticTemplateArray[1]
                + CurrentBenefitCollection[0].BenefitImage + staticTemplateArray[2]
                + CurrentBenefitCollection[0].BenefitText + staticTemplateArray[3]
                + CurrentBenefitCollection[1].BenefitLabel + staticTemplateArray[4]
                + CurrentBenefitCollection[1].BenefitImage + staticTemplateArray[5]
                + CurrentBenefitCollection[1].BenefitText + staticTemplateArray[6]
                + CurrentBenefitCollection[2].BenefitLabel + staticTemplateArray[7]
                + CurrentBenefitCollection[2].BenefitImage + staticTemplateArray[8]
                + CurrentBenefitCollection[2].BenefitText + staticTemplateArray[9]
                + CurrentBenefitCollection[3].BenefitLabel + staticTemplateArray[10]
                + CurrentBenefitCollection[3].BenefitImage + staticTemplateArray[11]
                + CurrentBenefitCollection[3].BenefitText + staticTemplateArray[12]
                + (pageNumber + 1) + staticTemplateArray[13];*/


            indexArray = new int[] { 0, 1, 2, 3 };
            //BenefitTextStrings = new string[]{ "Text1", "Text2", "Text3", "Text4" };
            //BenefitImgSrcStrings = new string[] { "./Assets/StoreLogo.png", "./Assets/StoreLogo.png", "./Assets/StoreLogo.png", "./Assets/StoreLogo.png" };

            surveyName = "testSurveyFolder";

            filePicker = new Windows.Storage.Pickers.FileSavePicker(); //Windows.Storage.ApplicationData.Current.LocalFolder;
            fileOpenPicker = new Windows.Storage.Pickers.FileOpenPicker();
            folderPicker = new Windows.Storage.Pickers.FolderPicker();

            filePicker.FileTypeChoices.Add("JSON", new List<string>() { ".json" });
        }

        public void Image_DragOver(object sender, Windows.UI.Xaml.DragEventArgs e)
        {
            e.AcceptedOperation = DataPackageOperation.Copy;

            Debug.WriteLine("Dragging.");
        }

        public async Task Image_Drop(object sender, IReadOnlyList<IStorageItem> items)
        {

            StorageFile storageFile = items[0] as StorageFile;
            StorageFolder assets = await Package.Current.InstalledLocation.GetFolderAsync("Assets");

            //StorageFile localImageFile = await storageFile.CopyAsync(assets, storageFile.Name, NameCollisionOption.ReplaceExisting);
            BitmapImage bitmapImage;
            //string name = localImageFile.Name; 
            using (IRandomAccessStream stream = await storageFile.OpenAsync(FileAccessMode.Read))
            {
                bitmapImage = new BitmapImage();
                await bitmapImage.SetSourceAsync(stream);
                
                bitmapImage.UriSource = new Uri("ms-appx:///Assets/"+storageFile.Name);
                Debug.WriteLine("bitmapImage uri source = " + bitmapImage.UriSource);
            }
            
            Windows.UI.Xaml.Controls.GridViewItem senderItem = sender as Windows.UI.Xaml.Controls.GridViewItem;
            if (senderItem.Name == "Benefit1")
            {
                CurrentBenefitCollection[0].BenefitImage = bitmapImage.UriSource;
            }
            else if (senderItem.Name == "Benefit2")
            {
                CurrentBenefitCollection[1].BenefitImage = bitmapImage.UriSource;
            }
            else if (senderItem.Name == "Benefit3")
            {
                CurrentBenefitCollection[2].BenefitImage = bitmapImage.UriSource;
            }
            else if (senderItem.Name == "Benefit4")
            {
                CurrentBenefitCollection[3].BenefitImage = bitmapImage.UriSource;

            }
            //Debug.WriteLine("Image is now: " + CurrentBenefitCollection[0].BenefitImage.UriSource);
            StorageFile localImageFile = await storageFile.CopyAsync(assets, storageFile.Name, NameCollisionOption.ReplaceExisting);
            App.SurveyBenefitCollection.FinalBenefitList[pageNumber] = CurrentBenefitCollection;
        }

        public void Image_Loaded(object sender, Windows.UI.Xaml.RoutedEventArgs e)
        {
            Windows.UI.Xaml.Controls.Image img = sender as Windows.UI.Xaml.Controls.Image;
            if (img != null)
            {
                img.Source = new BitmapImage(CurrentBenefitCollection[0].BenefitImage);
            }
            Debug.WriteLine("Load");
        }

        public void BenefitTextBox_TextChanging(Windows.UI.Xaml.Controls.TextBox sender, Windows.UI.Xaml.Controls.TextBoxTextChangingEventArgs args)
        {
            switch (sender.Name)
            {
                case "Benefit1TextBox":
                    CurrentBenefitCollection[0].BenefitText = sender.Text;
                    break;
                case "Benefit1TitleBox":
                    CurrentBenefitCollection[0].BenefitLabel = sender.Text;
                    break;
                case "Benefit2TextBox":
                    CurrentBenefitCollection[1].BenefitText = sender.Text;
                    break;
                case "Benefit2TitleBox":
                    CurrentBenefitCollection[1].BenefitLabel = sender.Text;
                    break;
                case "Benefit3TextBox":
                    CurrentBenefitCollection[2].BenefitText = sender.Text;
                    break;
                case "Benefit3TitleBox":
                    CurrentBenefitCollection[2].BenefitLabel = sender.Text;
                    break;
                case "Benefit4TextBox":
                    CurrentBenefitCollection[3].BenefitText = sender.Text;
                    break;
                case "Benefit4TitleBox":
                    CurrentBenefitCollection[3].BenefitLabel = sender.Text;
                    break;
            }
        }

        public async void SaveToFile(object sender, Windows.UI.Xaml.RoutedEventArgs e)
        {
            //Windows.Storage.StorageFile sampleFile = await storageFolder.CreateFileAsync("sample.txt", Windows.Storage.CreationCollisionOption.ReplaceExisting);
            //Windows.Storage.StorageFile surveyFile = await storageFolder.GetFileAsync("testSurveyPage.html");
            //CurrentBenefitCollection[0].BenefitLabel = Benefit1TitleBox.Text;
            //CurrentBenefitCollection[0].BenefitText = Benefit1TextBox.Text;
            //CurrentBenefitCollection[1].BenefitLabel = Benefit1TitleBox.Text;
            //CurrentBenefitCollection[1].BenefitText = Benefit2TextBox.Text;
            //CurrentBenefitCollection[2].BenefitLabel = Benefit1TitleBox.Text;
            //CurrentBenefitCollection[2].BenefitText = Benefit3TextBox.Text;
            //CurrentBenefitCollection[3].BenefitLabel = Benefit1TitleBox.Text;
            //CurrentBenefitCollection[3].BenefitText = Benefit4TextBox.Text;

            //ShuffleIndexes();

            //Debug.WriteLine("Hey: " + CurrentBenefitCollection[indexArray[0]].BenefitImage);

            /*surveyTemplateString = staticTemplateArray[0]
                + CurrentBenefitCollection[0].BenefitLabel + staticTemplateArray[1]
                + rootURL + CurrentBenefitCollection[indexArray[0]].BenefitImage.OriginalString.Substring(10) + staticTemplateArray[2]
                + CurrentBenefitCollection[indexArray[0]].BenefitText + staticTemplateArray[3]
                + CurrentBenefitCollection[1].BenefitLabel + staticTemplateArray[4]
                + rootURL + CurrentBenefitCollection[indexArray[1]].BenefitImage.OriginalString.Substring(10) + staticTemplateArray[5]
                + CurrentBenefitCollection[indexArray[1]].BenefitText + staticTemplateArray[6]
                + CurrentBenefitCollection[2].BenefitLabel + staticTemplateArray[7]
                + rootURL + CurrentBenefitCollection[indexArray[2]].BenefitImage.OriginalString.Substring(10) + staticTemplateArray[8]
                + CurrentBenefitCollection[indexArray[2]].BenefitText + staticTemplateArray[9]
                + CurrentBenefitCollection[3].BenefitLabel + staticTemplateArray[10]
                + rootURL + CurrentBenefitCollection[indexArray[3]].BenefitImage.OriginalString.Substring(10) + staticTemplateArray[11]
                + CurrentBenefitCollection[indexArray[3]].BenefitText + staticTemplateArray[12]
                + pageNumber + staticTemplateArray[13];*/

            //StorageFile tempImageFile = await storageFolder.CreateFileAsync("tempImageFile.png");
            //await UploadOpAsync(CurrentBenefitCollection[3].BenefitImage.UriSource, tempImageFile);



            
            //Windows.Storage.StorageFolder filesFolder = ApplicationData.Current.LocalFolder;//.GetFolderAsync("TestSurveyApp/Surveys");//await folderPicker.PickSingleFolderAsync();


            //folderPicker.SuggestedStartLocation = Windows.Storage.Pickers.PickerLocationId.Desktop;
            //folderPicker.FileTypeFilter.Add("*");

            /*Windows.Storage.StorageFolder filesFolder = await folderPicker.PickSingleFolderAsync();
            if (filesFolder.TryGetItemAsync(surveyName) != null)
            {
                surveyFolder = await filesFolder.CreateFolderAsync(surveyName);
            }
            else
            {
                surveyFolder = await filesFolder.GetFolderAsync(surveyName);
            }*/
            /*if (surveyFolder != null)
            {
                surveyName = surveyFolder.Name;//await filesFolder.CreateFolderAsync(surveyName);
            }*/
            //if (surveyFolder != null)
            //{
                //for (int i = 0; i < 8; i++)
                //{ 
            var stream2 = new MemoryStream();
            var serializer = new DataContractJsonSerializer(typeof(ObservableCollection<ObservableCollection<Benefit>>));
            serializer.WriteObject(stream2, App.SurveyBenefitCollection.FinalBenefitList);

            filePicker.SuggestedStartLocation = Windows.Storage.Pickers.PickerLocationId.Downloads;
            Windows.Storage.StorageFile surveyFile = await filePicker.PickSaveFileAsync();
            App.surveyFile = surveyFile;
            stream2.Position = 0;
            var streamReader = new StreamReader(stream2);
            //dataWriter.WriteString(streamReader.ReadToEnd());
            //Debug.WriteLine(streamReader.ReadToEnd());
            //var pageFile = await surveyFolder.CreateFileAsync(surveyName + "Page" + ".html");
            var stream = await surveyFile.OpenAsync(FileAccessMode.ReadWrite);
            
            using (var outputStream = stream.GetOutputStreamAt(0))
            {
                
                using (var dataWriter = new Windows.Storage.Streams.DataWriter(outputStream))
                {
                   
                    //Debug.WriteLine("Should Write Stuff.");
                    string pageTemplateString = staticTemplateArray[0] + App.surveyFile.Name + staticTemplateArray[1];
        
                    //dataWriter.WriteString(pageTemplateString);
                    dataWriter.WriteString(streamReader.ReadToEnd());

                    stream.Size = await dataWriter.StoreAsync();
                    await outputStream.FlushAsync();
                }
            }
            stream.Dispose();

            StorageFile surveyLogic = await App.surveyFolder.CreateFileAsync("surveyLogic.php", CreationCollisionOption.ReplaceExisting);
            stream = await surveyLogic.OpenAsync(FileAccessMode.ReadWrite);
            using (var outputStream = stream.GetOutputStreamAt(0))
            {
                using (var dataWriter = new Windows.Storage.Streams.DataWriter(outputStream))
                {
                    //Debug.WriteLine("Should Write Stuff.");
                    string pageTemplateString = staticTemplateArray[0] + App.surveyFile.Name + staticTemplateArray[1];

                    dataWriter.WriteString(pageTemplateString);

                    await dataWriter.StoreAsync();
                    await outputStream.FlushAsync();
                }
            }
            stream.Dispose();

        }

        public async void UploadToServer(object sender, Windows.UI.Xaml.RoutedEventArgs e)
        {
            //surveyFolder = await folderPicker.PickSingleFolderAsync();
            //Upload json
            //await TryPostJsonAsync();
            //await PutFileOnServer();
            //await Upload_FileAsync();
            //await GetTest();
            //Upload 32 images
            //Create table
            //Get/Display shareable link


        }


        public async Task GetTest()
        {
            //Create an HTTP client object
            Windows.Web.Http.HttpClient httpClient = new Windows.Web.Http.HttpClient();

            //Add a user-agent header to the GET request. 
            var headers = httpClient.DefaultRequestHeaders;

            //The safe way to add a header value is to use the TryParseAdd method and verify the return value is true,
            //especially if the header value is coming from user input.
            string header = "ie";
            if (!headers.UserAgent.TryParseAdd(header))
            {
                throw new Exception("Invalid header value: " + header);
            }

            header = "Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.2; WOW64; Trident/6.0)";
            if (!headers.UserAgent.TryParseAdd(header))
            {
                throw new Exception("Invalid header value: " + header);
            }

            Uri requestUri = new Uri("https://prodigalcompany.com/npjTest/SurveyStuff/testSurveyFile.json");

            //Send the GET request asynchronously and retrieve the response as a string.
            Windows.Web.Http.HttpResponseMessage httpResponse = new Windows.Web.Http.HttpResponseMessage();
            string httpResponseBody = "";

            try
            {
                //Send the GET request
                httpResponse = await httpClient.GetAsync(requestUri);
                httpResponse.EnsureSuccessStatusCode();
                httpResponseBody = await httpResponse.Content.ReadAsStringAsync();
                Debug.WriteLine("Output: " + httpResponseBody);
            }
            catch (Exception ex)
            {
                httpResponseBody = "Error: " + ex.HResult.ToString("X") + " Message: " + ex.Message;
            }
        }

        
        public async Task Upload_FileAsync()
        {
            //init_apartment();

            /*Windows.Storage.Streams.IBuffer buffer =
                Windows.Security.Cryptography.CryptographicBuffer.ConvertStringToBinary(
                    "A sentence of text to encode into binary to serve as sample data.",
                    Windows.Security.Cryptography.BinaryStringEncoding.Utf8
                );
            Windows.Web.Http.HttpBufferContent binaryContent = new HttpBufferContent(buffer);*/
            // You can use the 'image/jpeg' content type to represent any binary data;
            // it's not necessarily an image file.
            fileOpenPicker.FileTypeFilter.Add(".json");
            IStorageFile jsonFile = await fileOpenPicker.PickSingleFileAsync();
            IRandomAccessStream stream = await jsonFile.OpenAsync(FileAccessMode.Read);
            Windows.Web.Http.HttpStreamContent jsonContent = new HttpStreamContent(stream);

            jsonContent.Headers.Append("Content-Type", "application/json");

            Windows.Web.Http.Headers.HttpContentDispositionHeaderValue disposition = new Windows.Web.Http.Headers.HttpContentDispositionHeaderValue(/*"form-data"*/"render");
            jsonContent.Headers.ContentDisposition = disposition;
            // The 'name' directive contains the name of the form field representing the data.
            disposition.Name ="fileForUpload";
            // Here, the 'filename' directive is used to indicate to the server a file name
            // to use to save the uploaded data.
            disposition.FileName = "testSurveyFile.json";

            Windows.Web.Http.HttpMultipartFormDataContent postContent = new HttpMultipartFormDataContent();
            postContent.Add(jsonContent); // Add the binary data content as a part of the form data content.

            // Send the POST request asynchronously, and retrieve the response as a string.
            Windows.Web.Http.HttpResponseMessage httpResponseMessage;
            string httpResponseBody;

            try
            {
                /*Uri requestUri = new Uri("https://prodigalcompany.com/npjTest/SurveyStuff");

                Windows.Web.Http.Filters.HttpBaseProtocolFilter clientFilter = new Windows.Web.Http.Filters.HttpBaseProtocolFilter();
                clientFilter.AllowAutoRedirect = false;

                Windows.Web.Http.HttpClient httpClient = new Windows.Web.Http.HttpClient(clientFilter);
                httpResponseMessage = await httpClient.PutAsync(requestUri, postContent);

                requestUri = httpResponseMessage.Headers.Location;
                httpResponseMessage = await httpClient.PutAsync(requestUri, postContent);*/


                // Send the POST request.

                Uri requestUri = new Uri("https://prodigalcompany.com/npjTest/SurveyStuff/testSurveyFile.json");

                Windows.Security.Cryptography.Certificates.CertificateQuery certQuery = new Windows.Security.Cryptography.Certificates.CertificateQuery();
                certQuery.FriendlyName = "Test Certificate";    // This is the friendly name of the certificate that was just installed.
                IReadOnlyList<Windows.Security.Cryptography.Certificates.Certificate> certificates = await Windows.Security.Cryptography.Certificates.CertificateStores.FindAllAsync(certQuery);
                // TODO here you can display the certificates in the UI to make the User select.

                Debug.WriteLine("Cert? = " + certificates.Count);

                Windows.Web.Http.Filters.HttpBaseProtocolFilter filter = new Windows.Web.Http.Filters.HttpBaseProtocolFilter();
                filter.ServerCredential = new Windows.Security.Credentials.PasswordCredential(
                    "prodigalcompany.com",
                    "npjAccess@prodigalcompany.com",
                    "Pr0digal1!");
                filter.AllowAutoRedirect = false;
                //filter.ClientCertificate = certificates[0];

                Windows.Web.Http.HttpClient httpClient = new Windows.Web.Http.HttpClient(filter);
                httpResponseMessage = await httpClient.PutAsync(requestUri, postContent);
                httpResponseMessage.EnsureSuccessStatusCode();
                
                httpResponseBody = await httpResponseMessage.Content.ReadAsStringAsync();
                Debug.WriteLine(httpResponseBody);
            }
            catch (Exception ex)
            {
                Debug.WriteLine(ex);
            }
            
        }


        private async Task TryPostJsonAsync()
        {
            try
            {
                // Construct the HttpClient and Uri. This endpoint is for test purposes only.
                //var myFilter = new Windows.Web.Http.Filters.HttpBaseProtocolFilter();
                //myFilter.AllowUI = false;

                //Windows.Web.Http.Filters.HttpBaseProtocolFilter filter = new Windows.Web.Http.Filters.HttpBaseProtocolFilter();
                //Windows.Storage.StorageFolder storageFolder = KnownFolders.DocumentsLibrary;
                fileOpenPicker.FileTypeFilter.Add(".json");
                /*fileOpenPicker.FileTypeFilter.Add(".txt");
                Windows.Storage.StorageFile credentialsFile = await fileOpenPicker.PickSingleFileAsync();
                string text = await Windows.Storage.FileIO.ReadTextAsync(credentialsFile);
                string username = text.Split(',')[0];
                string password = text.Split(',')[1];
                string domain = text.Split(',')[2];*/

                HttpClientHandler handler = new HttpClientHandler();
                handler.Credentials = new NetworkCredential("", "", "");

                System.Net.Http.HttpClient httpClient = new System.Net.Http.HttpClient(handler);

                httpClient.DefaultRequestHeaders.Clear();
                httpClient.DefaultRequestHeaders.Accept.Add(new System.Net.Http.Headers.MediaTypeWithQualityHeaderValue("application/json"));
                Uri uri = new Uri("https://prodigalcompany.com/npjTest/SurveyStuff/testSurveyFile.json");

                // Construct the JSON to post.
                //fileOpenPicker.FileTypeChoices.Add("JSON", new List<string>() { ".json" });
                
                IStorageFile jsonFile = await fileOpenPicker.PickSingleFileAsync();
                IRandomAccessStream stream = await jsonFile.OpenAsync(FileAccessMode.Read);
                System.Net.Http.MultipartFormDataContent postContent = new MultipartFormDataContent();
                
                if (stream != null)
                {
                    using (var dataReader = new Windows.Storage.Streams.DataReader(stream))
                    {
                        uint numBytesLoaded = await dataReader.LoadAsync((uint)stream.Size);
                        string jsonText = dataReader.ReadString(numBytesLoaded);

                        System.Net.Http.StringContent streamContent = new System.Net.Http.StringContent(jsonText);
                        streamContent.Headers.ContentType = new System.Net.Http.Headers.MediaTypeHeaderValue("application/json");
                        postContent.Add(streamContent);
                        System.Net.Http.HttpResponseMessage httpResponseMessage = await httpClient.PostAsync(
                        "https://prodigalcompany.com/npjTest/SurveyStuff/testSurveyFile.json",
                        postContent);
                        // Make sure the post succeeded, and write out the response.
                        httpResponseMessage.EnsureSuccessStatusCode();
                        var httpResponseBody = await httpResponseMessage.Content.ReadAsStringAsync();
                        Debug.WriteLine(httpResponseBody);
                    }
                }
                else
                {
                    Debug.WriteLine("stream is NULL.");
                }
                
                //HttpStringContent content = await jsonFile.OpenReadAsync();
                // Post the JSON and wait for a response.
                
            }
            catch (Exception ex)
            {
                // Write out any exceptions.
                Debug.WriteLine(ex);
            }
        }

        public async Task PutFileOnServer()
        {
            Uri requestUri = new Uri("https://prodigalcompany.com/npjTest/SurveyStuff/testSurveyFile.json");

            Windows.Web.Http.Filters.HttpBaseProtocolFilter filter = new Windows.Web.Http.Filters.HttpBaseProtocolFilter();
            filter.AllowUI = false;

            // Set credentials that will be sent to the server.
            filter.ServerCredential =
                new Windows.Security.Credentials.PasswordCredential(
                    "https://prodigalcompany.com/npjTest/SurveyStuff/testSurveyFile.json",
                    "npjAccess@prodigalcompany.com",
                    "Pr0digal1!");


            //string content = @"{ deviceId:'newdevice'}";
            fileOpenPicker.FileTypeFilter.Add(".json");
            fileOpenPicker.FileTypeFilter.Add(".txt");
            IStorageFile jsonFile = await fileOpenPicker.PickSingleFileAsync();
            IRandomAccessStream stream = await jsonFile.OpenAsync(FileAccessMode.Read);

            //Windows.Web.Http.HttpStringContent requestBody = new HttpStringContent(content, Windows.Storage.Streams.UnicodeEncoding.Utf8, "application/json");
            Windows.Web.Http.HttpStreamContent requestContent = new HttpStreamContent(stream);

            Windows.Web.Http.HttpRequestMessage message = new Windows.Web.Http.HttpRequestMessage();
            message.RequestUri = requestUri;
            message.Method = Windows.Web.Http.HttpMethod.Put;
            message.Content = requestContent;

            Windows.Web.Http.HttpClient client = new Windows.Web.Http.HttpClient(filter);

            Windows.Web.Http.HttpResponseMessage response = await client.SendRequestAsync(message);

            
            Debug.WriteLine(response);
        }

        public async System.Threading.Tasks.Task UploadOpAsync(Uri uriInput, StorageFile file)
        {
            Windows.Networking.BackgroundTransfer.UploadOperation upload = null;
            //var promise = null;


            try
            {

                Uri uri = uriInput;
                Windows.Networking.BackgroundTransfer.BackgroundUploader uploader = new Windows.Networking.BackgroundTransfer.BackgroundUploader();

                // Set a header, so the server can save the file (this is specific to the sample server).
                uploader.SetRequestHeader("/Assets/", file.Name);

                // Create a new upload operation.
                upload = uploader.CreateUpload(uri, file);

                // Start the upload and persist the promise to be able to cancel the upload.
                upload = await upload.StartAsync();
            }
            catch
            {

            }
        }

        void ShuffleIndexes()
        {
            List<int> indexOptionList = new List<int> { 0, 1, 2, 3 };
            Random randNumber = new Random();
            List<List<int>> tempIndexList = new List<List<int>>();
            tempIndexList.Add(indexOptionList);
            for (int i = 0; i < 4; i++)
            {
                for (int j = 0; j < tempIndexList[i].Count; j++)
                {
                    Debug.WriteLine("2dList: " + tempIndexList[i][j]);
                    //Debug.WriteLine("Count = " + tempIndexList[i].Count);
                }
                int randomIndex = randNumber.Next(0, tempIndexList[i].Count);
                Debug.WriteLine("randomIndex = " + randomIndex);
                indexArray[i] = tempIndexList[i][randomIndex];
                tempIndexList[i].RemoveAt(randomIndex);
                tempIndexList.Add(tempIndexList[i]);

            }
            Debug.WriteLine("Indexes: " + indexArray[0] + ", " + indexArray[1] + ", " + indexArray[2] + ", " + indexArray[3]);
        }
    }
}
