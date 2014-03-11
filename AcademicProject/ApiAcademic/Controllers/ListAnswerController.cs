using System;
using System.Collections.Generic;
using System.Linq;
using System.Net;
using System.Net.Http;
using System.Threading.Tasks;
using System.Web.Http;
using AcademicProject;
using Data;
using ApiAcademic.Core;

namespace ApiAcademic.Controllers
{
    [Authenticate]
    public class ListAnswerController : BaseController
    {

        private AnswerRepository _answerRepository;

        public ListAnswerController()
        {
            _answerRepository = new AnswerRepository();
        }

        // POST api/answer
        public async Task<bool> Post([FromBody]IEnumerable<Answer> answers, long groupId)
        {
            if (groupId == 0)
                throw new HttpResponseException(HttpStatusCode.BadRequest);

            if (!ValidateAnswers(answers))
                throw new HttpResponseException(HttpStatusCode.BadRequest);

            return await _answerRepository.SaveListAnswer(answers, groupId);

        }

        // PUT api/answer/5
        public async Task<bool> Put([FromBody]IEnumerable<Answer> answers, long groupId)
        {
            if(groupId==0)
                throw new HttpResponseException(HttpStatusCode.BadRequest);

            if (!ValidateAnswers(answers))
                throw new HttpResponseException(HttpStatusCode.BadRequest);

            return await _answerRepository.SaveListAnswer(answers, groupId);
        }

        public bool ValidateAnswers(IEnumerable<Answer> answers)
        {
            bool result = true;
            foreach (Answer answer in answers)
            {
                if (answer.id == 0) result = false;

                if (answer.answer == null || answer.answer == string.Empty) result = false;

                if (answer.correctAnswer == null || answer.correctAnswer == string.Empty) result = false;

                if ((answer.r1 == null || answer.r1 == string.Empty) && (answer.r2 == null || answer.r2 == string.Empty) && (answer.r3 == null || answer.r3 == string.Empty) && (answer.r4 == null || answer.r4 == string.Empty)) result = false;

                if (answer.typeAnswer == null || answer.typeAnswer == string.Empty) result = false;

                if (answer.points == 0) result = false;
            }

            return result;
        }
    }
}
