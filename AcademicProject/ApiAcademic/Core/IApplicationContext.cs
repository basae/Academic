using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;

namespace ApiAcademic.Core
{
    public interface IApplicationContext
    {
        ApiUser CurrentUser { get; set; }
        bool Unrestricted { get; set; }
    }
}
