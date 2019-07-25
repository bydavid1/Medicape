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
    public partial class ChooseDoctor : ContentPage
    {
        BaseUrl get = new BaseUrl();
        private string baseurl;
        public ChooseDoctor()
        {
            InitializeComponent();
            baseurl = get.url;
            getDoctors();
        }

        private async void getDoctors()
        {
            try
            {

                string url = baseurl + "/Api/empleado/searchDoc.php?query=";

                HttpClient client = new HttpClient();
                HttpResponseMessage connect = await client.GetAsync(url);

                if (connect.StatusCode == HttpStatusCode.OK)
                {
                    var response = await client.GetStringAsync(url);
                    var info = JsonConvert.DeserializeObject<List<Empleados>>(response);
                    mylist.ItemsSource = info;
                }
                else
                {
                 await  DisplayAlert("Error", "No se pudieron cargar los datos", "Ok");
                }
            }
            catch (Exception)
            {

                throw;
            }
        }

        private void Mylist_ItemTapped(object sender, ItemTappedEventArgs e)
        {
            if (e != null)
            {
                var list = (ListView)sender;
                var tapped = (list.SelectedItem as Empleados);

                Navigation.PushAsync(new scheduleQuote(tapped.idempleado));
            }
        }
    }
}