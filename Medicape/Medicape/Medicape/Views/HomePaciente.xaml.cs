using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

using Xamarin.Forms;
using Xamarin.Forms.Xaml;

namespace Medicape.Views
{
    [XamlCompilation(XamlCompilationOptions.Compile)]
    public partial class HomePaciente : ContentPage
    {
        public HomePaciente()
        {
            InitializeComponent();
        }

        
        private void MaterialCard_Clicked(object sender, EventArgs e)
        {
            Navigation.PushAsync(new QuotesHistory());
        }

        private void MaterialCard_Clicked_1(object sender, EventArgs e)
        {
            Navigation.PushAsync(new Consults());
        }

        private void MaterialCard_Clicked_2(object sender, EventArgs e)
        {
            Navigation.PushAsync(new ChooseEspecialty());
        }
    }
}