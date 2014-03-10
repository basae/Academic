using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;

namespace ApiAcademic.Core
{
    public interface IContextAware
    {
        IApplicationContext Context { get; }
    }
}
