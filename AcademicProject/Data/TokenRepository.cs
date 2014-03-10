using System;
using System.Collections.Generic;
using System.Data;
using System.Data.SqlClient;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using AcademicProject;

namespace Data
{
    public class TokenRepository:BaseRepository
    {
        public TokenRepository() { }

        public  ContextModel getSubscriberByToken(string token)
        {
            byte[] getbyteToken = Convert.FromBase64String(token);
            string[] parameters = Encoding.UTF8.GetString(getbyteToken, 0, getbyteToken.Length).Split(' ');
            using (SqlConnection con = new SqlConnection(sqlConnection))
            {
                con.Open();
                using (SqlCommand cmd = new SqlCommand())
                {
                    cmd.CommandType = CommandType.StoredProcedure;
                    cmd.Connection = con;
                    cmd.CommandText = "getUserByToken";
                    cmd.Parameters.AddWithValue("username", parameters[0]);
                    cmd.Parameters.AddWithValue("password", parameters[1]);
                    cmd.ExecuteNonQuery();
                    SqlDataAdapter bindData = new SqlDataAdapter(cmd);
                    DataTable getData = new DataTable();
                    bindData.Fill(getData);

                    var result = from row in getData.Rows.Cast<DataRow>() as IEnumerable<DataRow>
                                 select new ContextModel
                                 {
                                     userId = Convert.ToInt64(row["id"]),
                                     username = Convert.ToString(row["username"]),
                                     realName=Convert.ToString(row["firstname"])+" "+Convert.ToString(row["lastname"]),
                                     school = Convert.ToString(row["school"])
                                 };
                    return result.FirstOrDefault();
                }

            }

        }

        public async Task<ContextModel> getTokenForUser(string username, string password)
        {
            using (SqlConnection con = new SqlConnection(sqlConnection))
            {
                await con.OpenAsync();
                using (SqlCommand cmd = new SqlCommand())
                {
                    cmd.CommandType = CommandType.StoredProcedure;
                    cmd.Connection = con;
                    cmd.CommandText = "getUserByToken";
                    cmd.Parameters.AddWithValue("username", username);
                    cmd.Parameters.AddWithValue("password", password);
                    cmd.ExecuteNonQuery();
                    SqlDataAdapter bindData = new SqlDataAdapter(cmd);
                    DataTable getData = new DataTable();
                    bindData.Fill(getData);

                    var result = from row in getData.Rows.Cast<DataRow>() as IEnumerable<DataRow>
                                 select new ContextModel
                                 {
                                     userId = Convert.ToInt64(row["id"]),
                                     username = Convert.ToString(row["username"]),
                                     password = Convert.ToString(row["pass"]),
                                     realName = Convert.ToString(row["firstname"]) + " " + Convert.ToString(row["lastname"]),
                                     school = Convert.ToString(row["school"])
                                 };

                    return result.FirstOrDefault();
                }

            }
        }


    }
}
