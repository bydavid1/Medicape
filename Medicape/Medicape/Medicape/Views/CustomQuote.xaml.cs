using Clinic.Clases;
using Clinic.Models;
using Newtonsoft.Json;
using System;
using System.Net;
using System.Net.Http;
using System.Text;
using Xamarin.Forms;
using Xamarin.Forms.Xaml;

namespace Medicape.Views
{
    [XamlCompilation(XamlCompilationOptions.Compile)]
    public partial class CustomQuote : ContentPage
    {
        private string id;
        private int ids;
        User model = new User();
        BaseUrl get = new BaseUrl();
        private string baseurl;
        public CustomQuote(int ide)
        {
            InitializeComponent();
            hour.Format = "HH:mm";
            fech.MinimumDate = DateTime.Today;
            id = model.getName();
            baseurl = get.url;
            ids = ide;
        }

        private async void Button_Clicked(object sender, EventArgs e)
        {
            try
            {
                MaterialControls control = new MaterialControls();

                control.ShowLoading("Registrando");
                string date = fech.Date.ToString("yy/MM/dd");
                string hora = Convert.ToString(hour.Time);
                Pending pacientes = new Pending();

                pacientes.fecha = date;
                pacientes.hora = hora;
                pacientes.idpaciente = Convert.ToInt32(id);
                pacientes.idempleado = ids;
                pacientes.tipo = 2;

                HttpClient client = new HttpClient();

                string controlador = "/Api/pending_quotes/create.php";
                client.BaseAddress = new Uri(baseurl);

                string json = JsonConvert.SerializeObject(pacientes);
                var content = new StringContent(json, Encoding.UTF8, "application/json");

                var response = await client.PostAsync(controlador, content);

                if (response.IsSuccessStatusCode)
                {
                    control.ShowAlert("Enviado!!", "Exito", "Ok");
                }
                else
                {
                    control.ShowAlert("Ocurrio un error al registrar!!", "Error", "Ok");
                }

            }
            catch (Exception ex)
            {
                await DisplayAlert("Ocurrio un error", "Error: " + ex, "Ok");
            }
        }
    }
}