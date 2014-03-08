using AcademicProject;
using Data;
using System;
using System.Collections.Generic;
using System.Linq;
using System.Net;
using System.Net.Http;
using System.Threading.Tasks;
using System.Web.Http;

namespace ApiAcademic.Controllers
{
    public class SubscriberController : ApiController
    {
        // GET api/subscriber
        private SubscriberRepository _subscriberrepository;
        public SubscriberController(){
            _subscriberrepository = new SubscriberRepository();
        }
        public async Task<IEnumerable<Subscriber>> Get()
        {
            return await _subscriberrepository.getSubscribers();
        }

        // GET api/subscriber/5
        public Subscriber Get(long id)
        {
            return _subscriberrepository.getSubscriberById(id);
        }

        // POST api/subscriber
        public long Post([FromBody]Subscriber subscriber)
        {
           return _subscriberrepository.SaveSubscriber(subscriber);
        }

        // PUT api/subscriber/5
        public long Put([FromBody]Subscriber subscriber)
        {
            return _subscriberrepository.SaveSubscriber(subscriber);
        }

        // DELETE api/subscriber/5
        public bool Delete(int id)
        {
            return _subscriberrepository.DeleteSubscriber(id);
        }
    }
}
