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
using Windows.UI.Xaml.Media.Imaging;
using Windows.UI.Xaml.Navigation;

// The Blank Page item template is documented at https://go.microsoft.com/fwlink/?LinkId=234238

namespace TestSurveyApp.SurveyPages
{
    /// <summary>
    /// An empty page that can be used on its own or navigated to within a Frame.
    /// </summary>
    public sealed partial class FinalBenefitPage : Page
    {
        public SurveyPage surveyPage { get; set; }

        public ObservableCollection<Benefit> randomBenefitList { get; set; } 
        public FinalBenefitPage()
        {
            this.InitializeComponent();
            surveyPage = new SurveyPage(0);

            randomBenefitList = new ObservableCollection<Benefit>();
            for (int i = 0; i < 8; i++)
            {
                Random randomGenerator = new Random();
                int randomIndex = randomGenerator.Next(0, 4);
                if (App.SurveyBenefitCollection.FinalBenefitList[i][randomIndex] != null)
                {
                    randomBenefitList.Add(App.SurveyBenefitCollection.FinalBenefitList[i][randomIndex]);
                }
                else
                {
                    randomBenefitList.Add(new Benefit());
                }
            }
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

    }
}
