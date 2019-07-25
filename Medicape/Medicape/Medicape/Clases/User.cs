using System;
using System.Collections.Generic;
using System.Text;
using Xamarin.Forms;

namespace Clinic.Clases
{
    public class User
    {
        public static string nombre = "";

        public User()
        {

            if (Application.Current.Properties.ContainsKey("name"))
            {
                var val = Application.Current.Properties["name"];
                nombre = val.ToString();
            }          
        }
        public string getName()
        {
            return nombre;
        }
    }
}
