using Clinic.Clases;
using Medicape.Models;
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
    public partial class Requests : ContentPage
    {
        private string id;
        User model = new User();
        public Requests()
        {
            InitializeComponent();
            id = model.getName();
            getRequests(id);
        }

        private async void getRequests(string id)
        {
            try
            {
                BaseUrl get = new BaseUrl();
                string url = get.url;
                string send = url + "/Api/pending_quotes/custom_read.php?idpaciente=" + id;
                HttpClient client = new HttpClient();
                HttpResponseMessage connect = await client.GetAsync(send);

                if (connect.StatusCode == HttpStatusCode.OK)
                {
                    var response = await client.GetStringAsync(send);
                    var requests = JsonConvert.DeserializeObject<List<Pending>>(response);
                    mylist.ItemsSource = requests;
                }
                else
                {
                    MaterialControls control = new MaterialControls();
                    control.ShowSnackBar("No se encontraron solicitudes");
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