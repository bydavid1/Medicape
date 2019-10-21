using Clinic.Behavior;
using System;
using Xamarin.Forms;
using Xamarin.Forms.PlatformConfiguration.AndroidSpecific;
using Xamarin.Forms.Xaml;

namespace Medicape
{
    public partial class App : Xamarin.Forms.Application, ILoginManager
    {
        public new static App Current;
        public static int val;
        public App()
        {
            XF.Material.Forms.Material.Init(this);
            Xamarin.Forms.Application.Current.On<Xamarin.Forms.PlatformConfiguration.Android>().UseWindowSoftInputModeAdjust(WindowSoftInputModeAdjust.Resize);
            InitializeComponent();
            ; Current = this;
            var isLoggedIn = Properties.ContainsKey("IsLoggedIn") ? (bool)Properties["IsLoggedIn"] : false;


            if (!isLoggedIn)
            {
                MainPage = new Views.Login(this);
            }
            else
            {
                MainPage = new NavigationPage(new Views.HomePaciente());
            }
        }

        public void ShowMainPage()
        {
            MainPage = new NavigationPage(new Views.HomePaciente());
        }

        public void Logout()
        {
            Properties["IsLoggedIn"] = false;
            MainPage = new Views.Login(this);
        }

        protected override void OnStart()
        {
            // Handle when your app starts
        }

        protected override void OnSleep()
        {
            // Handle when your app sleeps
        }

        protected override void OnResume()
        {
            // Handle when your app resumes
        }


    }
}
