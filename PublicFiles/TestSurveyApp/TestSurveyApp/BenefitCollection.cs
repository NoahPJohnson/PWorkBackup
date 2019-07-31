using System;
using System.Collections.Generic;
using System.Collections.ObjectModel;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using Windows.UI.Xaml.Media.Imaging;

namespace TestSurveyApp
{
    public class BenefitCollection
    {
        public ObservableCollection<ObservableCollection<Benefit>> FinalBenefitList { get; set; }

        public BenefitCollection()
        {
            FinalBenefitList = new ObservableCollection<ObservableCollection<Benefit>>();
            for (int i = 0; i < 8; i++)
            {
                FinalBenefitList.Add(new ObservableCollection<Benefit>());
                for (int j = 0; j < 4; j++)
                {
                    FinalBenefitList[i].Add(new Benefit("Benefit: " + j));
                    if (j == 0)
                    {
                        FinalBenefitList[i][FinalBenefitList[i].Count - 1].BenefitIndex = (i + 1) + "-a";
                    }
                    else if (j == 1)
                    {
                        FinalBenefitList[i][FinalBenefitList[i].Count - 1].BenefitIndex = (i + 1) + "-b";
                    }
                    else if (j == 2)
                    {
                        FinalBenefitList[i][FinalBenefitList[i].Count - 1].BenefitIndex = (i + 1) + "-c";
                    }
                    else if (j == 3)
                    {
                        FinalBenefitList[i][FinalBenefitList[i].Count - 1].BenefitIndex = (i + 1) + "-d";
                    }
                }
            }
        }
    }

    public class Benefit
    {

        public string BenefitText { get; set; }
        public Uri BenefitImage { get; set; }
        public string BenefitLabel { get; set; }
        public string BenefitIndex { get; set; }

        public Benefit()
        {
            BenefitText = "BenefitText";
            BenefitImage = new Uri("");
            BenefitLabel = "Benefit Title";
        }

        public Benefit(string newBenefitText)
        {
            BenefitText = newBenefitText;
            BenefitImage = new Uri("ms-appx:///Assets/Pizza.png");
            BenefitLabel = "Benefit Title";
        }

        public Benefit(string newBenefitText, Uri newImageUri)
        {
            BenefitText = newBenefitText;
            BenefitImage = newImageUri;
            BenefitLabel = "Benefit Title";
        }

        public Benefit(string newBenefitText, string newBenefitLabel)
        {
            BenefitText = newBenefitText;
            BenefitImage = new Uri("ms-appx:///Assets/Pizza.png");
            BenefitLabel = newBenefitLabel;
        }

        public Benefit(string newBenefitText, Uri newImageUri, string newBenefitLabel)
        {
            BenefitText = newBenefitText;
            BenefitImage = newImageUri;
            BenefitLabel = newBenefitLabel;
        }
    }
}
