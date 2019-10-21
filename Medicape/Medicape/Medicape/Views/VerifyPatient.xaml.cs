using Clinic.Clases;
using Clinic.Models;
using Clinic.ViewModels;
using Newtonsoft.Json;
using System;
using System.Collections.Generic;
using System.Linq;
using System.Net;
using System.Net.Http;
using System.Text;
using System.Threading.Tasks;

using Xamarin.Forms;
using Xamarin.Forms.Xaml;

namespace Medicape.Views
{
    [XamlCompilation(XamlCompilationOptions.Compile)]
    public partial class VerifyPatient : ContentPage
    {
        public VerifyPatient()
        {
            InitializeComponent();
        }

        private async void Button_Clicked(object sender, EventArgs e)
        {
            MaterialControls control = new MaterialControls();
            control.ShowLoading("Verificando...");
            BaseUrl get = new BaseUrl();
            string baseurl = get.url;
            var id = dui.Text;


                CheckUrlConnection test = new CheckUrlConnection();
                bool inf = test.TestConnection();
                if (inf == true)
                {

;
                string url = baseurl + "/Api/paciente/verify.php?dui=" + id;

                HttpClient client = new HttpClient();
                HttpResponseMessage connect = await client.GetAsync(url);

                if (connect.StatusCode == HttpStatusCode.OK)
                {
                    var response = await client.GetStringAsync(url);
                    var lista = JsonConvert.DeserializeObject<Pacientes>(response);

                    var idpaciente = lista.idpaciente;
                   await  Navigation.PushAsync(new Register(idpaciente));
                }
                else
                {
                    control.ShowAlert("Lo sentimos usted no esta registrado", "Error", "ok");
                }
            }
                else
                {
                    control.ShowAlert("No se pudo conectar con el servidor", "Error", "Ok");
                }
        }
    }
}