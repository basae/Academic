using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;

namespace ApiAcademic.Core
{
    public class AuthenticatedContext:IApplicationContext
    {
        public ApiUser CurrentUser { get; set; }
        public bool Unrestricted { get; set; }
    }
}
