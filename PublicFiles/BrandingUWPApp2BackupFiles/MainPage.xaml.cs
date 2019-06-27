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
            ConstructTree();
            ViewModel.LimitDisplayNAICSCode("");

        }
        private TreeObjectCollection<CompanyCode> CompanyCodeTree;

        public CompanyCodeViewModel ViewModel { get; set; }

        public ObservableCollection<TreeObjectCollection<CompanyCode>> ViewTreeModel { get; set; }
        

        private void ConstructTree()
        {
            TreeCodeCollection root = new TreeCodeCollection(new CompanyCode("000000", "Root"));
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
            ViewTreeModel.Add(root);
            CompanyCodeTree = root;
            //ViewTreeModel.Add(new TreeObjectCollection<CompanyCode>(new CompanyCode("00test", "I'm upset.")));
            //ViewTreeModel.Add(new TreeObjectCollection<CompanyCode>(new CompanyCode("01test", "I'm very upset.")));
            //ViewTreeModel.DisplayTree.Add(ViewTreeModel.CompanyCodeTree);
        }

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
