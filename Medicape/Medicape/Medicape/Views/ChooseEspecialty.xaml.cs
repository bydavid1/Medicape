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
    public partial class ChooseEspecialty : ContentPage
    {
        BaseUrl get = new BaseUrl();
        private string baseurl;
        public ChooseEspecialty()
        {
            InitializeComponent();
            baseurl = get.url;
            GetEspecialties();
        }

        private async void GetEspecialties()
        {
            try
            {
                var loadingDialog = await MaterialDialog.Instance.LoadingDialogAsync(message: "Buscando especialidades");
                string url = baseurl + "/Api/especialidades/getEspecialties.php";

                HttpClient client = new HttpClient();
                HttpResponseMessage connect = await client.GetAsync(url);

                if (connect.StatusCode == HttpStatusCode.OK)
                {
                    var response = await client.GetStringAsync(url);
                    var info = JsonConvert.DeserializeObject<List<Especialidades>>(response);
                    mylist.ItemsSource = info;
                    await loadingDialog.DismissAsync();
                }
                else
                {
                    await loadingDialog.DismissAsync();
                    await DisplayAlert("Error", "No se pudieron cargar los datos", "Ok");
                }
            }
            catch (Exception)
            {

                throw;
            }
        }

        private void ListView_ItemTapped(object sender, ItemTappedEventArgs e)
        {

            var list = (ListView)sender;
            var tapped = (list.SelectedItem as Especialidades);

            Navigation.PushAsync(new ChooseDoctor(tapped.idespecialidad));


        }
    }
}