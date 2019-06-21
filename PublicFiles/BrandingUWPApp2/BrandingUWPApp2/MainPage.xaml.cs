using System;
using System.Collections.Generic;
using System.Collections.ObjectModel;
using System.IO;
using System.Linq;
using System.Runtime.InteropServices.WindowsRuntime;
using Windows.Foundation;
using Windows.Foundation.Collections;
using Windows.UI.Xaml;
using Windows.UI.Xaml.Controls;
using Windows.UI.Xaml.Controls.Primitives;
using Windows.UI.Xaml.Data;
using Windows.UI.Xaml.Input;
using Windows.UI.Xaml.Media;
using Windows.UI.Xaml.Navigation;
using MySql.Data.MySqlClient;

// The Blank Page item template is documented at https://go.microsoft.com/fwlink/?LinkId=402352&clcid=0x409

namespace BrandingUWPApp2
{
    /// <summary>
    /// An empty page that can be used on its own or navigated to within a Frame.
    /// </summary>
    public sealed partial class MainPage : Page
    {
        public bool ignoreNextTextChanged = false;
        public MainPage()
        {
            this.InitializeComponent();
            this.ViewModel = new CompanyCodeViewModel();
            string SQLPath = "server=66.147.242.194;user=prodigb3_npj;database=prodigb3_npjTest;port=3306;password=ButterscotchRipple!";
            MySqlConnection connection = new MySqlConnection(SQLPath);
            connection.Open();
            string query = "SELECT * FROM NAICSCodeTable;";
            MySqlCommand command = new MySqlCommand(query, connection);
            MySqlDataReader reader = command.ExecuteReader();
            while (reader.Read())
            {
                ViewModel.AddCompanyCode(new CompanyCode(reader.GetString(0), reader.GetString(1)));
            }
            reader.Close();
            connection.Close();
            //SQLite.Net.SQLiteConnection SQLConnection = new SQLite.Net.SQLiteConnection(new SQLite.Net.Platform.WinRT.SQLitePlatformWinRT(), SQLPath);
            /*
            string[] longArray = longText.Split(',');
            SQLConnection.DropTable<CompanyCode>();
            SQLConnection.CreateTable<CompanyCode>();
            string code = "blank";
            string oldCode = code;
            string description = "BLANK";
            string oldDescription = description;
            for (int i = 0; i < longArray.Length; i+=2)
            {
                code = longArray[i];
                description = longArray[i+1];
                if (description != oldDescription)
                {
                    CompanyCode newBusinessCode = new CompanyCode(code, description);
                    var row = SQLConnection.Insert(newBusinessCode);
                }
                oldDescription = description;
            }
            */
            //this.ViewModel = new CompanyCodeViewModel(SQLConnection.Table<CompanyCode>());
            ViewModel.LimitDisplayNAICSCode("");

        }
        public CompanyCodeViewModel ViewModel { get; set; }

        private void NAICSInputChanging(TextBox sender, TextBoxTextChangingEventArgs args)
        {
            if (ignoreNextTextChanged)
            {
                ignoreNextTextChanged = false;
                return;
            }
            // All other scenarios other than the backspace scenario.
            // Do the auto complete. 
            else
            {
                ViewModel.LimitDisplayNAICSCode(sender.Text);
            }



        }

        private void DescriptionInputChanged(object sender, TextChangedEventArgs args)
        {
            if (ignoreNextTextChanged)
            {
                ignoreNextTextChanged = false;
                return;
            }
            // All other scenarios other than the backspace scenario.
            // Do the auto complete. 
            else
            {
                ViewModel.LimitDisplayDescription(DescriptionInputBox.Text);
            }
        }
    }

    public class CompanyCode
    {
        public string NAICSCode { get; set; }
        public string Description { get; set; }
        public CompanyCode()
        {
            this.NAICSCode = "******";
            this.Description = "Default Description";
        }
        public CompanyCode(string newNAICSCode, string newDescription)
        {
            this.NAICSCode = newNAICSCode;
            this.Description = newDescription;
        }
    }
    public class CompanyCodeViewModel
    {
        private List<CompanyCode> companyCodeList = new List<CompanyCode>();
        public List<CompanyCode> CompanyCodeList { get { return this.companyCodeList; } }

        private ObservableCollection<CompanyCode> companyCodeCollection = new ObservableCollection<CompanyCode>();
        public ObservableCollection<CompanyCode> CompanyCodeCollection { get { return this.companyCodeCollection; } }

        public CompanyCodeViewModel(/*SQLite.Net.TableQuery<CompanyCode> companyCodeTable*/)
        {

            /*for (int i = 0; i < companyCodeTable.Count(); i++)
            {
                companyCodeList.Add(companyCodeTable.ElementAt<CompanyCode>(i));
            }*/
        }

        public void AddCompanyCode(CompanyCode codeToAdd)
        {
            companyCodeList.Add(codeToAdd);
        }

        public void LimitDisplayNAICSCode(string NAICSInputValue)
        {
            companyCodeCollection.Clear();
            if (NAICSInputValue == "")
            {
                for (int i = 0; i < companyCodeList.Count(); i++)
                {
                    companyCodeCollection.Add(companyCodeList.ElementAt<CompanyCode>(i));
                }
            }
            else
            {
                for (int i = 0; i < companyCodeList.Count(); i++)
                {
                    if (companyCodeList[i].NAICSCode.StartsWith(NAICSInputValue))
                    {
                        companyCodeCollection.Add(companyCodeList[i]);
                    }
                }
            }
            //companyCodeCollection = SQLConnection.
        }

        public void LimitDisplayDescription(string DescriptionInputValue)
        {
            companyCodeCollection.Clear();
            if (DescriptionInputValue == "")
            {
                for (int i = 0; i < companyCodeList.Count(); i++)
                {
                    companyCodeCollection.Add(companyCodeList.ElementAt<CompanyCode>(i));
                }
            }
            else
            {
                for (int i = 0; i < companyCodeList.Count(); i++)
                {
                    if (companyCodeList[i].Description.Contains(DescriptionInputValue))
                    {
                        companyCodeCollection.Add(companyCodeList[i]);
                    }
                }
            }
        }
    }
}
