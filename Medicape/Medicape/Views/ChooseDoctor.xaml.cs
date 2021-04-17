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
using XF.Material.Forms.UI.Dialogs;

namespace Medicape.Views
{
    [XamlCompilation(XamlCompilationOptions.Compile)]
    public partial class ChooseDoctor : ContentPage
    {
        BaseUrl get = new BaseUrl();
        private string baseurl;
        private int IdEsp;
        public ChooseDoctor(int id)
        {
            InitializeComponent();
            baseurl = get.url;
            IdEsp = id;
            getDoctors();
        }

        private async void getDoctors()
        {
            try
            {
                var loadingDialog = await MaterialDialog.Instance.LoadingDialogAsync(message: "Buscando doctores");
                string url = baseurl + "/Api/empleado/getDoctors.php?idespecialidad=" + IdEsp;

                HttpClient client = new HttpClient();
                HttpResponseMessage connect = await client.GetAsync(url);

                if (connect.StatusCode == HttpStatusCode.OK)
                {
                    var response = await client.GetStringAsync(url);
                    var info = JsonConvert.DeserializeObject<List<Empleados>>(response);
                    mylist.ItemsSource = info;
                    await loadingDialog.DismissAsync();
                }
                else
                {
                    await loadingDialog.DismissAsync();
                    await  DisplayAlert("Error", "No se encontraron doctores", "Ok");
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

                Navigation.PushAsync(new ChooseHour(tapped.idempleado));
            }
        }

        private void ImageButton_Clicked(object sender, EventArgs e)
        {

        }
    }
}