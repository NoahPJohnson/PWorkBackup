using System;
using System.Collections.Generic;
using System.Collections.ObjectModel;
using System.Diagnostics;
using System.IO;
using System.Linq;
using System.Runtime.InteropServices.WindowsRuntime;
using System.Runtime.Serialization.Json;
using Windows.ApplicationModel.DataTransfer;
using Windows.Data.Json;
using Windows.Foundation;
using Windows.Foundation.Collections;
using Windows.Storage;
using Windows.Storage.Streams;
using Windows.UI.Xaml;
using Windows.UI.Xaml.Controls;
using Windows.UI.Xaml.Controls.Primitives;
using Windows.UI.Xaml.Data;
using Windows.UI.Xaml.Input;
using Windows.UI.Xaml.Media;
using Windows.UI.Xaml.Media.Animation;
using Windows.UI.Xaml.Media.Imaging;
using Windows.UI.Xaml.Navigation;


// The Blank Page item template is documented at https://go.microsoft.com/fwlink/?LinkId=402352&clcid=0x409

namespace TestSurveyApp
{
    /// <summary>
    /// An empty page that can be used on its own or navigated to within a Frame.
    /// </summary>
    public sealed partial class MainPage : Page
    {
        //public Page[] surveyPagesArray;
        //public ObservableCollection<ObservableCollection<Benefit>> FinalBenefitList { get; set; }
        //public BenefitCollection SurveyBenefitCollection { get; set; }
        //public SurveyPage surveyPage { get; set; }
        Windows.Storage.Pickers.FileOpenPicker fileOpenPicker;
        Windows.Storage.Pickers.FolderPicker folderPicker;


        public MainPage()
        {
            this.InitializeComponent();
            //surveyPage = new SurveyPage(0);
            folderPicker = new Windows.Storage.Pickers.FolderPicker();
            fileOpenPicker = new Windows.Storage.Pickers.FileOpenPicker();
        }
        
        public async void CreateSurveyFolder(object sender, RoutedEventArgs e)
        {
            App.surveyFolder = await DownloadsFolder.CreateFolderAsync(SurveyNameInput.Text, CreationCollisionOption.FailIfExists); //ApplicationData.Current.LocalFolder.CreateFolderAsync(SurveyNameInput.Text, CreationCollisionOption.FailIfExists);
            App.surveyFile = await App.surveyFolder.CreateFileAsync(SurveyNameInput.Text + ".json", CreationCollisionOption.ReplaceExisting);
            /*folderPicker.FileTypeFilter.Add("*");
            folderPicker.SuggestedStartLocation = Windows.Storage.Pickers.PickerLocationId.Desktop;
            App.surveyFolder = await folderPicker.PickSingleFolderAsync();*/
            if (App.surveyFolder != null)
            {
                CurrentPageFrame.Navigate(typeof(SurveyPages.TitlePage));
            }
        }

        public async void OpenSurveyFile(object sender, RoutedEventArgs e)
        {
            folderPicker.FileTypeFilter.Add("*");
            folderPicker.SuggestedStartLocation = Windows.Storage.Pickers.PickerLocationId.Downloads;
            App.surveyFolder = await folderPicker.PickSingleFolderAsync();
            


            /*fileOpenPicker.FileTypeFilter.Add(".json");
            fileOpenPicker.SuggestedStartLocation = Windows.Storage.Pickers.PickerLocationId.Downloads;
            StorageFile jsonFile = await fileOpenPicker.PickSingleFileAsync();*/
            App.surveyFile = await App.surveyFolder.GetFileAsync(App.surveyFolder.Name + ".json");
            //App.surveyFolder = await jsonFile.GetParentAsync();
            if (App.surveyFolder == null)
            {
                Debug.WriteLine("Survey Folder is null");
            }
            var stream = System.IO.WindowsRuntimeStreamExtensions.AsStreamForRead(await App.surveyFile.OpenAsync(FileAccessMode.Read));
            //App.surveyFolder = await StorageFolder.GetFolderFromPathAsync(jsonFile.Path.Remove(jsonFile.Path.Length - jsonFile.Name.Length));


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
    }
}
