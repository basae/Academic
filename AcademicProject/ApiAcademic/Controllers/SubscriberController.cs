using AcademicProject;
using Data;
using System;
using System.Collections.Generic;
using System.Linq;
using System.Net;
using System.Net.Http;
using System.Threading.Tasks;
using System.Web.Http;
using ApiAcademic.Core;

namespace ApiAcademic.Controllers
{    
    public class SubscriberController : BaseController
    {
        // GET api/subscriber
        
        private SubscriberRepository _subscriberrepository;
        public SubscriberController(){
            _subscriberrepository = new SubscriberRepository();            
        }
        [Authenticate]
        public async Task<IEnumerable<Subscriber>> Get()
        {
            return await _subscriberrepository.getSubscribers();
        }

        // GET api/subscriber/5
        [Authenticate]
        public async Task<Subscriber> Get(long id)
        {
            if (id == 0)
            {
                throw new HttpResponseException(HttpStatusCode.BadRequest);
            }

            if (id != Context.CurrentUser.User.Id)
            {
                throw new HttpResponseException(HttpStatusCode.Unauthorized);

            }

            return await  _subscriberrepository.getSubscriberById(id);
            
        }

        // POST api/subscriber
        public async Task<long> Post([FromBody]Subscriber subscriber)
        {
            if (!ValidateSubscriber(subscriber))
            {
                throw new HttpResponseException(HttpStatusCode.BadRequest);
            }

            if (subscriber.id != -1)
            {
                throw new HttpResponseException(HttpStatusCode.BadRequest);
            }

           return await _subscriberrepository.SaveSubscriber(subscriber);
        }

        // PUT api/subscriber/5
        [Authenticate]
        public async Task<long> Put([FromBody]Subscriber subscriber)
        {
            if (!ValidateSubscriber(subscriber))
            {
                throw new HttpResponseException(HttpStatusCode.BadRequest);
            }

            if (subscriber.id != Context.CurrentUser.User.Id)
            {
                throw new HttpResponseException(HttpStatusCode.Unauthorized);
            }

            return await _subscriberrepository.SaveSubscriber(subscriber);
        }

        // DELETE api/subscriber/5
        [Authenticate]
        public async Task<bool> Delete(int id)
        {
            if (id == 0)
            {
                throw new HttpResponseException(HttpStatusCode.BadRequest);
            }

            if (id != Context.CurrentUser.User.Id)
            {
                throw new HttpResponseException(HttpStatusCode.Unauthorized);
            }

            return await _subscriberrepository.DeleteSubscriber(id);
        }

        public bool ValidateSubscriber(Subscriber subscriber)
        {
            bool result = true;

            if (subscriber.id == 0) result = false;

            if (subscriber.lastname == null || subscriber.lastname == string.Empty) result = false;

            if (subscriber.firstname == null || subscriber.firstname == string.Empty) result = false;

            if (subscriber.email == null || subscriber.email == string.Empty) result = false;

            if (subscriber.password == null || subscriber.password == string.Empty) result = false;

            if (subscriber.school == null || subscriber.school == string.Empty) result = false;

            if (subscriber.username == null || subscriber.username == string.Empty) result = false;

            return result;
        }
    }
}
