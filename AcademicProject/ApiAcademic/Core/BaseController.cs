#region Ensamblado System.Web.Http.dll, v4.0.0.0
// C:\Users\Edrei\Documents\GitHub\Academic\AcademicProject\packages\Microsoft.AspNet.WebApi.Core.4.0.20710.0\lib\net40\System.Web.Http.dll
#endregion

using System;
using System.Collections.Generic;
using System.Net.Http;
using System.Security.Principal;
using System.Threading;
using System.Threading.Tasks;
using System.Web.Http.Controllers;
using System.Web.Http.ModelBinding;
using System.Web.Http.Routing;
using AcademicProject;
using ApiAcademic.Core;

namespace System.Web.Http
{
    // Resumen:
    //     Defines properties and methods for API controller.
    public abstract class BaseController : ApiController, IContextAware
    {
        public IApplicationContext Context { get; private set; }
        public BaseController()
        {
            Context = new AuthenticatedContext { Unrestricted = false };
        }
    }


}
