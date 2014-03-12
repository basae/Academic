using Data;
using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using System.Web.Mvc;

namespace ApiAcademic.Core
{
    public class TokenAuthorizationFilter:IActionFilter
    {
        public void OnActionExecuting(ActionExecutingContext filterContext)
        {
            if(!ShouldAuthenticate(filterContext))return;
            var controller=filterContext.Controller as IContextAware;
            if (controller == null)
            {
                throw new Exception("Filter could not get a valid controller");
            }
            var usr = AuthenticateRequest(filterContext.HttpContext.Request);
            if(usr!=null)
            {
                controller.Context.CurrentUser=new ApiUser(usr);
            }

        }

        public void OnActionExecuted(ActionExecutedContext filterContext)
        {

        }

        private User AuthenticateRequest(HttpRequestBase Request)
        {
            var HeaderRequest = Request.Headers["Authorization"];
            string authToken;
            if (string.IsNullOrEmpty(HeaderRequest))
            {
                if (Request.Params["Token"] != string.Empty || Request.Params["Token"] != null)
                {
                    authToken = Request.Params["Token"];
                }
                else
                throw new ArgumentException("Request can't be authenticated - no authorization header or token parameter");
            }
            else
            {
                var authParams = HeaderRequest.Trim().Split(' ');
                if (authParams.Length < 2)
                {
                    throw new ArgumentException("Request can't be authenticated - no token");
                }

                if (!authParams[0].Equals("Token", StringComparison.InvariantCultureIgnoreCase))
                {
                    throw new ArgumentException("Request can't be authenticated - invalid auth scheme");
                }
                authToken = authParams[1];
            }
            User urs;
            try
            {
                var currentUser = new TokenRepository().getSubscriberByToken(authToken);
                urs = new User(currentUser.userId, currentUser.realName, "User", true);
            }
            catch
            {
                urs = null;
            }
            return urs;
        }


        private bool ShouldAuthenticate(ActionExecutingContext actionContext){
            var authenticate = (actionContext
                .ActionDescriptor
                .ControllerDescriptor
                .IsDefined(typeof(AuthenticateAttribute), false)
                ||
                actionContext.ActionDescriptor.IsDefined(typeof(AuthenticateAttribute), false)
                &&
                actionContext
                .ActionDescriptor
                .ControllerDescriptor
                .ControllerType
                .GetInterfaces().Contains(typeof(IContextAware)));

            return authenticate;
        }
    }
}