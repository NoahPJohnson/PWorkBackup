﻿#pragma checksum "C:\Users\Noah\source\repos\TestSurveyApp\TestSurveyApp\SurveyPages\SurveyPage5.xaml" "{406ea660-64cf-4c82-b6f0-42d48172a799}" "173B7556535E17D7A3F9D9EC9F0225FE"
//------------------------------------------------------------------------------
// <auto-generated>
//     This code was generated by a tool.
//
//     Changes to this file may cause incorrect behavior and will be lost if
//     the code is regenerated.
// </auto-generated>
//------------------------------------------------------------------------------

namespace TestSurveyApp.SurveyPages
{
    partial class SurveyPage5 : 
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
        };

        [global::System.CodeDom.Compiler.GeneratedCodeAttribute("Microsoft.Windows.UI.Xaml.Build.Tasks"," 10.0.17.0")]
        [global::System.Diagnostics.DebuggerNonUserCodeAttribute()]
        private class SurveyPage5_obj1_Bindings :
            global::Windows.UI.Xaml.Markup.IDataTemplateComponent,
            global::Windows.UI.Xaml.Markup.IXamlBindScopeDiagnostics,
            global::Windows.UI.Xaml.Markup.IComponentConnector,
            ISurveyPage5_Bindings
        {
            private global::TestSurveyApp.SurveyPages.SurveyPage5 dataRoot;
            private bool initialized = false;
            private const int NOT_PHASED = (1 << 31);
            private const int DATA_CHANGED = (1 << 30);

            // Fields for each control that has bindings.
            private global::Windows.UI.Xaml.Controls.TextBox obj7;
            private global::Windows.UI.Xaml.Controls.TextBox obj9;
            private global::Windows.UI.Xaml.Controls.TextBox obj10;
            private global::Windows.UI.Xaml.Controls.TextBox obj12;
            private global::Windows.UI.Xaml.Controls.TextBox obj13;
            private global::Windows.UI.Xaml.Controls.TextBox obj15;
            private global::Windows.UI.Xaml.Controls.TextBox obj16;
            private global::Windows.UI.Xaml.Controls.TextBox obj18;

            // Static fields for each binding's enabled/disabled state
            private static bool isobj7TextDisabled = false;
            private static bool isobj9TextDisabled = false;
            private static bool isobj10TextDisabled = false;
            private static bool isobj12TextDisabled = false;
            private static bool isobj13TextDisabled = false;
            private static bool isobj15TextDisabled = false;
            private static bool isobj16TextDisabled = false;
            private static bool isobj18TextDisabled = false;

            public SurveyPage5_obj1_Bindings()
            {
            }

            public void Disable(int lineNumber, int columnNumber)
            {
                if (lineNumber == 74 && columnNumber == 122)
                {
                    isobj7TextDisabled = true;
                }
                else if (lineNumber == 76 && columnNumber == 115)
                {
                    isobj9TextDisabled = true;
                }
                else if (lineNumber == 59 && columnNumber == 122)
                {
                    isobj10TextDisabled = true;
                }
                else if (lineNumber == 61 && columnNumber == 115)
                {
                    isobj12TextDisabled = true;
                }
                else if (lineNumber == 44 && columnNumber == 122)
                {
                    isobj13TextDisabled = true;
                }
                else if (lineNumber == 46 && columnNumber == 115)
                {
                    isobj15TextDisabled = true;
                }
                else if (lineNumber == 29 && columnNumber == 122)
                {
                    isobj16TextDisabled = true;
                }
                else if (lineNumber == 31 && columnNumber == 115)
                {
                    isobj18TextDisabled = true;
                }
            }

            // IComponentConnector

            public void Connect(int connectionId, global::System.Object target)
            {
                switch(connectionId)
                {
                    case 7: // SurveyPages\SurveyPage5.xaml line 74
                        this.obj7 = (global::Windows.UI.Xaml.Controls.TextBox)target;
                        break;
                    case 9: // SurveyPages\SurveyPage5.xaml line 76
                        this.obj9 = (global::Windows.UI.Xaml.Controls.TextBox)target;
                        break;
                    case 10: // SurveyPages\SurveyPage5.xaml line 59
                        this.obj10 = (global::Windows.UI.Xaml.Controls.TextBox)target;
                        break;
                    case 12: // SurveyPages\SurveyPage5.xaml line 61
                        this.obj12 = (global::Windows.UI.Xaml.Controls.TextBox)target;
                        break;
                    case 13: // SurveyPages\SurveyPage5.xaml line 44
                        this.obj13 = (global::Windows.UI.Xaml.Controls.TextBox)target;
                        break;
                    case 15: // SurveyPages\SurveyPage5.xaml line 46
                        this.obj15 = (global::Windows.UI.Xaml.Controls.TextBox)target;
                        break;
                    case 16: // SurveyPages\SurveyPage5.xaml line 29
                        this.obj16 = (global::Windows.UI.Xaml.Controls.TextBox)target;
                        break;
                    case 18: // SurveyPages\SurveyPage5.xaml line 31
                        this.obj18 = (global::Windows.UI.Xaml.Controls.TextBox)target;
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

            // ISurveyPage5_Bindings

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
                    this.dataRoot = (global::TestSurveyApp.SurveyPages.SurveyPage5)newDataRoot;
                    return true;
                }
                return false;
            }

            public void Loading(global::Windows.UI.Xaml.FrameworkElement src, object data)
            {
                this.Initialize();
            }

            // Update methods for each path node used in binding steps.
            private void Update_(global::TestSurveyApp.SurveyPages.SurveyPage5 obj, int phase)
            {
                if (obj != null)
                {
                    if ((phase & (NOT_PHASED | (1 << 0))) != 0)
                    {
                        this.Update_surveyPage(obj.surveyPage, phase);
                    }
                }
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
                        this.Update_surveyPage_CurrentBenefitCollection_I3_BenefitText(obj.BenefitText, phase);
                    }
                }
            }
            private void Update_surveyPage_CurrentBenefitCollection_I3_BenefitLabel(global::System.String obj, int phase)
            {
                if ((phase & ((1 << 0) | NOT_PHASED )) != 0)
                {
                    // SurveyPages\SurveyPage5.xaml line 74
                    if (!isobj7TextDisabled)
                    {
                        XamlBindingSetters.Set_Windows_UI_Xaml_Controls_TextBox_Text(this.obj7, obj, null);
                    }
                }
            }
            private void Update_surveyPage_CurrentBenefitCollection_I3_BenefitText(global::System.String obj, int phase)
            {
                if ((phase & ((1 << 0) | NOT_PHASED )) != 0)
                {
                    // SurveyPages\SurveyPage5.xaml line 76
                    if (!isobj9TextDisabled)
                    {
                        XamlBindingSetters.Set_Windows_UI_Xaml_Controls_TextBox_Text(this.obj9, obj, null);
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
                        this.Update_surveyPage_CurrentBenefitCollection_I2_BenefitText(obj.BenefitText, phase);
                    }
                }
            }
            private void Update_surveyPage_CurrentBenefitCollection_I2_BenefitLabel(global::System.String obj, int phase)
            {
                if ((phase & ((1 << 0) | NOT_PHASED )) != 0)
                {
                    // SurveyPages\SurveyPage5.xaml line 59
                    if (!isobj10TextDisabled)
                    {
                        XamlBindingSetters.Set_Windows_UI_Xaml_Controls_TextBox_Text(this.obj10, obj, null);
                    }
                }
            }
            private void Update_surveyPage_CurrentBenefitCollection_I2_BenefitText(global::System.String obj, int phase)
            {
                if ((phase & ((1 << 0) | NOT_PHASED )) != 0)
                {
                    // SurveyPages\SurveyPage5.xaml line 61
                    if (!isobj12TextDisabled)
                    {
                        XamlBindingSetters.Set_Windows_UI_Xaml_Controls_TextBox_Text(this.obj12, obj, null);
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
                        this.Update_surveyPage_CurrentBenefitCollection_I1_BenefitText(obj.BenefitText, phase);
                    }
                }
            }
            private void Update_surveyPage_CurrentBenefitCollection_I1_BenefitLabel(global::System.String obj, int phase)
            {
                if ((phase & ((1 << 0) | NOT_PHASED )) != 0)
                {
                    // SurveyPages\SurveyPage5.xaml line 44
                    if (!isobj13TextDisabled)
                    {
                        XamlBindingSetters.Set_Windows_UI_Xaml_Controls_TextBox_Text(this.obj13, obj, null);
                    }
                }
            }
            private void Update_surveyPage_CurrentBenefitCollection_I1_BenefitText(global::System.String obj, int phase)
            {
                if ((phase & ((1 << 0) | NOT_PHASED )) != 0)
                {
                    // SurveyPages\SurveyPage5.xaml line 46
                    if (!isobj15TextDisabled)
                    {
                        XamlBindingSetters.Set_Windows_UI_Xaml_Controls_TextBox_Text(this.obj15, obj, null);
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
                        this.Update_surveyPage_CurrentBenefitCollection_I0_BenefitText(obj.BenefitText, phase);
                    }
                }
            }
            private void Update_surveyPage_CurrentBenefitCollection_I0_BenefitLabel(global::System.String obj, int phase)
            {
                if ((phase & ((1 << 0) | NOT_PHASED )) != 0)
                {
                    // SurveyPages\SurveyPage5.xaml line 29
                    if (!isobj16TextDisabled)
                    {
                        XamlBindingSetters.Set_Windows_UI_Xaml_Controls_TextBox_Text(this.obj16, obj, null);
                    }
                }
            }
            private void Update_surveyPage_CurrentBenefitCollection_I0_BenefitText(global::System.String obj, int phase)
            {
                if ((phase & ((1 << 0) | NOT_PHASED )) != 0)
                {
                    // SurveyPages\SurveyPage5.xaml line 31
                    if (!isobj18TextDisabled)
                    {
                        XamlBindingSetters.Set_Windows_UI_Xaml_Controls_TextBox_Text(this.obj18, obj, null);
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
            case 2: // SurveyPages\SurveyPage5.xaml line 18
                {
                    this.BenefitsDisplay = (global::Windows.UI.Xaml.Controls.GridView)(target);
                }
                break;
            case 3: // SurveyPages\SurveyPage5.xaml line 19
                {
                    this.Benefit1 = (global::Windows.UI.Xaml.Controls.GridViewItem)(target);
                    ((global::Windows.UI.Xaml.Controls.GridViewItem)this.Benefit1).DragOver += this.Image_DragOver;
                    ((global::Windows.UI.Xaml.Controls.GridViewItem)this.Benefit1).Drop += this.Image_Drop;
                }
                break;
            case 4: // SurveyPages\SurveyPage5.xaml line 34
                {
                    this.Benefit2 = (global::Windows.UI.Xaml.Controls.GridViewItem)(target);
                    ((global::Windows.UI.Xaml.Controls.GridViewItem)this.Benefit2).DragOver += this.Image_DragOver;
                    ((global::Windows.UI.Xaml.Controls.GridViewItem)this.Benefit2).Drop += this.Image_Drop;
                }
                break;
            case 5: // SurveyPages\SurveyPage5.xaml line 49
                {
                    this.Benefit3 = (global::Windows.UI.Xaml.Controls.GridViewItem)(target);
                    ((global::Windows.UI.Xaml.Controls.GridViewItem)this.Benefit3).DragOver += this.Image_DragOver;
                    ((global::Windows.UI.Xaml.Controls.GridViewItem)this.Benefit3).Drop += this.Image_Drop;
                }
                break;
            case 6: // SurveyPages\SurveyPage5.xaml line 64
                {
                    this.Benefit4 = (global::Windows.UI.Xaml.Controls.GridViewItem)(target);
                    ((global::Windows.UI.Xaml.Controls.GridViewItem)this.Benefit4).DragOver += this.Image_DragOver;
                    ((global::Windows.UI.Xaml.Controls.GridViewItem)this.Benefit4).Drop += this.Image_Drop;
                }
                break;
            case 7: // SurveyPages\SurveyPage5.xaml line 74
                {
                    this.Benefit4TitleBox = (global::Windows.UI.Xaml.Controls.TextBox)(target);
                    ((global::Windows.UI.Xaml.Controls.TextBox)this.Benefit4TitleBox).TextChanging += this.BenefitTextBox_TextChanging;
                }
                break;
            case 8: // SurveyPages\SurveyPage5.xaml line 75
                {
                    this.Benefit4ImageDisplay = (global::Windows.UI.Xaml.Controls.Image)(target);
                }
                break;
            case 9: // SurveyPages\SurveyPage5.xaml line 76
                {
                    this.Benefit4TextBox = (global::Windows.UI.Xaml.Controls.TextBox)(target);
                    ((global::Windows.UI.Xaml.Controls.TextBox)this.Benefit4TextBox).TextChanging += this.BenefitTextBox_TextChanging;
                }
                break;
            case 10: // SurveyPages\SurveyPage5.xaml line 59
                {
                    this.Benefit3TitleBox = (global::Windows.UI.Xaml.Controls.TextBox)(target);
                    ((global::Windows.UI.Xaml.Controls.TextBox)this.Benefit3TitleBox).TextChanging += this.BenefitTextBox_TextChanging;
                }
                break;
            case 11: // SurveyPages\SurveyPage5.xaml line 60
                {
                    this.Benefit3ImageDisplay = (global::Windows.UI.Xaml.Controls.Image)(target);
                }
                break;
            case 12: // SurveyPages\SurveyPage5.xaml line 61
                {
                    this.Benefit3TextBox = (global::Windows.UI.Xaml.Controls.TextBox)(target);
                    ((global::Windows.UI.Xaml.Controls.TextBox)this.Benefit3TextBox).TextChanging += this.BenefitTextBox_TextChanging;
                }
                break;
            case 13: // SurveyPages\SurveyPage5.xaml line 44
                {
                    this.Benefit2TitleBox = (global::Windows.UI.Xaml.Controls.TextBox)(target);
                    ((global::Windows.UI.Xaml.Controls.TextBox)this.Benefit2TitleBox).TextChanging += this.BenefitTextBox_TextChanging;
                }
                break;
            case 14: // SurveyPages\SurveyPage5.xaml line 45
                {
                    this.Benefit2ImageDisplay = (global::Windows.UI.Xaml.Controls.Image)(target);
                }
                break;
            case 15: // SurveyPages\SurveyPage5.xaml line 46
                {
                    this.Benefit2TextBox = (global::Windows.UI.Xaml.Controls.TextBox)(target);
                    ((global::Windows.UI.Xaml.Controls.TextBox)this.Benefit2TextBox).TextChanging += this.BenefitTextBox_TextChanging;
                }
                break;
            case 16: // SurveyPages\SurveyPage5.xaml line 29
                {
                    this.Benefit1TitleBox = (global::Windows.UI.Xaml.Controls.TextBox)(target);
                    ((global::Windows.UI.Xaml.Controls.TextBox)this.Benefit1TitleBox).TextChanging += this.BenefitTextBox_TextChanging;
                }
                break;
            case 17: // SurveyPages\SurveyPage5.xaml line 30
                {
                    this.Benefit1ImageDisplay = (global::Windows.UI.Xaml.Controls.Image)(target);
                }
                break;
            case 18: // SurveyPages\SurveyPage5.xaml line 31
                {
                    this.Benefit1TextBox = (global::Windows.UI.Xaml.Controls.TextBox)(target);
                    ((global::Windows.UI.Xaml.Controls.TextBox)this.Benefit1TextBox).TextChanging += this.BenefitTextBox_TextChanging;
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
            case 1: // SurveyPages\SurveyPage5.xaml line 1
                {                    
                    global::Windows.UI.Xaml.Controls.Page element1 = (global::Windows.UI.Xaml.Controls.Page)target;
                    SurveyPage5_obj1_Bindings bindings = new SurveyPage5_obj1_Bindings();
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
    }
}

