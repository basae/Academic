using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace AcademicProject
{
    public class GroupAnswers
    {
        public long id { get; set; }
        public IEnumerable<Answer> myAnswer { get; set; }
        public string dificultyGrade { get; set; }
        public string topic { get; set; }
        public string subscriberName { get; set; }
        public int answerNumber { get; set; }
        public DateTime creationDate { get; set; }
    }
}
