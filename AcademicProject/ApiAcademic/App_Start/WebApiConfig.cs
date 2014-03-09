using System;
using System.Collections.Generic;
using System.Linq;
using System.Web.Http;

namespace ApiAcademic
{
    public static class WebApiConfig
    {
        public static void Register(HttpConfiguration config)
        {
                       
            

            config.Routes.MapHttpRoute(
                name: "Group",
                routeTemplate: "api/subscribers/{subscriberId}/groups/{id}",
                defaults: new { id = RouteParameter.Optional, controller = "Group" }
                
            );

            config.Routes.MapHttpRoute(
                name: "GroupTopic",
                routeTemplate: "api/subscribers/{subscriberId}/topic/{topic}",
                defaults: new { topic = RouteParameter.Optional, controller = "GroupTopic" }

            );

            config.Routes.MapHttpRoute(
                name: "Answer",
                routeTemplate: "api/groups/{groupId}/answers/{id}",
                defaults: new { id = RouteParameter.Optional, controller = "Answer" }

            );

            config.Routes.MapHttpRoute(
                name: "ListAnswer",
                routeTemplate: "api/groups/{groupId}/answers/{id}",
                defaults: new { id = RouteParameter.Optional, controller = "ListAnswer" }

            );

            config.Routes.MapHttpRoute(
                name: "Subscriber",
                routeTemplate: "api/subscribers/{subscriberId}/",
                defaults: new { subscriberId = RouteParameter.Optional, controller = "Subscriber" }

            );

            config.Routes.MapHttpRoute(
                name: "DefaultApi",
                routeTemplate: "api/{controller}/{id}",
                defaults: new { id = RouteParameter.Optional }
            );
        }
    }
}
