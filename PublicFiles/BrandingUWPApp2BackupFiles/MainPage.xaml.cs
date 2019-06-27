using System;
using System.Collections.Generic;
using System.Collections.ObjectModel;
using System.Diagnostics;
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
            this.ViewTreeModel = new ObservableCollection<TreeObjectCollection<CompanyCode>>();
            this.CompanyCodeTree = new TreeObjectCollection<CompanyCode>();
            //The path and necessary information to reference the MySQL database, Query the database on app startup
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
            //Fill out the tree based on the List of CompanyCodes
            ConstructTree();
            //Call Limit function with empty string to display all NAICS Codes at the start
            ViewModel.LimitDisplayNAICSCode("");

        }
        
        //ViewModel contains the list of codes that the XAML page can reference
        public CompanyCodeViewModel ViewModel { get; set; }

        //ViewTreeModel is what the XAML page can reference to get the tree structure
        public ObservableCollection<TreeObjectCollection<CompanyCode>> ViewTreeModel { get; set; }

        //CompanyCodeTree is an internal representation of the entire tree structure
        private TreeObjectCollection<CompanyCode> CompanyCodeTree;


        //Fill out the tree structure
        private void ConstructTree()
        {
            //Arbitrary root for the tree, it is displayed, and can change when user inputs into a text field
            TreeCodeCollection root = new TreeCodeCollection(new CompanyCode("000000", "Root"));

            //This 2D List contains several rows of tree organized by the length of their NAICS code
            List<TreeCodeCollection>[] TwoDList = { new List<TreeCodeCollection>(), new List<TreeCodeCollection>(), new List<TreeCodeCollection>(), new List<TreeCodeCollection>() };

            for (int i = 0; i < ViewModel.CompanyCodeList.Count; i++)
            {
                if (ViewModel.CompanyCodeList[i].NAICSCode.Length == 2)
                {
                    TwoDList[0].Add(new TreeCodeCollection(ViewModel.CompanyCodeList[i], root));
                    root.children.Add(TwoDList[0][TwoDList[0].Count - 1]);
                    root.observableChildren.Add(TwoDList[0][TwoDList[0].Count - 1]);
                    Debug.WriteLine("Added Child: " + TwoDList[0][TwoDList[0].Count - 1].data);
                }
                else if (ViewModel.CompanyCodeList[i].NAICSCode.Length == 3)
                {
                    TwoDList[1].Add(new TreeCodeCollection(ViewModel.CompanyCodeList[i]));
                }
                else if (ViewModel.CompanyCodeList[i].NAICSCode.Length == 4)
                {
                    TwoDList[2].Add(new TreeCodeCollection(ViewModel.CompanyCodeList[i]));
                }
                else if (ViewModel.CompanyCodeList[i].NAICSCode.Length >= 5)
                {
                    TwoDList[3].Add(new TreeCodeCollection(ViewModel.CompanyCodeList[i]));
                }
            }
            //Starting from the bottom of the 2D List, the 5+ digit codes, point the trees to their parents and their parents to them
            for (int i = 3; i > 0; i--)
            {
                for (int j = 0; j < TwoDList[i].Count; j++)
                {
                    for (int k = 0; k < TwoDList[i - 1].Count; k++)
                    {
                        if (TwoDList[i][j].data.NAICSCode.StartsWith(TwoDList[i - 1][k].data.NAICSCode))
                        {
                            TwoDList[i][j].parent = TwoDList[i - 1][k];
                            TwoDList[i][j].parent.children.Add(TwoDList[i][j]);
                            TwoDList[i][j].parent.observableChildren.Add(TwoDList[i][j]);
                            //Debug.Log("Data = " + TwoDList[i][j].data + " Parent = " + TwoDList[i][j].parent.data);
                        }
                    }
                }
            }
            //Add this tree to the ViewTreeModel for display
            ViewTreeModel.Add(root);
            //Copy it to the CompanyCodeTree for storage
            CompanyCodeTree = root;
        }

        //Limit the codes displayed in the tree function by making the user's input code the new root
        private void LimitTreeView(string codeInput)
        {
            TreeObjectCollection<CompanyCode> root = CompanyCodeTree;
            TreeObjectCollection<CompanyCode> oldRoot = root;
            if (codeInput.Length > 1 && codeInput.Length <= 6)
            {
                while (root.data.NAICSCode != codeInput)
                {
                    for (int i = 0; i < root.children.Count; i++)
                    {
                        if (codeInput != root.children[i].data.NAICSCode)
                        {
                            if (codeInput.StartsWith(root.children[i].data.NAICSCode))
                            {
                                root = root.children[i];
                                break;
                            }
                        }
                        else
                        {
                            root = root.children[i];
                            break;
                        }
                    }
                    if (root == oldRoot)
                    {
                        break;
                    }
                    else
                    {
                        oldRoot = root;
                    }
                }
            }
            ViewTreeModel.Clear();
            ViewTreeModel.Add(root);
        }

        //Called when the user starts changing the NAICS Input
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
                LimitTreeView(sender.Text);
            }
        }

        //Called when the user finishes changing the Description Input
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

    //Custom class that contains an NAICS Code and that Codes Title (called Description)
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

    //Class that contains ObservableCollections corresponding to internal lists that the XAML Page can reference
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

    //A wrapper for the Tree class that isn't generic because the XAML Page can't reference a generic as a DataType
    public class TreeCodeCollection: TreeObjectCollection<CompanyCode>
    {
        public TreeCodeCollection()
        {
            data = default(CompanyCode);
            children = new List<TreeObjectCollection<CompanyCode>>();
            observableChildren = new ObservableCollection<TreeObjectCollection<CompanyCode>>(children);
        }

        public TreeCodeCollection(CompanyCode newData)
        {
            data = newData;
            children = new List<TreeObjectCollection<CompanyCode>>();
            observableChildren = new ObservableCollection<TreeObjectCollection<CompanyCode>>(children);
        }

        public TreeCodeCollection(CompanyCode newData, TreeObjectCollection<CompanyCode> newParent)
        {
            data = newData;
            children = new List<TreeObjectCollection<CompanyCode>>();
            observableChildren = new ObservableCollection<TreeObjectCollection<CompanyCode>>(children);
            parent = newParent;
        }
    }
    
}
