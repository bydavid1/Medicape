using Plugin.Connectivity;
using System;
using System.Collections.Generic;
using System.Net;
using System.Text;

namespace Clinic.ViewModels
{
   public class CheckUrlConnection
    {
        public string BaseUrl = "http://192.168.42.236";

        public bool TestConnection()
        {
            if (CrossConnectivity.Current.IsConnected)
            {
                return true;
            }

            return false;
        }
    }
}
