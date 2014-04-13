using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using AcademicProject;
using System.Configuration;
using System.Data.SqlClient;
using System.Data;


namespace Data
{
    
    public class GroupRepository : BaseRepository
    {
        public GroupRepository()
        {

        }


        public async Task<GroupAnswers> getGroupAnswerByID(long subscriberid, long groupid)
        {
            using (SqlConnection con = new SqlConnection(sqlConnection))
            {
                await con.OpenAsync();
                using (SqlCommand cmd = new SqlCommand())
                {
                    cmd.CommandType = CommandType.StoredProcedure;
                    cmd.Connection = con;
                    cmd.CommandText = "getGroupsById";
                    cmd.Parameters.AddWithValue("id", groupid);
                    cmd.Parameters.AddWithValue("subscriberid", subscriberid);
                    cmd.ExecuteNonQuery();
                    SqlDataAdapter bindData = new SqlDataAdapter(cmd);
                    DataTable getData = new DataTable();
                    bindData.Fill(getData);
                    var result = from row in getData.Rows.Cast<DataRow>() as IEnumerable<DataRow>
                                 select new GroupAnswers
                                 {
                                     id = Convert.ToInt64(row["id"]),
                                     subscriberName = Convert.ToString(row["subscribername"]),
                                     topic = Convert.ToString(row["topic"]),
                                     dificultyGrade = Convert.ToString(row["dificultyGrade"]),
                                     creationDate = Convert.ToDateTime(row["creationDate"])
                                 };
                    return result.FirstOrDefault();
                }
            }
        }

        public async Task<IEnumerable<GroupAnswers>> getGroups(long subscriberId)
        {
            using (SqlConnection con = new SqlConnection(sqlConnection))
            {
                await con.OpenAsync();
                using (SqlCommand cmd = new SqlCommand())
                {
                    cmd.CommandType = CommandType.StoredProcedure;
                    cmd.Connection = con;
                    cmd.CommandText = "getGroupsBySubscriber";
                    cmd.Parameters.AddWithValue("subscriberid ", subscriberId);
                    await cmd.ExecuteNonQueryAsync();
                    SqlDataAdapter bindData = new SqlDataAdapter(cmd);
                    DataTable getData = new DataTable();
                    bindData.Fill(getData);
                    return from row in getData.Rows.Cast<DataRow>() as IEnumerable<DataRow>
                           select new GroupAnswers
                           {
                               id = Convert.ToInt64(row["id"]),
                               
                               subscriberName = Convert.ToString(row["subscribername"]),
                               topic = Convert.ToString(row["topic"]),
                               dificultyGrade = Convert.ToString(row["dificultyGrade"]),
                               creationDate = Convert.ToDateTime(row["creationDate"])
                           };
                }
            }

        }

        public async Task<IEnumerable<GroupAnswers>> getGroupsByTopic(string topic)
        {
            using (SqlConnection con = new SqlConnection(sqlConnection))
            {
                await con.OpenAsync();
                using (SqlCommand cmd = new SqlCommand())
                {
                    cmd.CommandType = CommandType.StoredProcedure;
                    cmd.Connection = con;
                    cmd.CommandText = "getGroupsByTopic";
                    cmd.Parameters.AddWithValue("topic ", topic);
                    await cmd.ExecuteNonQueryAsync();
                    SqlDataAdapter bindData = new SqlDataAdapter(cmd);
                    DataTable getData = new DataTable();
                    bindData.Fill(getData);
                    return from row in getData.Rows.Cast<DataRow>() as IEnumerable<DataRow>
                           select new GroupAnswers
                           {
                               id = Convert.ToInt64(row["id"]),
                               
                               subscriberName = Convert.ToString(row["subscribername"]),
                               topic = Convert.ToString(row["topic"]),
                               dificultyGrade = Convert.ToString(row["dificultyGrade"]),
                               creationDate = Convert.ToDateTime(row["creationDate"])
                           };
                }
            }

        }

        public async Task<IEnumerable<GroupAnswers>> getAllGroups()
        {
            using (SqlConnection con = new SqlConnection(sqlConnection))
            {
                await con.OpenAsync();
                using (SqlCommand cmd = new SqlCommand())
                {
                    cmd.CommandType = CommandType.StoredProcedure;
                    cmd.Connection = con;
                    cmd.CommandText = "getGroups";
                    await cmd.ExecuteNonQueryAsync();
                    SqlDataAdapter bindData = new SqlDataAdapter(cmd);
                    DataTable getData = new DataTable();
                    bindData.Fill(getData);
                    return from row in getData.Rows.Cast<DataRow>() as IEnumerable<DataRow>
                           select new GroupAnswers
                           {
                               id = Convert.ToInt64(row["id"]),
                               subscriberName = Convert.ToString(row["subscribername"]),
                               topic = Convert.ToString(row["topic"]),
                               dificultyGrade = Convert.ToString(row["dificultyGrade"]),
                               creationDate = Convert.ToDateTime(row["creationDate"]),
                               answerNumber = Convert.ToUInt16(row["answernumber"]),
                               myAnswer = new AnswerRepository().getAnswerByGroupSync(Convert.ToInt64(row["id"]))
                                          
                           };
                }
            }

        }

        public async Task<long> SaveGroup(GroupAnswers group,long subscriberid)
        {
            using (SqlConnection con = new SqlConnection(sqlConnection))
            {
                await con.OpenAsync();
                using (SqlCommand cmd = new SqlCommand())
                {
                    cmd.CommandType = CommandType.StoredProcedure;
                    cmd.Connection = con;
                    cmd.CommandText = "saveGroup";
                    cmd.Parameters.AddWithValue("id", group.id).Direction=ParameterDirection.InputOutput;
                    cmd.Parameters.AddWithValue("subscriberid", subscriberid);
                    cmd.Parameters.AddWithValue("topic", group.topic);
                    cmd.Parameters.AddWithValue("dificultyGrade", group.dificultyGrade);
                    await cmd.ExecuteNonQueryAsync();
                    return Convert.ToInt64((cmd.Parameters["id"].Value == DBNull.Value) ? 0 : cmd.Parameters["id"].Value);
                }
            }

        }

        public async Task<bool> DeleteGroup(long subscriberid, long groupid)
        {
            using (SqlConnection con = new SqlConnection(sqlConnection))
            {
                await con.OpenAsync();
                using (SqlCommand cmd = new SqlCommand())
                {
                    cmd.CommandType = CommandType.StoredProcedure;
                    cmd.Connection = con;
                    cmd.CommandText = "DeleteGroupById";
                    cmd.Parameters.AddWithValue("id", groupid);
                    cmd.Parameters.AddWithValue("subscriberid", subscriberid);
                    await cmd.ExecuteNonQueryAsync();
                    return (cmd.ExecuteNonQuery() == 0) ? true : false;
                }

            }
        }
    }
}
