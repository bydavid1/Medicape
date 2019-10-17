using Clinic.Clases;
using Clinic.ViewModels;
using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

using Xamarin.Forms;
using Xamarin.Forms.Xaml;

namespace Medicape.Views
{
	[XamlCompilation(XamlCompilationOptions.Compile)]
	public partial class Home : ContentPage
	{
        MaterialControls control = new MaterialControls();
        public Home ()
		{
			InitializeComponent ();
            BaseUrl get = new BaseUrl();
            string url = get.url;
            string server = url + "/Api";
            CheckUrlConnection test = new CheckUrlConnection();
            bool result = test.TestConnection(server);

            if (result != true)
            {
                control.ShowAlert("No se pudo conectar con el servidor", "Error", "Ok");
            }

        }

        void OnClick(object sender, EventArgs e)
        {
            ToolbarItem tbi = (ToolbarItem)sender;
            if (tbi.Text == "Cerrar Sesion")
            {
                control.ShowLoading("Cerrando sesion...");
                App.Current.Logout();
            }
            else if (tbi.Text == "Solicitudes")
            {
                Navigation.PushAsync(new Requests());
            }
            else if (tbi.Text == "Acerca de")
            {
                Navigation.PushModalAsync(new info());
            }
        }


        private void TapGestureRecognizer_Tapped(object sender, EventArgs e)
        {
            Navigation.PushAsync(new QuotesHistory());
        }

        private void TapGestureRecognizer_Tapped_1(object sender, EventArgs e)
        {
            DisplayAlert(":)","Proximamente", "ok");
        }

        private void TapGestureRecognizer_Tapped_2(object sender, EventArgs e)
        {
            Navigation.PushAsync(new Consults());
        }

        private void TapGestureRecognizer_Tapped_3(object sender, EventArgs e)
        {
            Navigation.PushAsync(new Tips());
        }

        private void Button_Clicked(object sender, EventArgs e)
        {
            Navigation.PushAsync(new ChooseDoctor());
        }
    }
}