using System;
using System.Collections.Generic;
using System.Linq;
using System.Net;
using System.Net.Http;
using System.Security.Principal;
using System.Threading.Tasks;
using System.Web;
using System.Web.Http;
using System.Web.Http.Controllers;
using System.Web.Http.Filters;
using AcademicProject;
using Data;

namespace ApiAcademic.Core
{
    public class AuthenticateAttribute : Attribute { }
    public class UnrestrictedRequestOnlyAttribute : Attribute { }
}