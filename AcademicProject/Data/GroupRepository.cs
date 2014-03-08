using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using AcademicProject;
using System.Configuration;

namespace Data
{
    public class GroupRepository
    {
         private string sqlConnection;
         public GroupRepository()
         {
            sqlConnection = ConfigurationManager.ConnectionStrings["AcademicConnection"].ConnectionString;
         }
         public IEnumerable<GroupAnswers> getGroupAnswers()
         {

         }

    }
}
