﻿#pragma checksum "C:\Users\Noah\source\repos\TestSurveyApp\TestSurveyApp\MainPage.xaml" "{406ea660-64cf-4c82-b6f0-42d48172a799}" "E1801AB8B99E99C8A54DAC9E96A14C7F"
//------------------------------------------------------------------------------
// <auto-generated>
//     This code was generated by a tool.
//
//     Changes to this file may cause incorrect behavior and will be lost if
//     the code is regenerated.
// </auto-generated>
//------------------------------------------------------------------------------

namespace TestSurveyApp
{
    partial class MainPage : 
        global::Windows.UI.Xaml.Controls.Page, 
        global::Windows.UI.Xaml.Markup.IComponentConnector,
        global::Windows.UI.Xaml.Markup.IComponentConnector2
    {
        [global::System.CodeDom.Compiler.GeneratedCodeAttribute("Microsoft.Windows.UI.Xaml.Build.Tasks"," 10.0.17.0")]
        [global::System.Diagnostics.DebuggerNonUserCodeAttribute()]
        private static class XamlBindingSetters
        {
            public static void Set_Windows_UI_Xaml_Controls_TextBox_Text(global::Windows.UI.Xaml.Controls.TextBox obj, global::System.String value, string targetNullValue)
            {
                if (value == null && targetNullValue != null)
                {
                    value = targetNullValue;
                }
                obj.Text = value ?? global::System.String.Empty;
            }
            public static void Set_Windows_UI_Xaml_Controls_Image_Source(global::Windows.UI.Xaml.Controls.Image obj, global::Windows.UI.Xaml.Media.ImageSource value, string targetNullValue)
            {
                if (value == null && targetNullValue != null)
                {
                    value = (global::Windows.UI.Xaml.Media.ImageSource) global::Windows.UI.Xaml.Markup.XamlBindingHelper.ConvertValue(typeof(global::Windows.UI.Xaml.Media.ImageSource), targetNullValue);
                }
                obj.Source = value;
            }
        };

        [global::System.CodeDom.Compiler.GeneratedCodeAttribute("Microsoft.Windows.UI.Xaml.Build.Tasks"," 10.0.17.0")]
        [global::System.Diagnostics.DebuggerNonUserCodeAttribute()]
        private class MainPage_obj1_Bindings :
            global::Windows.UI.Xaml.Markup.IDataTemplateComponent,
            global::Windows.UI.Xaml.Markup.IXamlBindScopeDiagnostics,
            global::Windows.UI.Xaml.Markup.IComponentConnector,
            IMainPage_Bindings
        {
            private global::TestSurveyApp.MainPage dataRoot;
            private bool initialized = false;
            private const int NOT_PHASED = (1 << 31);
            private const int DATA_CHANGED = (1 << 30);

            // Fields for each control that has bindings.
            private global::Windows.UI.Xaml.Controls.TextBox obj9;
            private global::Windows.UI.Xaml.Controls.Image obj10;
            private global::Windows.UI.Xaml.Controls.TextBox obj11;
            private global::Windows.UI.Xaml.Controls.TextBox obj12;
            private global::Windows.UI.Xaml.Controls.Image obj13;
            private global::Windows.UI.Xaml.Controls.TextBox obj14;
            private global::Windows.UI.Xaml.Controls.TextBox obj15;
            private global::Windows.UI.Xaml.Controls.Image obj16;
            private global::Windows.UI.Xaml.Controls.TextBox obj17;
            private global::Windows.UI.Xaml.Controls.TextBox obj18;
            private global::Windows.UI.Xaml.Controls.Image obj19;
            private global::Windows.UI.Xaml.Controls.TextBox obj20;

            // Static fields for each binding's enabled/disabled state
            private static bool isobj9TextDisabled = false;
            private static bool isobj10SourceDisabled = false;
            private static bool isobj11TextDisabled = false;
            private static bool isobj12TextDisabled = false;
            private static bool isobj13SourceDisabled = false;
            private static bool isobj14TextDisabled = false;
            private static bool isobj15TextDisabled = false;
            private static bool isobj16SourceDisabled = false;
            private static bool isobj17TextDisabled = false;
            private static bool isobj18TextDisabled = false;
            private static bool isobj19SourceDisabled = false;
            private static bool isobj20TextDisabled = false;

            public MainPage_obj1_Bindings()
            {
            }

            public void Disable(int lineNumber, int columnNumber)
            {
                if (lineNumber == 91 && columnNumber == 130)
                {
                    isobj9TextDisabled = true;
                }
                else if (lineNumber == 92 && columnNumber == 95)
                {
                    isobj10SourceDisabled = true;
                }
                else if (lineNumber == 93 && columnNumber == 123)
                {
                    isobj11TextDisabled = true;
                }
                else if (lineNumber == 76 && columnNumber == 130)
                {
                    isobj12TextDisabled = true;
                }
                else if (lineNumber == 77 && columnNumber == 95)
                {
                    isobj13SourceDisabled = true;
                }
                else if (lineNumber == 78 && columnNumber == 123)
                {
                    isobj14TextDisabled = true;
                }
                else if (lineNumber == 61 && columnNumber == 130)
                {
                    isobj15TextDisabled = true;
                }
                else if (lineNumber == 62 && columnNumber == 95)
                {
                    isobj16SourceDisabled = true;
                }
                else if (lineNumber == 63 && columnNumber == 123)
                {
                    isobj17TextDisabled = true;
                }
                else if (lineNumber == 46 && columnNumber == 130)
                {
                    isobj18TextDisabled = true;
                }
                else if (lineNumber == 47 && columnNumber == 95)
                {
                    isobj19SourceDisabled = true;
                }
                else if (lineNumber == 48 && columnNumber == 123)
                {
                    isobj20TextDisabled = true;
                }
            }

            // IComponentConnector

            public void Connect(int connectionId, global::System.Object target)
            {
                switch(connectionId)
                {
                    case 9: // MainPage.xaml line 91
                        this.obj9 = (global::Windows.UI.Xaml.Controls.TextBox)target;
                        break;
                    case 10: // MainPage.xaml line 92
                        this.obj10 = (global::Windows.UI.Xaml.Controls.Image)target;
                        break;
                    case 11: // MainPage.xaml line 93
                        this.obj11 = (global::Windows.UI.Xaml.Controls.TextBox)target;
                        break;
                    case 12: // MainPage.xaml line 76
                        this.obj12 = (global::Windows.UI.Xaml.Controls.TextBox)target;
                        break;
                    case 13: // MainPage.xaml line 77
                        this.obj13 = (global::Windows.UI.Xaml.Controls.Image)target;
                        break;
                    case 14: // MainPage.xaml line 78
                        this.obj14 = (global::Windows.UI.Xaml.Controls.TextBox)target;
                        break;
                    case 15: // MainPage.xaml line 61
                        this.obj15 = (global::Windows.UI.Xaml.Controls.TextBox)target;
                        break;
                    case 16: // MainPage.xaml line 62
                        this.obj16 = (global::Windows.UI.Xaml.Controls.Image)target;
                        break;
                    case 17: // MainPage.xaml line 63
                        this.obj17 = (global::Windows.UI.Xaml.Controls.TextBox)target;
                        break;
                    case 18: // MainPage.xaml line 46
                        this.obj18 = (global::Windows.UI.Xaml.Controls.TextBox)target;
                        break;
                    case 19: // MainPage.xaml line 47
                        this.obj19 = (global::Windows.UI.Xaml.Controls.Image)target;
                        break;
                    case 20: // MainPage.xaml line 48
                        this.obj20 = (global::Windows.UI.Xaml.Controls.TextBox)target;
                        break;
                    default:
                        break;
                }
            }

            // IDataTemplateComponent

            public void ProcessBindings(global::System.Object item, int itemIndex, int phase, out int nextPhase)
            {
                throw new global::System.NotImplementedException();
            }

            public void Recycle()
            {
                throw new global::System.NotImplementedException();
            }

            // IMainPage_Bindings

            public void Initialize()
            {
                if (!this.initialized)
                {
                    this.Update();
                }
            }
            
            public void Update()
            {
                this.Update_(this.dataRoot, NOT_PHASED);
                this.initialized = true;
            }

            public void StopTracking()
            {
            }

            public void DisconnectUnloadedObject(int connectionId)
            {
                throw new global::System.ArgumentException("No unloadable elements to disconnect.");
            }

            public bool SetDataRoot(global::System.Object newDataRoot)
            {
                if (newDataRoot != null)
                {
                    this.dataRoot = (global::TestSurveyApp.MainPage)newDataRoot;
                    return true;
                }
                return false;
            }

            public void Loading(global::Windows.UI.Xaml.FrameworkElement src, object data)
            {
                this.Initialize();
            }

            private delegate void InvokeFunctionDelegate(int phase);
            private global::System.Collections.Generic.Dictionary<string, InvokeFunctionDelegate> PendingFunctionBindings = new global::System.Collections.Generic.Dictionary<string, InvokeFunctionDelegate>();

            private void Invoke_surveyPage_CurrentBenefitCollection_I3_M_GetImage_757602046(int phase)
            {
                global::Windows.UI.Xaml.Media.Imaging.BitmapImage result = this.dataRoot.surveyPage.CurrentBenefitCollection[3].GetImage();
                if ((phase & ((1 << 0) | NOT_PHASED )) != 0)
                {
                    // MainPage.xaml line 92
                    if (!isobj10SourceDisabled)
                    {
                        XamlBindingSetters.Set_Windows_UI_Xaml_Controls_Image_Source(this.obj10, result, null);
                    }
                }
            }

            private void Invoke_surveyPage_CurrentBenefitCollection_I2_M_GetImage_757602046(int phase)
            {
                global::Windows.UI.Xaml.Media.Imaging.BitmapImage result = this.dataRoot.surveyPage.CurrentBenefitCollection[2].GetImage();
                if ((phase & ((1 << 0) | NOT_PHASED )) != 0)
                {
                    // MainPage.xaml line 77
                    if (!isobj13SourceDisabled)
                    {
                        XamlBindingSetters.Set_Windows_UI_Xaml_Controls_Image_Source(this.obj13, result, null);
                    }
                }
            }

            private void Invoke_surveyPage_CurrentBenefitCollection_I1_M_GetImage_757602046(int phase)
            {
                global::Windows.UI.Xaml.Media.Imaging.BitmapImage result = this.dataRoot.surveyPage.CurrentBenefitCollection[1].GetImage();
                if ((phase & ((1 << 0) | NOT_PHASED )) != 0)
                {
                    // MainPage.xaml line 62
                    if (!isobj16SourceDisabled)
                    {
                        XamlBindingSetters.Set_Windows_UI_Xaml_Controls_Image_Source(this.obj16, result, null);
                    }
                }
            }

            private void Invoke_surveyPage_CurrentBenefitCollection_I0_M_GetImage_757602046(int phase)
            {
                global::Windows.UI.Xaml.Media.Imaging.BitmapImage result = this.dataRoot.surveyPage.CurrentBenefitCollection[0].GetImage();
                if ((phase & ((1 << 0) | NOT_PHASED )) != 0)
                {
                    // MainPage.xaml line 47
                    if (!isobj19SourceDisabled)
                    {
                        XamlBindingSetters.Set_Windows_UI_Xaml_Controls_Image_Source(this.obj19, result, null);
                    }
                }
            }

            private void CompleteUpdate(int phase)
            {
                foreach(var function in this.PendingFunctionBindings)
                {
                    function.Value.Invoke(phase);
                }
                this.PendingFunctionBindings.Clear();
            }

            // Update methods for each path node used in binding steps.
            private void Update_(global::TestSurveyApp.MainPage obj, int phase)
            {
                if (obj != null)
                {
                    if ((phase & (NOT_PHASED | (1 << 0))) != 0)
                    {
                        this.Update_surveyPage(obj.surveyPage, phase);
                    }
                }
                this.CompleteUpdate(phase);
            }
            private void Update_surveyPage(global::TestSurveyApp.SurveyPage obj, int phase)
            {
                if (obj != null)
                {
                    if ((phase & (NOT_PHASED | (1 << 0))) != 0)
                    {
                        this.Update_surveyPage_CurrentBenefitCollection(obj.CurrentBenefitCollection, phase);
                    }
                }
            }
            private void Update_surveyPage_CurrentBenefitCollection(global::System.Collections.ObjectModel.ObservableCollection<global::TestSurveyApp.Benefit> obj, int phase)
            {
                if (obj != null)
                {
                    if ((phase & (NOT_PHASED | (1 << 0))) != 0)
                    {
                        this.Update_surveyPage_CurrentBenefitCollection_I3(obj[3], phase);
                        this.Update_surveyPage_CurrentBenefitCollection_I2(obj[2], phase);
                        this.Update_surveyPage_CurrentBenefitCollection_I1(obj[1], phase);
                        this.Update_surveyPage_CurrentBenefitCollection_I0(obj[0], phase);
                    }
                }
            }
            private void Update_surveyPage_CurrentBenefitCollection_I3(global::TestSurveyApp.Benefit obj, int phase)
            {
                if (obj != null)
                {
                    if ((phase & (NOT_PHASED | (1 << 0))) != 0)
                    {
                        this.Update_surveyPage_CurrentBenefitCollection_I3_BenefitLabel(obj.BenefitLabel, phase);
                        this.Update_surveyPage_CurrentBenefitCollection_I3_M_GetImage_757602046(phase);
                        this.Update_surveyPage_CurrentBenefitCollection_I3_BenefitText(obj.BenefitText, phase);
                    }
                }
            }
            private void Update_surveyPage_CurrentBenefitCollection_I3_BenefitLabel(global::System.String obj, int phase)
            {
                if ((phase & ((1 << 0) | NOT_PHASED )) != 0)
                {
                    // MainPage.xaml line 91
                    if (!isobj9TextDisabled)
                    {
                        XamlBindingSetters.Set_Windows_UI_Xaml_Controls_TextBox_Text(this.obj9, obj, null);
                    }
                }
            }
            private void Update_surveyPage_CurrentBenefitCollection_I3_M_GetImage_757602046(int phase)
            {
                if ((phase & ((1 << 0) | NOT_PHASED )) != 0)
                {
                    if (!isobj10SourceDisabled)
                    {
                        this.PendingFunctionBindings["surveyPage_CurrentBenefitCollection_I3_M_GetImage_757602046"] = new InvokeFunctionDelegate(this.Invoke_surveyPage_CurrentBenefitCollection_I3_M_GetImage_757602046); 
                    }
                }
            }
            private void Update_surveyPage_CurrentBenefitCollection_I3_BenefitText(global::System.String obj, int phase)
            {
                if ((phase & ((1 << 0) | NOT_PHASED )) != 0)
                {
                    // MainPage.xaml line 93
                    if (!isobj11TextDisabled)
                    {
                        XamlBindingSetters.Set_Windows_UI_Xaml_Controls_TextBox_Text(this.obj11, obj, null);
                    }
                }
            }
            private void Update_surveyPage_CurrentBenefitCollection_I2(global::TestSurveyApp.Benefit obj, int phase)
            {
                if (obj != null)
                {
                    if ((phase & (NOT_PHASED | (1 << 0))) != 0)
                    {
                        this.Update_surveyPage_CurrentBenefitCollection_I2_BenefitLabel(obj.BenefitLabel, phase);
                        this.Update_surveyPage_CurrentBenefitCollection_I2_M_GetImage_757602046(phase);
                        this.Update_surveyPage_CurrentBenefitCollection_I2_BenefitText(obj.BenefitText, phase);
                    }
                }
            }
            private void Update_surveyPage_CurrentBenefitCollection_I2_BenefitLabel(global::System.String obj, int phase)
            {
                if ((phase & ((1 << 0) | NOT_PHASED )) != 0)
                {
                    // MainPage.xaml line 76
                    if (!isobj12TextDisabled)
                    {
                        XamlBindingSetters.Set_Windows_UI_Xaml_Controls_TextBox_Text(this.obj12, obj, null);
                    }
                }
            }
            private void Update_surveyPage_CurrentBenefitCollection_I2_M_GetImage_757602046(int phase)
            {
                if ((phase & ((1 << 0) | NOT_PHASED )) != 0)
                {
                    if (!isobj13SourceDisabled)
                    {
                        this.PendingFunctionBindings["surveyPage_CurrentBenefitCollection_I2_M_GetImage_757602046"] = new InvokeFunctionDelegate(this.Invoke_surveyPage_CurrentBenefitCollection_I2_M_GetImage_757602046); 
                    }
                }
            }
            private void Update_surveyPage_CurrentBenefitCollection_I2_BenefitText(global::System.String obj, int phase)
            {
                if ((phase & ((1 << 0) | NOT_PHASED )) != 0)
                {
                    // MainPage.xaml line 78
                    if (!isobj14TextDisabled)
                    {
                        XamlBindingSetters.Set_Windows_UI_Xaml_Controls_TextBox_Text(this.obj14, obj, null);
                    }
                }
            }
            private void Update_surveyPage_CurrentBenefitCollection_I1(global::TestSurveyApp.Benefit obj, int phase)
            {
                if (obj != null)
                {
                    if ((phase & (NOT_PHASED | (1 << 0))) != 0)
                    {
                        this.Update_surveyPage_CurrentBenefitCollection_I1_BenefitLabel(obj.BenefitLabel, phase);
                        this.Update_surveyPage_CurrentBenefitCollection_I1_M_GetImage_757602046(phase);
                        this.Update_surveyPage_CurrentBenefitCollection_I1_BenefitText(obj.BenefitText, phase);
                    }
                }
            }
            private void Update_surveyPage_CurrentBenefitCollection_I1_BenefitLabel(global::System.String obj, int phase)
            {
                if ((phase & ((1 << 0) | NOT_PHASED )) != 0)
                {
                    // MainPage.xaml line 61
                    if (!isobj15TextDisabled)
                    {
                        XamlBindingSetters.Set_Windows_UI_Xaml_Controls_TextBox_Text(this.obj15, obj, null);
                    }
                }
            }
            private void Update_surveyPage_CurrentBenefitCollection_I1_M_GetImage_757602046(int phase)
            {
                if ((phase & ((1 << 0) | NOT_PHASED )) != 0)
                {
                    if (!isobj16SourceDisabled)
                    {
                        this.PendingFunctionBindings["surveyPage_CurrentBenefitCollection_I1_M_GetImage_757602046"] = new InvokeFunctionDelegate(this.Invoke_surveyPage_CurrentBenefitCollection_I1_M_GetImage_757602046); 
                    }
                }
            }
            private void Update_surveyPage_CurrentBenefitCollection_I1_BenefitText(global::System.String obj, int phase)
            {
                if ((phase & ((1 << 0) | NOT_PHASED )) != 0)
                {
                    // MainPage.xaml line 63
                    if (!isobj17TextDisabled)
                    {
                        XamlBindingSetters.Set_Windows_UI_Xaml_Controls_TextBox_Text(this.obj17, obj, null);
                    }
                }
            }
            private void Update_surveyPage_CurrentBenefitCollection_I0(global::TestSurveyApp.Benefit obj, int phase)
            {
                if (obj != null)
                {
                    if ((phase & (NOT_PHASED | (1 << 0))) != 0)
                    {
                        this.Update_surveyPage_CurrentBenefitCollection_I0_BenefitLabel(obj.BenefitLabel, phase);
                        this.Update_surveyPage_CurrentBenefitCollection_I0_M_GetImage_757602046(phase);
                        this.Update_surveyPage_CurrentBenefitCollection_I0_BenefitText(obj.BenefitText, phase);
                    }
                }
            }
            private void Update_surveyPage_CurrentBenefitCollection_I0_BenefitLabel(global::System.String obj, int phase)
            {
                if ((phase & ((1 << 0) | NOT_PHASED )) != 0)
                {
                    // MainPage.xaml line 46
                    if (!isobj18TextDisabled)
                    {
                        XamlBindingSetters.Set_Windows_UI_Xaml_Controls_TextBox_Text(this.obj18, obj, null);
                    }
                }
            }
            private void Update_surveyPage_CurrentBenefitCollection_I0_M_GetImage_757602046(int phase)
            {
                if ((phase & ((1 << 0) | NOT_PHASED )) != 0)
                {
                    if (!isobj19SourceDisabled)
                    {
                        this.PendingFunctionBindings["surveyPage_CurrentBenefitCollection_I0_M_GetImage_757602046"] = new InvokeFunctionDelegate(this.Invoke_surveyPage_CurrentBenefitCollection_I0_M_GetImage_757602046); 
                    }
                }
            }
            private void Update_surveyPage_CurrentBenefitCollection_I0_BenefitText(global::System.String obj, int phase)
            {
                if ((phase & ((1 << 0) | NOT_PHASED )) != 0)
                {
                    // MainPage.xaml line 48
                    if (!isobj20TextDisabled)
                    {
                        XamlBindingSetters.Set_Windows_UI_Xaml_Controls_TextBox_Text(this.obj20, obj, null);
                    }
                }
            }
        }
        /// <summary>
        /// Connect()
        /// </summary>
        [global::System.CodeDom.Compiler.GeneratedCodeAttribute("Microsoft.Windows.UI.Xaml.Build.Tasks"," 10.0.17.0")]
        [global::System.Diagnostics.DebuggerNonUserCodeAttribute()]
        public void Connect(int connectionId, object target)
        {
            switch(connectionId)
            {
            case 2: // MainPage.xaml line 27
                {
                    this.CurrentPageFrame = (global::Windows.UI.Xaml.Controls.Frame)(target);
                }
                break;
            case 3: // MainPage.xaml line 101
                {
                    if (MainPage.IsApiContractPresent_Windows_Foundation_UniversalApiContract_5)
                    {
                        this.PageNavigationView = (global::Windows.UI.Xaml.Controls.NavigationView)(target);
                        if (MainPage.IsApiContractPresent_Windows_Foundation_UniversalApiContract_5)
                        {
                            ((global::Windows.UI.Xaml.Controls.NavigationView)this.PageNavigationView).SelectionChanged += this.NavigationView_SelectionChanged;
                        }
                        if (MainPage.IsApiContractPresent_Windows_Foundation_UniversalApiContract_5)
                        {
                            ((global::Windows.UI.Xaml.Controls.NavigationView)this.PageNavigationView).Loaded += this.NavigationView_Loaded;
                        }
                    }
                }
                break;
            case 4: // MainPage.xaml line 35
                {
                    this.BenefitsDisplay = (global::Windows.UI.Xaml.Controls.GridView)(target);
                }
                break;
            case 5: // MainPage.xaml line 36
                {
                    this.Benefit1 = (global::Windows.UI.Xaml.Controls.GridViewItem)(target);
                    ((global::Windows.UI.Xaml.Controls.GridViewItem)this.Benefit1).DragOver += this.Image_DragOver;
                    ((global::Windows.UI.Xaml.Controls.GridViewItem)this.Benefit1).Drop += this.Image_Drop;
                }
                break;
            case 6: // MainPage.xaml line 51
                {
                    this.Benefit2 = (global::Windows.UI.Xaml.Controls.GridViewItem)(target);
                    ((global::Windows.UI.Xaml.Controls.GridViewItem)this.Benefit2).DragOver += this.Image_DragOver;
                    ((global::Windows.UI.Xaml.Controls.GridViewItem)this.Benefit2).Drop += this.Image_Drop;
                }
                break;
            case 7: // MainPage.xaml line 66
                {
                    this.Benefit3 = (global::Windows.UI.Xaml.Controls.GridViewItem)(target);
                    ((global::Windows.UI.Xaml.Controls.GridViewItem)this.Benefit3).DragOver += this.Image_DragOver;
                    ((global::Windows.UI.Xaml.Controls.GridViewItem)this.Benefit3).Drop += this.Image_Drop;
                }
                break;
            case 8: // MainPage.xaml line 81
                {
                    this.Benefit4 = (global::Windows.UI.Xaml.Controls.GridViewItem)(target);
                    ((global::Windows.UI.Xaml.Controls.GridViewItem)this.Benefit4).DragOver += this.Image_DragOver;
                    ((global::Windows.UI.Xaml.Controls.GridViewItem)this.Benefit4).Drop += this.Image_Drop;
                }
                break;
            case 9: // MainPage.xaml line 91
                {
                    this.Benefit4TitleBox = (global::Windows.UI.Xaml.Controls.TextBox)(target);
                    ((global::Windows.UI.Xaml.Controls.TextBox)this.Benefit4TitleBox).TextChanging += this.BenefitTextBox_TextChanging;
                }
                break;
            case 10: // MainPage.xaml line 92
                {
                    this.Benefit4ImageDisplay = (global::Windows.UI.Xaml.Controls.Image)(target);
                }
                break;
            case 11: // MainPage.xaml line 93
                {
                    this.Benefit4TextBox = (global::Windows.UI.Xaml.Controls.TextBox)(target);
                    ((global::Windows.UI.Xaml.Controls.TextBox)this.Benefit4TextBox).TextChanging += this.BenefitTextBox_TextChanging;
                }
                break;
            case 12: // MainPage.xaml line 76
                {
                    this.Benefit3TitleBox = (global::Windows.UI.Xaml.Controls.TextBox)(target);
                    ((global::Windows.UI.Xaml.Controls.TextBox)this.Benefit3TitleBox).TextChanging += this.BenefitTextBox_TextChanging;
                }
                break;
            case 13: // MainPage.xaml line 77
                {
                    this.Benefit3ImageDisplay = (global::Windows.UI.Xaml.Controls.Image)(target);
                }
                break;
            case 14: // MainPage.xaml line 78
                {
                    this.Benefit3TextBox = (global::Windows.UI.Xaml.Controls.TextBox)(target);
                    ((global::Windows.UI.Xaml.Controls.TextBox)this.Benefit3TextBox).TextChanging += this.BenefitTextBox_TextChanging;
                }
                break;
            case 15: // MainPage.xaml line 61
                {
                    this.Benefit2TitleBox = (global::Windows.UI.Xaml.Controls.TextBox)(target);
                    ((global::Windows.UI.Xaml.Controls.TextBox)this.Benefit2TitleBox).TextChanging += this.BenefitTextBox_TextChanging;
                }
                break;
            case 16: // MainPage.xaml line 62
                {
                    this.Benefit2ImageDisplay = (global::Windows.UI.Xaml.Controls.Image)(target);
                }
                break;
            case 17: // MainPage.xaml line 63
                {
                    this.Benefit2TextBox = (global::Windows.UI.Xaml.Controls.TextBox)(target);
                    ((global::Windows.UI.Xaml.Controls.TextBox)this.Benefit2TextBox).TextChanging += this.BenefitTextBox_TextChanging;
                }
                break;
            case 18: // MainPage.xaml line 46
                {
                    this.Benefit1TitleBox = (global::Windows.UI.Xaml.Controls.TextBox)(target);
                    ((global::Windows.UI.Xaml.Controls.TextBox)this.Benefit1TitleBox).TextChanging += this.BenefitTextBox_TextChanging;
                }
                break;
            case 19: // MainPage.xaml line 47
                {
                    this.Benefit1ImageDisplay = (global::Windows.UI.Xaml.Controls.Image)(target);
                }
                break;
            case 20: // MainPage.xaml line 48
                {
                    this.Benefit1TextBox = (global::Windows.UI.Xaml.Controls.TextBox)(target);
                    ((global::Windows.UI.Xaml.Controls.TextBox)this.Benefit1TextBox).TextChanging += this.BenefitTextBox_TextChanging;
                }
                break;
            case 21: // MainPage.xaml line 24
                {
                    this.SaveButton = (global::Windows.UI.Xaml.Controls.Button)(target);
                    ((global::Windows.UI.Xaml.Controls.Button)this.SaveButton).Click += this.SaveToFile;
                }
                break;
            case 22: // MainPage.xaml line 25
                {
                    this.PublishButton = (global::Windows.UI.Xaml.Controls.Button)(target);
                    ((global::Windows.UI.Xaml.Controls.Button)this.PublishButton).Click += this.UploadToServer;
                }
                break;
            default:
                break;
            }
            this._contentLoaded = true;
        }

        /// <summary>
        /// GetBindingConnector(int connectionId, object target)
        /// </summary>
        [global::System.CodeDom.Compiler.GeneratedCodeAttribute("Microsoft.Windows.UI.Xaml.Build.Tasks"," 10.0.17.0")]
        [global::System.Diagnostics.DebuggerNonUserCodeAttribute()]
        public global::Windows.UI.Xaml.Markup.IComponentConnector GetBindingConnector(int connectionId, object target)
        {
            global::Windows.UI.Xaml.Markup.IComponentConnector returnValue = null;
            switch(connectionId)
            {
            case 1: // MainPage.xaml line 1
                {                    
                    global::Windows.UI.Xaml.Controls.Page element1 = (global::Windows.UI.Xaml.Controls.Page)target;
                    MainPage_obj1_Bindings bindings = new MainPage_obj1_Bindings();
                    returnValue = bindings;
                    bindings.SetDataRoot(this);
                    this.Bindings = bindings;
                    element1.Loading += bindings.Loading;
                    global::Windows.UI.Xaml.Markup.XamlBindingHelper.SetDataTemplateComponent(element1, bindings);
                }
                break;
            }
            return returnValue;
        }

        // Api Information for conditional namespace declarations
        internal static bool IsApiContractPresent_Windows_Foundation_UniversalApiContract_5 = global::Windows.Foundation.Metadata.ApiInformation.IsApiContractPresent("Windows.Foundation.UniversalApiContract", 5);
    }
}

