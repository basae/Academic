﻿using ApiAcademic.Core;
using System.Web;
using System.Web.Mvc;

namespace ApiAcademic
{
    public class FilterConfig
    {
        public static void RegisterGlobalFilters(GlobalFilterCollection filters)
        {
            filters.Add(new HandleErrorAttribute());
            filters.Add(new TokenAuthorizationFilter());
        }
    }
}