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
    public partial class Invoices : ContentPage
    {
        private string id;
        User model = new User();
        public Invoices()
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
                string send = url + "/Api/factura/read_by_id.php?idpaciente=" + id;
                HttpClient client = new HttpClient();
                HttpResponseMessage connect = await client.GetAsync(send);

                if (connect.StatusCode == HttpStatusCode.OK)
                {
                    var response = await client.GetStringAsync(send);
                    var factura = JsonConvert.DeserializeObject<List<Factura>>(response);
                    mylist.ItemsSource = factura;
                }
                else
                {
                    MaterialControls control = new MaterialControls();
                    control.ShowSnackBar("No hay facturas registradas");
                    message.IsVisible = true;
                }
            }
            catch (Exception ex)
            {
              await  DisplayAlert("Error", "Error: " + ex, "Ok");
                
            }
        }

        private void Mylist_ItemTapped(object sender, ItemTappedEventArgs e)
        {
            if (e != null)
            {
                var list = (ListView)sender;
                var selection = list.SelectedItem as Factura;

                Navigation.PushModalAsync(new ViewInvoice(selection.idfactura, selection.fecha, selection.hora, selection.nombre, selection.total));
            }
        }
    }
}