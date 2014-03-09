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
    public class AnswerRepository : BaseRepository
    {
        public AnswerRepository() { }

        public async Task<IEnumerable<Answer>> getAnswerByGroup(long groupid)
        {
            using (SqlConnection con = new SqlConnection(sqlConnection))
            {
                await con.OpenAsync();
                using (SqlCommand cmd = new SqlCommand())
                {
                    cmd.CommandType = CommandType.StoredProcedure;
                    cmd.Connection = con;
                    cmd.CommandText = "getAnswerByIdGroup";
                    cmd.Parameters.AddWithValue("id", groupid);
                    cmd.ExecuteNonQuery();
                    SqlDataAdapter bindData = new SqlDataAdapter(cmd);
                    DataTable getData = new DataTable();
                    bindData.Fill(getData);
                    return from row in getData.Rows.Cast<DataRow>() as IEnumerable<DataRow>
                           select new Answer
                           {
                               id = Convert.ToInt64(row["id"]),
                               answer = Convert.ToString(row["answer"]),
                               r1 = Convert.ToString(row["r1"]),
                               r2 = Convert.ToString(row["r2"]),
                               r3 = Convert.ToString(row["r3"]),
                               r4 = Convert.ToString(row["r4"]),
                               correctAnswer = Convert.ToString(row["correctasnwer"]),
                               typeAnswer = Convert.ToString(row["TypeAnswer"]),
                               points = Convert.ToDecimal(row["points"])
                           };
                }

            }
        }

        public async Task<Answer> getAnswerById(long answerid)
        {
            using (SqlConnection con = new SqlConnection(sqlConnection))
            {
                await con.OpenAsync();
                using (SqlCommand cmd = new SqlCommand())
                {
                    cmd.CommandType = CommandType.StoredProcedure;
                    cmd.Connection = con;
                    cmd.CommandText = "getAnswerById";
                    cmd.Parameters.AddWithValue("id", answerid);
                    cmd.ExecuteNonQuery();
                    SqlDataAdapter bindData = new SqlDataAdapter(cmd);
                    DataTable getData = new DataTable();
                    bindData.Fill(getData);
                    var resul = from row in getData.Rows.Cast<DataRow>() as IEnumerable<DataRow>
                                select new Answer
                                {
                                    id = Convert.ToInt64(row["id"]),
                                    answer = Convert.ToString(row["answer"]),
                                    r1 = Convert.ToString(row["r1"]),
                                    r2 = Convert.ToString(row["r2"]),
                                    r3 = Convert.ToString(row["r3"]),
                                    r4 = Convert.ToString(row["r4"]),
                                    correctAnswer = Convert.ToString(row["correctasnwer"]),
                                    typeAnswer = Convert.ToString(row["TypeAnswer"]),
                                    points=Convert.ToDecimal(row["points"]),
                                };
                    return resul.FirstOrDefault();
                }
            }


        }

        public async Task<long> SaveAnswer(Answer answer, long groupId)
        {
            using (SqlConnection con = new SqlConnection(sqlConnection))
            {
                await con.OpenAsync();
                using (SqlCommand cmd = new SqlCommand())
                {
                    cmd.CommandType = CommandType.StoredProcedure;
                    cmd.Connection = con;
                    cmd.CommandText = "saveAnswer";
                    cmd.Parameters.AddWithValue("id", answer.id).Direction = ParameterDirection.InputOutput;
                    cmd.Parameters.AddWithValue("groupId", groupId);
                    cmd.Parameters.AddWithValue("answer", answer.answer);
                    cmd.Parameters.AddWithValue("r1", answer.r1??"");
                    cmd.Parameters.AddWithValue("r2", answer.r2??"");
                    cmd.Parameters.AddWithValue("r3", answer.r3??"");
                    cmd.Parameters.AddWithValue("r4", answer.r4??"");
                    cmd.Parameters.AddWithValue("correctasnwer", answer.correctAnswer);
                    cmd.Parameters.AddWithValue("TypeAnswer", answer.typeAnswer??"");
                    cmd.Parameters.AddWithValue("points", answer.points);
                    await cmd.ExecuteNonQueryAsync();
                    return Convert.ToInt64((cmd.Parameters["id"].Value == DBNull.Value) ? 0 : cmd.Parameters["id"].Value);
                }
            }
        }

        public async Task<bool> SaveListAnswer(IEnumerable<Answer> answers, long groupId)
        {
            try
            {
                foreach (Answer answer in answers)
                {
                    await SaveAnswer(answer, groupId);
                }
                return true;
            }
            catch
            {
                return false;
            }
        }

        public async Task<bool> DeleteAnswer(long answerid)
        {
            using (SqlConnection con = new SqlConnection(sqlConnection))
            {
                await con.OpenAsync();
                using (SqlCommand cmd = new SqlCommand())
                {
                    cmd.CommandType = CommandType.StoredProcedure;
                    cmd.Connection = con;
                    cmd.CommandText = "DeleteAnswer";
                    cmd.Parameters.AddWithValue("id", answerid);                    
                    await cmd.ExecuteNonQueryAsync();
                    return (cmd.ExecuteNonQuery() == 0) ? true : false;
                }

            }
        }
    }
}
