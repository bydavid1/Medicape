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
    public partial class scheduleQuote : ContentPage
    {
        private string id;
        private int ids;
        User model = new User();
        BaseUrl get = new BaseUrl();
        private string baseurl;
        public scheduleQuote(int ide)
        {
            InitializeComponent();
            type.Items.Add("Consulta general");
            type.Items.Add("Ginecologia");
            type.Items.Add("Oftalmologia");
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


                string url3 = baseurl + "/Api/paciente/read_one.php?idpaciente=" + id;

                HttpClient client3 = new HttpClient();
                HttpResponseMessage connect3 = await client3.GetAsync(url3);

                if (connect3.StatusCode == HttpStatusCode.OK)
                {
                    var response3 = await client3.GetStringAsync(url3);
                    var emp = JsonConvert.DeserializeObject<Pacientes>(response3);
                    var nom = emp.nombres;
                    var apell = emp.apellidos;

                    string date = fech.Date.ToString("yy/MM/dd");
                    string hora = Convert.ToString(hour.Time);
                    Pending pacientes = new Pending
                    {
                        fecha = date,
                        hora = hora,
                        tipo = Convert.ToString(type.SelectedItem),
                        nombre = nom,
                        apellido = apell,
                        idpaciente = Convert.ToInt32(id),
                        idempleado = ids
                    };



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
                   
            }
            catch (Exception ex)
            {
                await DisplayAlert("Ocurrio un error" , "Error: " + ex, "Ok");
            }
        }
    }
}