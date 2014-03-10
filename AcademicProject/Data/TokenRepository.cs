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

        public ContextModel getSubscriberByToken(string token)
        {
            using (SqlConnection con = new SqlConnection(sqlConnection))
            {
                con.Open();
                using (SqlCommand cmd = new SqlCommand())
                {
                    cmd.CommandType = CommandType.StoredProcedure;
                    cmd.Connection = con;
                    cmd.CommandText = "getUserByToken";
                    cmd.Parameters.AddWithValue("token", token);
                    cmd.ExecuteNonQuery();
                    SqlDataAdapter bindData = new SqlDataAdapter(cmd);
                    DataTable getData = new DataTable();
                    bindData.Fill(getData);

                    var result = from row in getData.Rows.Cast<DataRow>() as IEnumerable<DataRow>
                                 select new ContextModel
                                 {
                                     userId = Convert.ToInt64(row["id"]),
                                     username = Convert.ToString(row["username"]),
                                     realName=Convert.ToString(row["firstname"])+" "+Convert.ToString(row["lastname"])
                                 };
                    return result.FirstOrDefault();
                }

            }

        }


    }
}
