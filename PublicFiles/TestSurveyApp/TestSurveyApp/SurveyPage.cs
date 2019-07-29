using System;
using System.Collections.Generic;
using System.Collections.ObjectModel;
using System.Diagnostics;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using Windows.ApplicationModel.DataTransfer;
using Windows.Storage;


namespace TestSurveyApp
{
    public class SurveyPage
    {

        //public ObservableCollection<ObservableCollection<Benefit>> FinalBenefitList { get; set; }
        //public BenefitCollection SurveyBenefitCollection { get; set; }
        public ObservableCollection<Benefit> CurrentBenefitCollection { get; set; }
        public Windows.Storage.StorageFolder storageFolder { get; set; }
        Windows.Storage.Pickers.FileSavePicker filePicker;

        string rootURL = "https://prodigalcompany.com/npjTest/SurveyStuff";

        public string[] staticTemplateArray { get; set; }
        public string[] dynamicTemplateArray { get; set; }

        int[] indexArray;

        public string surveyTemplateString;

        int pageNumber;

        public SurveyPage(int newPageNumber)
        {
            pageNumber = newPageNumber;
            //this.InitializeComponent();
            //FinalBenefitList = new ObservableCollection<ObservableCollection<Benefit>>();
            //CurrentBenefitCollection = new ObservableCollection<Benefit>();
            //surveyPagesArray = new Page[] { new SurveyPages.SurveyPage1(), new SurveyPages.SurveyPage2(), new SurveyPages.SurveyPage3(), new SurveyPages.SurveyPage4() };
            //SurveyBenefitCollection = new BenefitCollection();
            //pageNumber = 0;

            CurrentBenefitCollection = App.SurveyBenefitCollection.FinalBenefitList[pageNumber];

            staticTemplateArray = new string[] { @"<!DOCTYPE html>
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


    /*.BenefitsCollection {
        height: 800px;
    }*/

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
        <div class='BenefitsCollection container'>
            <div class='BenefitRow row'>
                <button id='BB1'class='Benefit col-md-5' type='submit'>
                    <div class='row'>
                        <div id='BL1'class='BenefitTitle'>", @"</div>
                    </div>
                    <div id='BC1' class='row'>
                        <img id='BI1' class='BenefitImage col-md-6' src='", @"'></img>
                        <div id='BT1' class='BenefitText col-md-6'>", @"</div>
                        
                    </div>
                </button>
                <button id='BB2' class='Benefit col-md-5' type='submit'>
                    <div class='row'>
                        <div id='BL2' class='BenefitTitle'>", @"</div>
                    </div>
                    <div id='BC2' class='row'>
                        <img id='BI2' class='BenefitImage col-md-6' src='", @"'></img>
                        <div id='BT2' class='BenefitText col-md-6'>", @"</div>
                        
                    </div>
                </button>
            </div>
            <div class='BenefitRow row'>
                <button id='BB3' class='Benefit col-md-5' type='submit'>
                    <div class='row'>
                        <div id='BL3' class='BenefitTitle'>", @"</div>
                    </div>
                    <div id='BC3' class='row'>
                        
                        <img id='BI3' class='BenefitImage col-md-6' src='", @"'></img>
                        <div id='BT3' class='BenefitText col-md-6'>", @"</div>
                        
                    </div>
                </button>
                <button id='BB4' class='Benefit col-md-5' type='submit'>
                    <div class='row'>
                        <div id='BL4' class='BenefitTitle'>", @"</div>
                    </div>
                    <div id='BC4' class='row'>
                        <img id='BI4' class='BenefitImage col-md-6' src='", @"'></img>
                        <div id='BT4' class='BenefitText col-md-6'>", @"</div>
                    </div>
                </button>
            </div>
        </div>
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
                    currentParent.appendChild(document.getElementById('BC'.concat(indexArray[i]+1)).cloneNode(true));
        }
                for (var i = 0; i< 4; i++)
                {
                    var currentParent = document.getElementById('BB'.concat(i + 1));
        currentParent.removeChild(currentParent.childNodes[3]);
                }
        </script>
    </div>
    <footer>Page:", @"</footer>
</body>
</html>"
        };
            //dynamicTemplateArray = new string[] {  };

            surveyTemplateString = staticTemplateArray[0]
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
                + (pageNumber + 1) + staticTemplateArray[13];


            indexArray = new int[] { 0, 1, 2, 3 };
            //BenefitTextStrings = new string[]{ "Text1", "Text2", "Text3", "Text4" };
            //BenefitImgSrcStrings = new string[] { "./Assets/StoreLogo.png", "./Assets/StoreLogo.png", "./Assets/StoreLogo.png", "./Assets/StoreLogo.png" };
            filePicker = new Windows.Storage.Pickers.FileSavePicker(); //Windows.Storage.ApplicationData.Current.LocalFolder;

        }

        public void Image_DragOver(object sender, Windows.UI.Xaml.DragEventArgs e)
        {
            e.AcceptedOperation = DataPackageOperation.Copy;

            Debug.WriteLine("Dragging.");
        }

        public void Image_Drop(object sender, IReadOnlyList<IStorageItem> items)
        {

                    StorageFile storageFile = items[0] as StorageFile;
                    Windows.UI.Xaml.Media.Imaging.BitmapImage bitmapImage = new Windows.UI.Xaml.Media.Imaging.BitmapImage(new Uri("ms-appx:///Assets/" + storageFile.Name));
                    //await bitmapImage.SetSourceAsync(await storageFile.OpenAsync(FileAccessMode.Read));
                    //await UploadOpAsync(bitmapImage.UriSource, storageFile);
                    // Set the image on the main page to the dropped image
                    //Debug.WriteLine("image uri = " + new Uri("ms-appx:///Assets/" + storageFile.Name));
                    Windows.UI.Xaml.Controls.GridViewItem senderItem = sender as Windows.UI.Xaml.Controls.GridViewItem;
                    if (senderItem.Name == "Benefit1")
                    {
                        CurrentBenefitCollection[0].BenefitImage = bitmapImage;
                        //Benefit1ImageDisplay.Source = CurrentBenefitCollection[0].BenefitImage;
                    }
                    else if (senderItem.Name == "Benefit2")
                    {
                        CurrentBenefitCollection[1].BenefitImage = bitmapImage;
                        //Benefit2ImageDisplay.Source = CurrentBenefitCollection[1].BenefitImage;
                    }
                    else if (senderItem.Name == "Benefit3")
                    {
                        CurrentBenefitCollection[2].BenefitImage = bitmapImage;
                        //Benefit3ImageDisplay.Source = CurrentBenefitCollection[2].BenefitImage;
                    }
                    else if (senderItem.Name == "Benefit4")
                    {
                        CurrentBenefitCollection[3].BenefitImage = bitmapImage;
                        //Benefit4ImageDisplay.Source = CurrentBenefitCollection[3].BenefitImage;
                    }
                    Debug.WriteLine("Image is now: " + CurrentBenefitCollection[0].BenefitImage.UriSource);
                    //Image.Source = bitmapImage;
                    App.SurveyBenefitCollection.FinalBenefitList[pageNumber] = CurrentBenefitCollection;
        }

        public void Image_Loaded(object sender, Windows.UI.Xaml.RoutedEventArgs e)
        {
            Windows.UI.Xaml.Controls.Image img = sender as Windows.UI.Xaml.Controls.Image;
            if (img != null)
            {
                img.Source = CurrentBenefitCollection[0].BenefitImage;
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

            Debug.WriteLine("Hey: " + CurrentBenefitCollection[indexArray[0]].BenefitImage.UriSource);

            surveyTemplateString = staticTemplateArray[0]
                + CurrentBenefitCollection[0].BenefitLabel + staticTemplateArray[1]
                + rootURL + CurrentBenefitCollection[indexArray[0]].BenefitImage.UriSource.OriginalString.Substring(10) + staticTemplateArray[2]
                + CurrentBenefitCollection[indexArray[0]].BenefitText + staticTemplateArray[3]
                + CurrentBenefitCollection[1].BenefitLabel + staticTemplateArray[4]
                + rootURL + CurrentBenefitCollection[indexArray[1]].BenefitImage.UriSource.OriginalString.Substring(10) + staticTemplateArray[5]
                + CurrentBenefitCollection[indexArray[1]].BenefitText + staticTemplateArray[6]
                + CurrentBenefitCollection[2].BenefitLabel + staticTemplateArray[7]
                + rootURL + CurrentBenefitCollection[indexArray[2]].BenefitImage.UriSource.OriginalString.Substring(10) + staticTemplateArray[8]
                + CurrentBenefitCollection[indexArray[2]].BenefitText + staticTemplateArray[9]
                + CurrentBenefitCollection[3].BenefitLabel + staticTemplateArray[10]
                + rootURL + CurrentBenefitCollection[indexArray[3]].BenefitImage.UriSource.OriginalString.Substring(10) + staticTemplateArray[11]
                + CurrentBenefitCollection[indexArray[3]].BenefitText + staticTemplateArray[12]
                + pageNumber + staticTemplateArray[13];

            //StorageFile tempImageFile = await storageFolder.CreateFileAsync("tempImageFile.png");
            //await UploadOpAsync(CurrentBenefitCollection[3].BenefitImage.UriSource, tempImageFile);

            filePicker.FileTypeChoices.Add("HTML", new List<string>() { ".html" });
            Windows.Storage.StorageFile sampleFile = await filePicker.PickSaveFileAsync();
            if (sampleFile != null)
            {
                var stream = await sampleFile.OpenAsync(Windows.Storage.FileAccessMode.ReadWrite);

                using (var outputStream = stream.GetOutputStreamAt(0))
                {
                    using (var dataWriter = new Windows.Storage.Streams.DataWriter(outputStream))
                    {
                        //Debug.WriteLine("Should Write Stuff.");

                        dataWriter.WriteString(surveyTemplateString);
                        await dataWriter.StoreAsync();
                        await outputStream.FlushAsync();
                    }
                }
                stream.Dispose();
            }

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
