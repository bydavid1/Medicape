using Clinic.Clases;
using Clinic.Models;
using Clinic.Validaciones;
using Newtonsoft.Json;
using System;
using System.Collections.Generic;
using System.Linq;
using System.Net.Http;
using System.Text;
using System.Threading.Tasks;

using Xamarin.Forms;
using Xamarin.Forms.Xaml;
using XF.Material.Forms.UI.Dialogs;
using XF.Material.Forms.UI.Dialogs.Configurations;

namespace Clinic.Views
{
	[XamlCompilation(XamlCompilationOptions.Compile)]
	public partial class AddEmployee : ContentPage
	{
        MaterialControls control = new MaterialControls();
        Connection get = new Connection();
        private string baseurl;
        public AddEmployee ()
		{
			InitializeComponent ();
            baseurl = get.BaseUrl;
            e_especialidad.Items.Add("Medico General");
            e_especialidad.Items.Add("Odontologo");
            e_especialidad.Items.Add("Ginecologo");
            e_especialidad.Items.Add("Cirujano");

            e_estado.Items.Add("Casado");
            e_estado.Items.Add("Soltero");
            e_estado.Items.Add("Viudo");
            e_estado.Items.Add("Divorciado");

            e_sexo.Items.Add("Masculino");
            e_sexo.Items.Add("Femenino");

            e_solvencia.Items.Add("Entregado");
            e_solvencia.Items.Add("Pendiente");

            e_antecedentes.Items.Add("Entregado");
            e_antecedentes.Items.Add("Pendiente");

            e_certificado.Items.Add("Entregado");
            e_certificado.Items.Add("Pendiente");

            e_constancia.Items.Add("Entregado");
            e_constancia.Items.Add("Pendiente");

            e_nac.MaximumDate = DateTime.Today;

        }

        private async void Button_Clicked(object sender, EventArgs e)
        {
            if (String.IsNullOrWhiteSpace(e_nombre.Text) &&
             String.IsNullOrWhiteSpace(e_apellido.Text) &&
             String.IsNullOrWhiteSpace(Convert.ToString(e_sexo.SelectedItem)) &&
             String.IsNullOrWhiteSpace(Convert.ToString(e_estado.SelectedItem)) &&
             String.IsNullOrWhiteSpace(e_correo.Text) &&
             String.IsNullOrWhiteSpace(e_departamento.Text) &&
             String.IsNullOrWhiteSpace(e_dir.Text) &&
             String.IsNullOrWhiteSpace(e_telefono.Text) &&
             String.IsNullOrWhiteSpace(e_dui.Text) &&
             String.IsNullOrWhiteSpace(e_nit.Text) &&
             String.IsNullOrWhiteSpace(e_municipio.Text) &&
             String.IsNullOrWhiteSpace(e_celular.Text) &&
             String.IsNullOrWhiteSpace(Convert.ToString(e_solvencia.SelectedItem)) &&
             String.IsNullOrWhiteSpace(Convert.ToString(e_antecedentes.SelectedItem)) &&
             String.IsNullOrWhiteSpace(Convert.ToString(e_certificado.SelectedItem)) &&
             String.IsNullOrWhiteSpace(Convert.ToString(e_constancia.SelectedItem))
             )
            {
                var alertDialogConfiguration = new MaterialAlertDialogConfiguration
                {
                    BackgroundColor = Color.FromHex("#c62828"),
                    TitleTextColor = Color.White,
                    MessageTextColor = Color.FromHex("#DEFFFFFF"),
                    TintColor = Color.White,
                    CornerRadius = 8,
                    ScrimColor = Color.FromHex("#232F34").MultiplyAlpha(0.32),
                    ButtonAllCaps = false
                };

                await MaterialDialog.Instance.AlertAsync(message: "Llene todos los campos",
                                                            title: "Alerta",
                                                            acknowledgementText: "Ok",
                                                            configuration: alertDialogConfiguration);
            }

            else if (String.IsNullOrWhiteSpace(e_nombre.Text))
            {
                MaterialControls control = new MaterialControls();
                control.ShowAlert("Campo Nombre es Obligatorio!!", "Error", "Ok");


            }
            else if (String.IsNullOrWhiteSpace(e_apellido.Text))
            {
                MaterialControls control = new MaterialControls();
                control.ShowAlert("Campo Apellido es Obligatorio!!", "Error", "Ok");
            }
            else if (String.IsNullOrWhiteSpace(Convert.ToString(e_solvencia.SelectedItem)))
            {
                MaterialControls control = new MaterialControls();
                control.ShowAlert("Campo Solvencia es Obligatorio!!", "Error", "Ok");
            }
            else if (String.IsNullOrWhiteSpace(Convert.ToString(e_antecedentes.SelectedItem)))
            {
                MaterialControls control = new MaterialControls();
                control.ShowAlert("Campo antecedentes es Obligatorio!!", "Error", "Ok");
            }
            else if (String.IsNullOrWhiteSpace(Convert.ToString(e_certificado.SelectedItem)))
            {
                MaterialControls control = new MaterialControls();
                control.ShowAlert("Campo certificado es Obligatorio!!", "Error", "Ok");
            }
            else if (String.IsNullOrWhiteSpace(Convert.ToString(e_constancia.SelectedItem)))
            {
                MaterialControls control = new MaterialControls();
                control.ShowAlert("Campo Solvencia es Obligatorio!!", "Error", "Ok");
            }
            else if (String.IsNullOrWhiteSpace(Convert.ToString(e_sexo.SelectedItem)))
            {
                control.ShowAlert("Seleccione un sexo", "Error", "Ok");
            }
            else if (String.IsNullOrWhiteSpace(Convert.ToString(e_estado.SelectedItem)))
            {
                control.ShowAlert("Seleccione un estado", "Error", "Ok");
            }
            else if (String.IsNullOrWhiteSpace(e_dui.Text))
            {
                control.ShowAlert("Campo DUI es Obligatorio!!", "Error", "Ok");
            }
            else if (String.IsNullOrWhiteSpace(e_nit.Text))
            {
                control.ShowAlert("Campo DUI es Obligatorio!!", "Error", "Ok");
            }
            else if (String.IsNullOrWhiteSpace(e_telefono.Text))
            {
                control.ShowAlert("Campo telefono es Obligatorio!!", "Error", "Ok");
            }
            else if (String.IsNullOrWhiteSpace(e_correo.Text))
            {
                control.ShowAlert("Campo correo es Obligatorio!!", "Error", "Ok");
            }
            else if (String.IsNullOrWhiteSpace(e_celular.Text))
            {
                control.ShowAlert("Campo celular es Obligatorio!!", "Error", "Ok");
            }
            else if (String.IsNullOrWhiteSpace(e_departamento.Text))
            {
                control.ShowAlert("Campo departamento es Obligatorio!!", "Error", "Ok");
            }
            else if (String.IsNullOrWhiteSpace(e_municipio.Text))
            {
                control.ShowAlert("Campo municipio es Obligatorio!!", "Error", "Ok");
            }
            else if (String.IsNullOrWhiteSpace(e_dir.Text))
            {
                control.ShowAlert("Campo direccion es Obligatorio!!", "Error", "Ok");
            }
            else if (TextValidator.Ok == false || ValidateEmail.Ok == false || NumeroValidator.Ok == false)
            {
                control.ShowAlert("Al parecer hay algunos errores", "Error", "Ok");
            }
            else
            {

                try
                {
                MaterialControls control = new MaterialControls();
                control.ShowLoading("Registrando");
                string date = DateTime.Today.ToString("yy/MM/dd");
                string fecha = e_nac.Date.ToString("yy/MM/dd");
                Empleados empleados = new Empleados
                {
                    nombres = e_nombre.Text,
                    apellidos = e_apellido.Text,
                    fecha_Nac = fecha,
                    sexo = Convert.ToString(e_sexo.SelectedItem),
                    estado_Civil = Convert.ToString(e_estado.SelectedItem),
                    especialidad = Convert.ToString(e_especialidad.SelectedItem),
                    dui = e_dui.Text,
                    telefono = e_telefono.Text,
                    email = e_correo.Text,
                    departamento = e_departamento.Text,
                    celular = e_celular.Text,
                    municipio = e_municipio.Text,
                    direccion = e_dir.Text,
                    nit = e_nit.Text,
                    antecedentes = Convert.ToString(e_antecedentes.SelectedItem),
                    solvencia = Convert.ToString(e_solvencia.SelectedItem),
                    constancia_Titulo = Convert.ToString(e_constancia.SelectedItem),
                    certificado_Salud = Convert.ToString(e_certificado.SelectedItem),
                    fecha_Contratacion = date

                };



                HttpClient client = new HttpClient();
                string controlador = "/Api/empleado/create.php";
                client.BaseAddress = new Uri(baseurl);

                string json = JsonConvert.SerializeObject(empleados);
                var content = new StringContent(json, Encoding.UTF8, "application/json");

                var response = await client.PostAsync(controlador, content);

                if (response.IsSuccessStatusCode)
                {
                    control.ShowAlert("Registrado!!", "Exito", "Ok");
                }
                else
                {
                    control.ShowAlert("Ocurrio un error al registrar!!", "Error", "Ok");
                }
            }
            catch (Exception ex)
            {
             await DisplayAlert("Ocurrio un error " + ex, "Error", "Ok");
            }
            }
        }
    }
}