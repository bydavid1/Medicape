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
    public partial class QuotesHistory : ContentPage
    {
        private string id;
        User model = new User();
        public QuotesHistory()
        {
            InitializeComponent();
            id = model.getName();
            getQuotes(id);
        }

        private async void getQuotes(string id)
        {
            try
            {
                BaseUrl get = new BaseUrl();
                string url = get.url;
                string send = url + "/Api/citas/read_by_id.php?idpaciente=" + id;
                HttpClient client = new HttpClient();
                HttpResponseMessage connect = await client.GetAsync(send);

                if (connect.StatusCode == HttpStatusCode.OK)
                {
                    var response = await client.GetStringAsync(send);
                    var paciente = JsonConvert.DeserializeObject<List<Citas>>(response);
                    mylist.ItemsSource = paciente;
                }
                else
                {
                    MaterialControls control = new MaterialControls();
                    control.ShowSnackBar("No hay citas registradas");
                    message.IsVisible = true;
                }
            }
            catch (Exception ex)
            {

              await  DisplayAlert("Error", "Error: " + ex, "Ok");
            }
        }
    }
}