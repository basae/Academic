using AcademicProject;
using Data;
using System;
using System.Collections.Generic;
using System.Linq;
using System.Net;
using System.Net.Http;
using System.Text;
using System.Threading.Tasks;
using System.Web.Http;

namespace ApiAcademic.Controllers
{
    public class TokensController : ApiController
    {
        private TokenRepository _tokenRepository;
        public TokensController()
        {
            _tokenRepository = new TokenRepository();
        }
        // GET api/tokens
        public IEnumerable<string> Get()
        {
            return new string[] { "value1", "value2" };
        }

        // GET api/tokens/5
        public string Get(int id)
        {
            return "value";
        }

        // POST api/tokens
        public async Task<UserLogin> Post([FromBody]UserIn user)
        {
            if (user == null)
            {
                throw new HttpResponseException(HttpStatusCode.BadRequest);
            }

            ContextModel isUser = await _tokenRepository.getTokenForUser(user.username, user.password);

            if (isUser == null)
            {
                throw new HttpResponseException(HttpStatusCode.Unauthorized);
            }

            return new UserLogin{
                id=isUser.userId,
                accessToken=Convert.ToBase64String(Encoding.ASCII.GetBytes(isUser.username + " " + user.password)),
                username=isUser.username,
                name=isUser.realName
                };
        }

        // PUT api/tokens/5
        public void Put(int id, [FromBody]string value)
        {
        }

        // DELETE api/tokens/5
        public void Delete(int id)
        {
        }
    }
}
