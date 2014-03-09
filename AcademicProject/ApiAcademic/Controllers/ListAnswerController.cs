using System;
using System.Collections.Generic;
using System.Linq;
using System.Net;
using System.Net.Http;
using System.Threading.Tasks;
using System.Web.Http;
using AcademicProject;
using Data;

namespace ApiAcademic.Controllers
{
    public class ListAnswerController : ApiController
    {

        private AnswerRepository _answerRepository;

        public ListAnswerController()
        {
            _answerRepository = new AnswerRepository();
        }

        // POST api/answer
        public async Task<bool> Post([FromBody]IEnumerable<Answer> answers, long groupId)
        {
            return await _answerRepository.SaveListAnswer(answers, groupId);

        }

        // PUT api/answer/5
        public async Task<bool> Put([FromBody]IEnumerable<Answer> answers, long groupId)
        {
            return await _answerRepository.SaveListAnswer(answers, groupId);
        }
    }
}
