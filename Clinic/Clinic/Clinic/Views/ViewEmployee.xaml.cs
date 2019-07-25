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

namespace Clinic.Views
{
    [XamlCompilation(XamlCompilationOptions.Compile)]
    public partial class ViewEmployee : TabbedPage
    {
        private int ids;
        MaterialControls control = new MaterialControls();
        public ViewEmployee(int id)
        {
            InitializeComponent();
            ids = id;
            getPersonalInfo();
        }

        private async void getPersonalInfo()
        {
            BaseUrl get = new BaseUrl();
            string url = get.url;
            string send = url + "/Api/empleado/read_one.php?idempleado=" + ids;
            HttpClient client = new HttpClient();
            HttpResponseMessage connect = await client.GetAsync(send);

            if (connect.StatusCode == HttpStatusCode.OK)
            {
                var response = await client.GetStringAsync(send);
                var empleado = JsonConvert.DeserializeObject<Empleados>(response);
                _name.Text = (empleado.nombres +" "+ empleado.apellidos);
                _fecha.Text = empleado.fecha_Nac;
                _sexo.Text = empleado.sexo;
                _dui.Text = empleado.dui;
                _nit.Text = empleado.nit;
                _estado.Text = empleado.estado_Civil;
                _direccion.Text = empleado.direccion;
                _municipio.Text = empleado.municipio;
                _departamento.Text = empleado.departamento;
                _telefono.Text = empleado.telefono;
                _celular.Text = empleado.celular;
                _correo.Text = empleado.email;
                _especialidad.Text = empleado.especialidad;
                _antecedentes.Text = empleado.antecedentes;
                _solvencia.Text = empleado.solvencia;
                _titulado.Text = empleado.constancia_Titulo;
                _certificado.Text = empleado.certificado_Salud;
                _fecha_contratacion.Text = empleado.fecha_Contratacion;
                if (empleado.antecedentes != "Entregado" || empleado.solvencia != "Entregado" || empleado.constancia_Titulo != "Entregado" || empleado.certificado_Salud != "Entregado")
                {
                    content.IsVisible = true;
                }
            }
            else
            {

                control.ShowSnackBar("Ocurrio un error");
            }
        }

        private void ToolbarItem_Activated(object sender, EventArgs e)
        {
            Navigation.PushAsync(new UpdateEmployee(ids));
        }

        private void ToolbarItem_Activated_1(object sender, EventArgs e)
        {
            control.ShowLoading("Actualizando...");
            getPersonalInfo();
        }
    }
}