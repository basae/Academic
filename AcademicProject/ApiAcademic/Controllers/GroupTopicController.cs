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
    public class GroupTopicController : BaseController
    {
        private GroupRepository _groupanswerRepository;
        // GET api/group
        public GroupTopicController()
        {
            _groupanswerRepository=new GroupRepository();
        }

        //get all groups by topic
        public async Task<IEnumerable<GroupAnswers>> Get(string topic)
        {
            return await _groupanswerRepository.getGroupsByTopic(topic);
        }

        // GET api/grouptopic/5
        public async Task<IEnumerable<GroupAnswers>> Get()
        {
            return await _groupanswerRepository.getAllGroups();
        }

        // POST api/grouptopic
        public void Post([FromBody]string value)
        {
        }

        // PUT api/grouptopic/5
        public void Put(int id, [FromBody]string value)
        {
        }

        // DELETE api/grouptopic/5
        public void Delete(int id)
        {
        }
    }
}
