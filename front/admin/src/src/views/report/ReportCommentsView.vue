<template>
  <main class="p-3">
    <h1 class="text-black mt-2 mb-4">Reported comments</h1>
    <div style="max-height: 800px; overflow-y: auto;">
      <table class="table table-striped w-100">
        <thead>
        <tr>
          <th>Id</th>
          <th>Comment_id</th>
          <th>Who_report_id</th>
          <th>Created at</th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="report in reports" :key="report.id">
          <td>{{ report.id }}</td>
          <td>{{ report.comment_id }}</td>
          <td>{{ report.who_report_id }}</td>
          <td>{{ report.created_at }}</td>
          <td class="d-flex gap-3 flex-row">
            <button class="btn btn-danger" @click="deleteReport(report.id)">Delete report</button>
            <button class="btn btn-danger" @click="banReport(report.id)">Ban report</button>
          </td>
        </tr>
        </tbody>
      </table>
    </div>
  </main>
</template>

<script>
import axios from "axios";

export default {
  name: 'reportCommentView',
  data() {
    return {
      reports: [],
    };
  },
  created() {
    this.fetchReports();
  },
  methods: {
    async fetchReports() {
      try {
        const response = await axios.get('/api/admin/report_comment');
        this.reports = response.data.data[0];
      } catch (error) {
        console.error('Error:', error.response);
      }
    },
    async deleteReport(reportId){
      try {
        await axios.delete('/api/admin/report_comment/' + reportId);
        this.reports = this.reports.filter(item => item.id !== reportId);
        this.$notify('Deleted');
      } catch (error) {
        console.error('Error:', error.response);
      }
    },
    async banReport(reportId){
      try {
        await axios.post('/api/admin/report/ban_comments/' + reportId);
        this.reports = this.reports.filter(item => item.id !== reportId);
        this.$notify('Banned');
      } catch (error) {
        console.error('Error:', error.response);
      }
    },
  }
}
</script>

<style>

</style>
