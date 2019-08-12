# UWP Survey Builder Project
[Big Bang]

This project aims to create an application that can quickly build surveys with the desired style and layout for branding mri processes. The key features are a drag and drop interface for adding images, buttons instead of text input for answering questions, and an XAML-based layout.


----------

## Main Page
* Main Page has two buttons currently. The first one creates a folder in a local directory with a name provided by the user. Then it navigates to the title page corresponding to that survey folder.
	* The name comes from a flyout element from the button. The flyout contains a textbox and a button that calls the following function:

**Code:**

        public async void CreateSurveyFolder(object sender, RoutedEventArgs e)
        {
            App.surveyFolder = await ApplicationData.Current.LocalFolder.CreateFolderAsync(SurveyNameInput.Text, CreationCollisionOption.FailIfExists);
            if (App.surveyFolder != null)
            {
                CurrentPageFrame.Navigate(typeof(SurveyPages.TitlePage));
            }
        }
 
* The other button on Main Page selects the .json file inside the local folder that holds the data that distinguishes each survey. 
	* **Note:** Both these and other file handling functions use file pickers to select the files. There is an issue where I want the app to create a folder in a directory it has easy access to without using a folder picker. Right now the user must pick the folder and the file when creating and opening. I just want this to happen on Open.
	* The button calls this function directly:

**Code:**

        public async void OpenSurveyFile(object sender, RoutedEventArgs e)
        {
            folderPicker.FileTypeFilter.Add("*");
            folderPicker.SuggestedStartLocation = Windows.Storage.Pickers.PickerLocationId.DocumentsLibrary;
            App.surveyFolder = await folderPicker.PickSingleFolderAsync();
            


            fileOpenPicker.FileTypeFilter.Add(".json");
            fileOpenPicker.SuggestedStartLocation = Windows.Storage.Pickers.PickerLocationId.DocumentsLibrary;
            StorageFile jsonFile = await fileOpenPicker.PickSingleFileAsync();
            App.surveyFile = jsonFile;
            var stream = System.IO.WindowsRuntimeStreamExtensions.AsStreamForRead(await jsonFile.OpenAsync(FileAccessMode.Read));


            if (stream != null)
            {
                DataContractJsonSerializer deserializer = new DataContractJsonSerializer(typeof(ObservableCollection<ObservableCollection<Benefit>>));
                App.SurveyBenefitCollection.FinalBenefitList = deserializer.ReadObject(stream) as ObservableCollection<ObservableCollection<Benefit>>;

                CurrentPageFrame.Navigate(typeof(SurveyPages.TitlePage));
            }
            else
            {
                Debug.WriteLine("NULL");
            }
        }

>There is still plenty of room on this page for content.
>
>* File structure?
>* Images?

## Title Page
* Title Page just displays the survey title (the name of the survey folder) and the navigation tab. 


>### Navigation
>* Navigation on the XAML side of the app displays a NavigationView Element and a Frame Element. Selecting a NavigationItem changes the content of the Frame. Thus, the NavigationView is only included once and each new page exists in the adjacent Frame.
>* On the C# side, navigation uses a simple switch statement and has hard coded destinations. 

* The Title display could be changed to a TextBox to change the name of the survey at the user's discretion.
* The Title Page and the next 8 main pages of the survey have a 'Save' button and a 'Publish' button. 

### Save
* This function uses a Windows File Picker to write a string to a .json file. 
* Make sure it completely clears the old data when overwriting. 

### Publish
* This function was intended to use Windows HTTP Client to upload the .json files and the image files to the web hosting site. But bluehost won't allow POST requests. 
* The function could be used to zip the files. 


## Pages 1-8
* The main contents of the survey. Each page has 4 benefits, each benefit has an image, text, title, and index. 
* Drag images in and type in the text inputs to add image files and write text to the .json file when it's saved. The image url will link to the folder on the web host. 
* These pages and the title page inherit from a SurveyPage class that contains most of the logic for the uploading, saving, and writing. 

