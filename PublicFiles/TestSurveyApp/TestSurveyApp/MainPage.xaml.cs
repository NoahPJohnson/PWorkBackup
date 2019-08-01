using System;
using System.Collections.Generic;
using System.Collections.ObjectModel;
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
        public SurveyPage surveyPage { get; set; }

        public MainPage()
        {
            this.InitializeComponent();
            surveyPage = new SurveyPage(0);
            

        }

        public void Image_DragOver(object sender, DragEventArgs e)
        {
            surveyPage.Image_DragOver(sender, e);
        }

        public async void Image_Drop(object sender, DragEventArgs e)
        {

            if (e.DataView.Contains(StandardDataFormats.StorageItems))
            {
                Debug.WriteLine("Contains storage items.");
                var items = await e.DataView.GetStorageItemsAsync();
                if (items.Count > 0)
                {
                    surveyPage.Image_Drop(sender, items);
                }
            }
            Benefit1ImageDisplay.Source = new BitmapImage(surveyPage.CurrentBenefitCollection[0].BenefitImage);
            Benefit2ImageDisplay.Source = new BitmapImage(surveyPage.CurrentBenefitCollection[1].BenefitImage);
            Benefit3ImageDisplay.Source = new BitmapImage(surveyPage.CurrentBenefitCollection[2].BenefitImage);
            Benefit4ImageDisplay.Source = new BitmapImage(surveyPage.CurrentBenefitCollection[3].BenefitImage);
        }

        public void Image_Loaded(object sender, RoutedEventArgs e)
        {
            surveyPage.Image_Loaded(sender, e);
        }

        public void BenefitTextBox_TextChanging(TextBox sender, TextBoxTextChangingEventArgs args)
        {
            surveyPage.BenefitTextBox_TextChanging(sender, args);
        }

        public void SaveToFile(object sender, RoutedEventArgs e)
        {
            surveyPage.SaveToFile(sender, e);

        }

        public void UploadToServer(object sender, RoutedEventArgs e)
        {
            surveyPage.UploadToServer(sender, e);
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

        private void NavigationView_Loaded(object sender, RoutedEventArgs e)
        {
            /*// Add handler for ContentFrame navigation.
            CurrentPageFrame.Navigated += On_Navigated;

            // NavView doesn't load any page by default, so load home page.
            PageNavigationView.SelectedItem = PageNavigationView.MenuItems[0];
            // If navigation occurs on SelectionChanged, this isn't needed.
            // Because we use ItemInvoked to navigate, we need to call Navigate
            // here to load the home page.
            NavigationView_Navigate("Page1", new EntranceNavigationTransitionInfo());*/

        }

        private void On_Navigated(object sender, NavigationEventArgs e)
        {
            /*var item = e. == e.SourcePageType);

            NavView.SelectedItem = NavView.MenuItems
                .OfType<muxc.NavigationViewItem>()
                .First(n => n.Tag.Equals(item.Tag));*/

        }

        
    }
}
