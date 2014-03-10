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
    public class Authenticate : ActionFilterAttribute
    {
        public ContextModel currentUser { get; set; }


        public override void OnActionExecuting(HttpActionContext actionContext)
        {
            
            string context = "";
                if (actionContext.Request.Headers.Contains("Authorization"))
                {
                    context =actionContext.Request.Headers.GetValues("Authorization").FirstOrDefault();
                }

                if (context == string.Empty)
                    actionContext.Response = actionContext.Request.CreateErrorResponse(HttpStatusCode.BadRequest, "The Authorization Header it not present");
                else
                {

                    string[] parameter = context.Split(' ');
                    if (parameter[0] != "Token" || parameter.Length < 2)
                        actionContext.Response = actionContext.Request.CreateErrorResponse(HttpStatusCode.BadRequest, "Bad authorization header");
                    else
                    {
                        TokenRepository repository = new TokenRepository();
                        currentUser = repository.getSubscriberByToken(parameter[1]);                        
                        if (currentUser == null)
                            actionContext.Response = actionContext.Request.CreateErrorResponse(HttpStatusCode.BadRequest, "incorrect token");
                    }

                }
                base.OnActionExecuting(actionContext);
        }
        
    }
}