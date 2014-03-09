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
    public class AnswerController : ApiController
    {
        // GET api/answer
        private AnswerRepository _answerRepository;

        public AnswerController()
        {
            _answerRepository = new AnswerRepository();
        }

        public async Task<IEnumerable<Answer>> Get(long groupId)
        {
            if ((groupId == null)&&(groupId < 1))
                throw new HttpResponseException(HttpStatusCode.BadRequest);
            return await _answerRepository.getAnswerByGroup(groupId);
        }

        // GET api/answer/5
        public async Task<Answer> Get(long groupId,long id)
        {
            if ((id == null) && (id <1))
                throw new HttpResponseException(HttpStatusCode.BadRequest);
            return await _answerRepository.getAnswerById(id);
        }

        // POST api/answer
        public async Task<long> Post([FromBody]Answer answer,long groupId)
        {
            if(answer==null)
                throw new HttpResponseException(HttpStatusCode.BadRequest);

            if (!ValidateAnswers(answer))
                throw new HttpResponseException(HttpStatusCode.BadRequest);

            return await _answerRepository.SaveAnswer(answer,groupId);
        }

        // PUT api/answer/5
        public async Task<bool> Put([FromBody]Answer answer,long groupId)
        {
            if (answer == null)
                throw new HttpResponseException(HttpStatusCode.BadRequest);

            if(!ValidateAnswers(answer))
                throw new HttpResponseException(HttpStatusCode.BadRequest);

            long result = await _answerRepository.SaveAnswer(answer, groupId);
            return (result == 0) ? true : false;
        }

        // DELETE api/answer/5
        public async Task<bool> Delete(long id)
        {
            if (id == null)
                throw new HttpResponseException(HttpStatusCode.BadRequest);
            return await _answerRepository.DeleteAnswer(id);
        }

        public bool ValidateAnswers(Answer answer)
        {
            bool result = true;

            if (answer.id == 0) result = false;

            if (answer.answer == null || answer.answer==string.Empty) result = false;

            if (answer.correctAnswer == null || answer.correctAnswer==string.Empty) result = false;

            if ((answer.r1 == null || answer.r1 == string.Empty) && (answer.r2 == null || answer.r2 == string.Empty) && (answer.r3 == null || answer.r3 == string.Empty) && (answer.r4 == null || answer.r4 == string.Empty)) result = false;

            if (answer.typeAnswer == null || answer.typeAnswer==string.Empty) result = false;

            if (answer.points==0) result = false;

            return result;
        }
    }
}
