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
            return await _groupanswerRepository.getGroups(subscriberId);
        }

        // GET api/group/5
        public async Task<GroupAnswers> Get(long subscriberId, long id)
        {
            return await _groupanswerRepository.getGroupAnswerByID(subscriberId, id);
        }

        // POST api/group
        public async Task<long> Post([FromBody]GroupAnswers group, long subscriberId)
        {
            return await _groupanswerRepository.SaveGroup(group);
        }

        // PUT api/group/5
        public async Task<bool> Put([FromBody]GroupAnswers group,long subscriberId)
        {
            long result = await _groupanswerRepository.SaveGroup(group);
            return (result == 0) ? true : false;
        }

        // DELETE api/group/5
        public async Task<bool> Delete(long id, long subscriberId)
        {
            return await _groupanswerRepository.DeleteGroup(subscriberId, id);
        }
    }
}
