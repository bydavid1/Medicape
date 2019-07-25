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

namespace Medicape.Views
{
    [XamlCompilation(XamlCompilationOptions.Compile)]
    public partial class Consults : ContentPage
    {
        private string id;
        User model = new User();
        public Consults()
        {
            InitializeComponent();
            id = model.getName();
            getConsults(id);
        }

        private async void getConsults(string id)
        {
            try
            {
                BaseUrl get = new BaseUrl();
                string url = get.url;
                string send = url + "/Api/consultas/custom_read.php?idpaciente=" + id;
                HttpClient client = new HttpClient();
                HttpResponseMessage connect = await client.GetAsync(send);

                if (connect.StatusCode == HttpStatusCode.OK)
                {
                    var response = await client.GetStringAsync(send);
                    var consultas = JsonConvert.DeserializeObject<List<Consultas>>(response);
                    mylist.ItemsSource = consultas;
                }
                else
                {
                    MaterialControls control = new MaterialControls();
                    control.ShowSnackBar("No hay consultas registradas");
                    message.IsVisible = true;
                }
            }
            catch (Exception)
            {

                throw;
            }
        }
    }
}