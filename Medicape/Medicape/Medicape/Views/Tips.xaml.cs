using Clinic.Clases;
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
    public partial class Tips : ContentPage
    {
        public Tips()
        {
            InitializeComponent();
            getTips();
        }

        private async void getTips()
        {
            try
            {
                BaseUrl get = new BaseUrl();
                string url = get.url;
                string send = url + "/Api/tips/read.php";
                HttpClient client = new HttpClient();
                HttpResponseMessage connect = await client.GetAsync(send);

                if (connect.StatusCode == HttpStatusCode.OK)
                {
                    var response = await client.GetStringAsync(send);
                    var tips = JsonConvert.DeserializeObject<List<Models.Tips>>(response);
                    mylist.ItemsSource = tips;
                }
                else
                {
                    MaterialControls control = new MaterialControls();
                    control.ShowSnackBar("No se pudieon encontrar tips");
                }
            }
            catch (Exception)
            {

                throw;
            }
        }
    }
}