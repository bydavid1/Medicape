using System;
using System.Collections.Generic;
using System.Net;
using System.Text;

namespace Clinic.ViewModels
{
   public class CheckUrlConnection
    {
        public bool TestConnection(string url)
        {
            try
            {
                HttpWebRequest iNetRequest = (HttpWebRequest)WebRequest.Create(url);

                iNetRequest.Timeout = 5000;

                WebResponse iNetResponse = iNetRequest.GetResponse();

                return true;
            }
            catch (WebException)
            {
                return false;
            }
        }
    }
}
