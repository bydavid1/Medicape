using Clinic.Models;
using System.Collections.ObjectModel;

namespace Clinic.ViewModels
{
   public class CitasViewModel
    {
        public ObservableCollection<Citas> Citas { get; set; }

        public CitasViewModel()
        {

        }
    }
}
