using System;
using System.Collections.Generic;
using System.Linq;
using System.Net;
using System.Net.Http;
using System.Threading.Tasks;
using System.Web.Http;
using AcademicProject;
using ApiAcademic.Core;
using Data;

namespace ApiAcademic.Controllers
{
    [Authenticate]
    public class GroupController : ApiController
    {
        private GroupRepository _groupanswerRepository;
        // GET api/group
        public GroupController(){
            _groupanswerRepository=new GroupRepository();
        }
        //get all groups  of subscriber
        public async Task<IEnumerable<GroupAnswers>> Get(long subscriberId)
        {
            if (subscriberId == 0)
                throw new HttpResponseException(HttpStatusCode.BadRequest);

            return await _groupanswerRepository.getGroups(subscriberId);
        }

        // GET api/group/5
        public async Task<GroupAnswers> Get(long subscriberId, long id)
        {
            if (subscriberId == 0 || id==0)
                throw new HttpResponseException(HttpStatusCode.BadRequest);

            return await _groupanswerRepository.getGroupAnswerByID(subscriberId, id);
        }

        // POST api/group
        public async Task<long> Post([FromBody]GroupAnswers group, long subscriberId)
        {
            if (subscriberId == 0)
                throw new HttpResponseException(HttpStatusCode.BadRequest);

            if(!ValidateGroupd(group))
                throw new HttpResponseException(HttpStatusCode.BadRequest);

            return await _groupanswerRepository.SaveGroup(group,subscriberId);
        }

        // PUT api/group/5
        public async Task<bool> Put([FromBody]GroupAnswers group,long subscriberId)
        {
            if (subscriberId == 0)
                throw new HttpResponseException(HttpStatusCode.BadRequest);

            if (!ValidateGroupd(group))
                throw new HttpResponseException(HttpStatusCode.BadRequest);

            long result = await _groupanswerRepository.SaveGroup(group,subscriberId);
            return (result == 0) ? true : false;
        }

        // DELETE api/group/5
        public async Task<bool> Delete(long id, long subscriberId)
        {
            if (subscriberId == 0 || id==0) 
                throw new HttpResponseException(HttpStatusCode.BadRequest);
            
            return await _groupanswerRepository.DeleteGroup(subscriberId, id);
        }

        public bool ValidateGroupd(GroupAnswers group)
        {
            bool result = true;

            if (group.id == 0) result = false;

            if (group.topic == null || group.topic == string.Empty) result = false;

            return result;
        }
    }
}
