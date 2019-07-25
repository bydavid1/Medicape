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
	public partial class Profile : ContentPage
	{
        private string id;
        User model = new User();
        MaterialControls control = new MaterialControls();
        public Profile ()
		{
            InitializeComponent ();
            id = model.getName();

            BaseUrl get = new BaseUrl();
            string url = get.url;
            string server = url + "/Api";
            CheckUrlConnection test = new CheckUrlConnection();
            bool result = test.TestConnection(server);

            if (result != true)
            {
                control.ShowAlert("No se pudo conectar con el servidor", "Error", "Ok");
            }
            else
            {
                getVitals(id);
                getPersonalInfo(id);
            }

        }

        private async void getPersonalInfo(string id)
        {
            BaseUrl get = new BaseUrl();
            string url = get.url;
            string send = url + "/Api/paciente/read_one.php?idpaciente=" + id;
            HttpClient client = new HttpClient();
            HttpResponseMessage connect = await client.GetAsync(send);

            if (connect.StatusCode == HttpStatusCode.OK)
            {
                var response = await client.GetStringAsync(send);
                var paciente = JsonConvert.DeserializeObject<Pacientes>(response);
                p_name.Text = (paciente.nombres + " " + paciente.apellidos);
                p_fecha.Text = paciente.fecha_Nac;
                p_sexo.Text = paciente.sexo;
            }
            else
            {
                control.ShowSnackBar("Ocurrio un error");
            }
        }

        private async void getVitals(string id)
        {
            BaseUrl get = new BaseUrl();
            string url = get.url;
            string send = url + "/Api/perfil_paciente/read_one.php?idpaciente=" + id;
            HttpClient client = new HttpClient();
            HttpResponseMessage connect = await client.GetAsync(send);

            if (connect.StatusCode == HttpStatusCode.OK)
            {
                var response = await client.GetStringAsync(send);
                var perfil = JsonConvert.DeserializeObject<VitalSigns>(response);
                alt.Text = Convert.ToString(perfil.altura);
                peso.Text = Convert.ToString(perfil.peso);
                temp.Text = Convert.ToString(perfil.temperatura);
                presion.Text = Convert.ToString(perfil.presion);
                frec.Text = Convert.ToString(perfil.frec_Cardiaca);
            }
            else
            {
                MaterialControls control = new MaterialControls();
                control.ShowSnackBar("Hay datos incompletos");
            }
        }
    }
}