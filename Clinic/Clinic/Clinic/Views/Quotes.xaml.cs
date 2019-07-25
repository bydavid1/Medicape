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

namespace Clinic.Views
{
	[XamlCompilation(XamlCompilationOptions.Compile)]
	public partial class Quotes : ContentPage
	{
        BaseUrl get = new BaseUrl();
        private string baseurl;
        User name = new User();
        public Quotes ()
		{
            MaterialControls control = new MaterialControls();
            control.ShowLoading("Obteniendo lista de citas");
            InitializeComponent ();
            baseurl = get.url;
            string server = baseurl+"/Api";
            CheckUrlConnection test = new CheckUrlConnection();
            bool result = test.TestConnection(server);

            if (result == true)
            {
                getQuotes();
            }
            else
            {
                control.ShowAlert("No se pudo conectar con el servidor", "Error", "Ok");
            }

            mylist.RefreshCommand = new Command(() =>
            {
                mylist.IsRefreshing = true;
                getQuotes();
                mylist.IsRefreshing = false;
            });
        }

        private async void getQuotes()
        {
            try
            {
                string username = name.getName();
                string url = baseurl + "/Api/usuario/read_id.php?username=" + username;

                HttpClient client = new HttpClient();
                HttpResponseMessage connect = await client.GetAsync(url);

                if (connect.StatusCode == HttpStatusCode.OK)
                {
                    var response = await client.GetStringAsync(url);
                    var info = JsonConvert.DeserializeObject<Usuario>(response);
                    var id = info.reference;

                    string url2 = baseurl + "/Api/citas/custom_read.php?idempleado=" + id;

                    HttpClient client2 = new HttpClient();
                    HttpResponseMessage connect2 = await client2.GetAsync(url2);

                    if (connect2.StatusCode == HttpStatusCode.OK)
                    {
                        var response2 = await client2.GetStringAsync(url2);
                        var citas = JsonConvert.DeserializeObject<List<Citas>>(response2);
                        mylist.ItemsSource = citas;
                    }
                    else
                    {
                        mylist.IsVisible = false;
                        message.IsVisible = true;
                    }
                }


            }
            catch (HttpRequestException e)
            {
                await DisplayAlert("error", "" + e, "Ok");
            }
        }

        private void Button_Clicked(object sender, EventArgs e)
        {
            Navigation.PushAsync(new SearchPatient("quotes", 0));
        }
    }
}