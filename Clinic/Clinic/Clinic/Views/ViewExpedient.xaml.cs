using Clinic.Clases;
using Clinic.Models;
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

namespace Clinic.Views
{
    [XamlCompilation(XamlCompilationOptions.Compile)]
    public partial class ViewExpedient : ContentPage
    {
        public ViewExpedient(int id)
        {
            InitializeComponent();
            getExpedient(id);
        }

        private async void getExpedient(int id)
        {
            BaseUrl get = new BaseUrl();
            string url = get.url;
            string send = url + "/Api/item_expediente/read_one.php?idconsulta=" + id;
            HttpClient client = new HttpClient();
            HttpResponseMessage connect = await client.GetAsync(send);

            if (connect.StatusCode == HttpStatusCode.OK)
            {
                var response = await client.GetStringAsync(send);
                var consultas = JsonConvert.DeserializeObject<Expediente>(response);
                diagnostico.Text = consultas.diagnostico;
                tratamiento.Text = consultas.tratamiento;
                observaciones.Text = consultas.observaciones;
                receta.Text = consultas.receta;
                examen.Text = consultas.descripcion_Exam;
            }
            else
            {
                MaterialControls control = new MaterialControls();
                control.ShowSnackBar("Ocurrio un error al obtener el expediente");
            }
        }
    }
}