using Clinic.Clases;
using Clinic.Models;
using Newtonsoft.Json;
using System;
using System.Net.Http;
using System.Text;
using Xamarin.Forms;
using Xamarin.Forms.Xaml;

namespace Medicape.Views
{
    [XamlCompilation(XamlCompilationOptions.Compile)]
    public partial class Register : ContentPage
    {
        private int ids;
        MaterialControls control = new MaterialControls();
        public Register(int id)
        {
            InitializeComponent();
            ids = id;
        }

        private async void Button_Clicked(object sender, EventArgs e)
        {
            try
            {
                control.ShowLoading("Registrando");


                Usuario citas = new Usuario
                {
                    user_Name = username.Text,
                    user_Password = pass.Text,
                    email = "user@email.com",
                    user_type = 2
                };



                HttpClient client = new HttpClient();
                BaseUrl get = new BaseUrl();
                string url = get.url;
                string controlador = "/Api/usuario/create_user.php";
                client.BaseAddress = new Uri(url);

                string json = JsonConvert.SerializeObject(citas);
                var content = new StringContent(json, Encoding.UTF8, "application/json");

                var response = await client.PostAsync(controlador, content);

                if (response.IsSuccessStatusCode)
                {
                    control.ShowAlert("Registrado", "Exito", "Ok");
                    username.Text = "";
                    pass.Text = "";
                    ids = 0;
                }
                else
                {
                    control.ShowAlert("Ocurrio un error al registrar", "Error", "Ok");
                }
            }
            catch (Exception ex)
            {
                await DisplayAlert("Ocurrio un error " + ex, "Error", "Ok");
            }
        }
    }
}