using Clinic.Clases;
using Clinic.Models;
using Clinic.Models.DocModels;
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
    public partial class ChooseHour : ContentPage
    {
        BaseUrl get = new BaseUrl();
        private string idpac;
        User model = new User();
        private string baseurl;
        private int IdEmp;
        public ChooseHour(int idemp)
        {
            InitializeComponent();
            fecha.MinimumDate = DateTime.Today.Date;
            baseurl = get.url;
            idpac = model.getName();
            IdEmp = idemp;
        }

        private async void GetHours()
        {
            try
            {
                var loadingDialog = await MaterialDialog.Instance.LoadingDialogAsync(message: "Buscando horarios disponibles");
                string url = baseurl + "/Api/horarios/readById.php?idDoc=" + IdEmp;

                HttpClient client = new HttpClient();
                HttpResponseMessage connect = await client.GetAsync(url);

                if (connect.StatusCode == HttpStatusCode.OK)
                {
                    var response = await client.GetStringAsync(url);
                    var info = JsonConvert.DeserializeObject<List<HorariosD>>(response);
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

        private async void mylist_ItemTapped(object sender, ItemTappedEventArgs e)
        {
            if (e != null)
            {
                var res = await MaterialDialog.Instance.ConfirmAsync("¿Esta seguro de usar este cupo? Recuerde ser puntual", "Aviso", "Aceptar", "Cancelar");
                if (res == true)
                {
                    var list = (ListView)sender;
                    var tapped = (list.SelectedItem as HorariosD);

                    try
                    {
                        MaterialControls control = new MaterialControls();
                        var loadingDialog = await MaterialDialog.Instance.LoadingDialogAsync(message: "Enviando solicitud");

                        Pending pacientes = new Pending();

                        pacientes.fecha = fecha.Date.ToString("yy/MM/dd"); 
                        pacientes.hora =tapped.hora_inicio;
                        pacientes.idpaciente = Convert.ToInt32(idpac);
                        pacientes.idempleado = IdEmp;
                        pacientes.tipo = 1;


                        HttpClient client = new HttpClient();

                        string controlador = "/Api/pending_quotes/create.php";
                        client.BaseAddress = new Uri(baseurl);

                        string json = JsonConvert.SerializeObject(pacientes);
                        var content = new StringContent(json, Encoding.UTF8, "application/json");

                        var response = await client.PostAsync(controlador, content);

                        if (response.IsSuccessStatusCode)
                        {
                            await loadingDialog.DismissAsync();
                            control.ShowAlert("Enviado!!", "Exito", "Ok");
                        }
                        else
                        {
                            await loadingDialog.DismissAsync();
                            control.ShowAlert("Ocurrio un error al registrar!!", "Error", "Ok");
                        }

                    }
                    catch (Exception ex)
                    {
                        await DisplayAlert("Ocurrio un error", "Error: " + ex, "Ok");
                    }
                }
            }
        }

        private async void fecha_DateSelected(object sender, DateChangedEventArgs e)
        {
            try
            {
                var loadingDialog = await MaterialDialog.Instance.LoadingDialogAsync(message: "Buscando horarios disponibles");
                string url = baseurl + "/Api/horarios/readByDate.php?date=" + fecha.Date.ToString("yy/MM/dd") + "&idDoc="+IdEmp;

                HttpClient client = new HttpClient();
                HttpResponseMessage connect = await client.GetAsync(url);

                if (connect.StatusCode == HttpStatusCode.OK)
                {
                    var response = await client.GetStringAsync(url);
                    var info = JsonConvert.DeserializeObject<List<HorariosD>>(response);
                    mylist.ItemsSource = info;
                    texthoras.IsVisible = true;
                    await loadingDialog.DismissAsync();
                }
                else
                {
                    await loadingDialog.DismissAsync();
                    await DisplayAlert("Error", "No se encontraron horarios disponibles", "Ok");
                    texthoras.IsVisible = false;
                    //mylist.IsVisible = false;
                }
            }
            catch (Exception)
            {

                throw;
            }
        }

        private void button_Clicked(object sender, EventArgs e)
        {
            Navigation.PushAsync(new CustomQuote(IdEmp));
        }
    }
}