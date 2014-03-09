using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace AcademicProject
{
    public class Answer
    {
        public long id { get; set; }
        public string answer { get; set; }
        public string r1 { get; set; }
        public string r2 { get; set; }
        public string r3 { get; set; }
        public string r4 { get; set; }
        public string correctAnswer { get; set; }
        public string typeAnswer { get; set; }
        public decimal points { get; set; }
    }
}
