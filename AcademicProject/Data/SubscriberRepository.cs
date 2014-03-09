using AcademicProject;
using System;
using System.Collections.Generic;
using System.Data.SqlClient;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Configuration;
using System.Data;


namespace Data
{
    public class SubscriberRepository:BaseRepository
    {
        
        public SubscriberRepository(){
            
        }
        
        public async Task<IEnumerable<Subscriber>> getSubscribers()
            {
                using (SqlConnection con = new SqlConnection(sqlConnection))
                {
                    await con.OpenAsync();
                    using (SqlCommand cmd = new SqlCommand())
                    {
                        cmd.CommandType = CommandType.StoredProcedure;
                        cmd.Connection = con;
                        cmd.CommandText = "getUsers";                    
                        await cmd.ExecuteNonQueryAsync();
                        SqlDataAdapter bindData = new SqlDataAdapter(cmd);
                        DataTable getData = new DataTable();
                        bindData.Fill(getData);
                        return from row in getData.Rows.Cast<DataRow>() as IEnumerable<DataRow>
                               select new Subscriber
                               {
                                   id=Convert.ToInt64(row["id"]),
                                   username=Convert.ToString(row["username"]),
                                   password=Convert.ToString(row["pass"]),
                                   firstname=Convert.ToString(row["firstname"]),
                                   lastname=Convert.ToString(row["lastname"]),
                                   email=Convert.ToString(row["email"]),
                                   school=Convert.ToString(row["school"]),
                                   regDate=DateTime.Parse(row["regDate"].ToString())
                               };
                    }

                }
            }

        public Subscriber getSubscriberById(long id)
        {
            using (SqlConnection con = new SqlConnection(sqlConnection))
            {
                con.Open();
                using (SqlCommand cmd = new SqlCommand())
                {
                    cmd.CommandType = CommandType.StoredProcedure;
                    cmd.Connection = con;
                    cmd.CommandText = "getusersbyid";
                    cmd.Parameters.AddWithValue("id", id);
                    cmd.ExecuteNonQuery();
                    SqlDataAdapter bindData = new SqlDataAdapter(cmd);
                    DataTable getData = new DataTable();
                    bindData.Fill(getData);

                    var result= from row in getData.Rows.Cast<DataRow>() as IEnumerable<DataRow>
                           select new Subscriber
                           {
                               id = Convert.ToInt64(row["id"]),
                               username = Convert.ToString(row["username"]),
                               password = Convert.ToString(row["pass"]),
                               firstname = Convert.ToString(row["firstname"]),
                               lastname = Convert.ToString(row["lastname"]),
                               email = Convert.ToString(row["email"]),
                               school = Convert.ToString(row["school"]),
                               regDate = DateTime.Parse(row["regDate"].ToString())
                           };
                    return result.FirstOrDefault();
                }

            }

        }

        public long SaveSubscriber(Subscriber subscriber)
        {
            using (SqlConnection con = new SqlConnection(sqlConnection))
            {
                con.Open();
                using (SqlCommand cmd = new SqlCommand())
                {
                    cmd.CommandType = CommandType.StoredProcedure;
                    cmd.Connection = con;
                    cmd.CommandText = "saveuser";
                    cmd.Parameters.AddWithValue("id", subscriber.id).Direction=ParameterDirection.InputOutput;
                    cmd.Parameters.AddWithValue("username", subscriber.username);
                    cmd.Parameters.AddWithValue("pass", subscriber.password);
                    cmd.Parameters.AddWithValue("firstname", subscriber.firstname);
                    cmd.Parameters.AddWithValue("lastname", subscriber.lastname);
                    cmd.Parameters.AddWithValue("email", subscriber.email);
                    cmd.Parameters.AddWithValue("school", subscriber.school);
                    cmd.ExecuteNonQuery();
                    return Convert.ToInt64((cmd.Parameters["id"].Value == DBNull.Value) ? 0 : cmd.Parameters["id"].Value);
                }

            }
        }

        public bool DeleteSubscriber(long id)
        {
            using (SqlConnection con = new SqlConnection(sqlConnection))
            {
                con.Open();
                using (SqlCommand cmd = new SqlCommand())
                {
                    cmd.CommandType = CommandType.StoredProcedure;
                    cmd.Connection = con;
                    cmd.CommandText = "deleteuser";
                    cmd.Parameters.AddWithValue("id", id);
                    cmd.ExecuteNonQuery();
                    return (cmd.ExecuteNonQuery() == 0) ? true : false;
                }

            }
        }

    
 }
}
