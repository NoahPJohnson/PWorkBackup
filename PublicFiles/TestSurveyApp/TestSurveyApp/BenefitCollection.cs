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
                }
            }
        }
    }

    public class Benefit
    {

        public string BenefitText { get; set; }
        public BitmapImage BenefitImage { get; set; }
        public string BenefitLabel { get; set; }

        public Benefit()
        {
            BenefitText = "BenefitText";
            BenefitImage = new BitmapImage();
            BenefitLabel = "Benefit Title";
        }

        public Benefit(string newBenefitText)
        {
            BenefitText = newBenefitText;
            BenefitImage = new BitmapImage(new Uri("ms-appx:///Assets/Pizza.png"));
            BenefitLabel = "Benefit Title";
        }

        public Benefit(string newBenefitText, BitmapImage newImage)
        {
            BenefitText = newBenefitText;
            BenefitImage = newImage;
            BenefitLabel = "Benefit Title";
        }

        public Benefit(string newBenefitText, string newBenefitLabel)
        {
            BenefitText = newBenefitText;
            BenefitImage = new BitmapImage(new Uri("ms-appx:///Assets/Pizza.png"));
            BenefitLabel = newBenefitLabel;
        }

        public Benefit(string newBenefitText, BitmapImage newImage, string newBenefitLabel)
        {
            BenefitText = newBenefitText;
            BenefitImage = newImage;
            BenefitLabel = newBenefitLabel;
        }
    }
}
