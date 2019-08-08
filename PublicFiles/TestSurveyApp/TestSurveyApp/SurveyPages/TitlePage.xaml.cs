using System;
using System.Collections.Generic;
using System.Diagnostics;
using System.IO;
using System.Linq;
using System.Runtime.InteropServices.WindowsRuntime;
using Windows.ApplicationModel.DataTransfer;
using Windows.Foundation;
using Windows.Foundation.Collections;
using Windows.Storage;
using Windows.UI.Xaml;
using Windows.UI.Xaml.Controls;
using Windows.UI.Xaml.Controls.Primitives;
using Windows.UI.Xaml.Data;
using Windows.UI.Xaml.Input;
using Windows.UI.Xaml.Media;
using Windows.UI.Xaml.Media.Animation;
using Windows.UI.Xaml.Media.Imaging;
using Windows.UI.Xaml.Navigation;

// The Blank Page item template is documented at https://go.microsoft.com/fwlink/?LinkId=234238

namespace TestSurveyApp.SurveyPages
{
    /// <summary>
    /// An empty page that can be used on its own or navigated to within a Frame.
    /// </summary>
    public sealed partial class TitlePage : Page
    {
        public SurveyPage surveyPage { get; set; }
        public string surveyName { get; set; }
        public TitlePage()
        {
            this.InitializeComponent();
            surveyPage = new SurveyPage(0);
            surveyName = App.surveyFolder.Name;

        }

        public void BenefitTextBox_TextChanging(TextBox sender, TextBoxTextChangingEventArgs args)
        {
            surveyPage.BenefitTextBox_TextChanging(sender, args);
        }

        public void SaveToFile(object sender, RoutedEventArgs e)
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
            surveyPage.SaveToFile(sender, e);

        }

        public async System.Threading.Tasks.Task UploadOpAsync(Uri uriInput, StorageFile file)
        {
            await surveyPage.UploadOpAsync(uriInput, file);
        }



        private void NavigationView_SelectionChanged(NavigationView sender, NavigationViewSelectionChangedEventArgs args)
        {
            if (args.SelectedItemContainer != null)
            {
                switch (args.SelectedItemContainer.Tag)
                {
                    case "Page1":
                        var navItemTag = args.SelectedItemContainer.Tag.ToString();
                        NavigationView_Navigate(navItemTag, args.RecommendedNavigationTransitionInfo);
                        break;
                    case "Page2":
                        CurrentPageFrame.Navigate(typeof(SurveyPages.SurveyPage2));
                        break;
                    case "Page3":
                        CurrentPageFrame.Navigate(typeof(SurveyPages.SurveyPage3));
                        break;
                    case "Page4":
                        CurrentPageFrame.Navigate(typeof(SurveyPages.SurveyPage4));
                        break;
                    case "Page5":
                        CurrentPageFrame.Navigate(typeof(SurveyPages.SurveyPage5));
                        break;
                    case "Page6":
                        CurrentPageFrame.Navigate(typeof(SurveyPages.SurveyPage6));
                        break;
                    case "Page7":
                        CurrentPageFrame.Navigate(typeof(SurveyPages.SurveyPage7));
                        break;
                    case "Page8":
                        CurrentPageFrame.Navigate(typeof(SurveyPages.SurveyPage8));
                        break;
                }
            }
        }

        private void NavigationView_Navigate(string navItemTag, NavigationTransitionInfo transitionInfo)
        {
            //App.SurveyBenefitCollection.FinalBenefitList[pageNumber] = CurrentBenefitCollection;
            //Debug.WriteLine("Page Number = " + pageNumber);
            Type _page = null;
            if (navItemTag == "settings")
            {
                //_page = typeof(SettingsPage);
            }
            else
            {
                //var item = _pages.FirstOrDefault(p => p.Tag.Equals(navItemTag));
                _page = typeof(SurveyPages.SurveyPage1);
            }
            // Get the page type before navigation so you can prevent duplicate
            // entries in the backstack.
            var preNavPageType = CurrentPageFrame.CurrentSourcePageType;

            // Only navigate if the selected page isn't currently loaded.
            if (!(_page is null) && !Type.Equals(preNavPageType, _page))
            {
                CurrentPageFrame.Navigate(_page, null, transitionInfo);
            }
        }
    }
}