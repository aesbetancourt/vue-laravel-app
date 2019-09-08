<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">Files</div>

          <div class="card-body">
            <table class="table">
              <th>Name</th>
              <th>Size</th>

              <tr v-for="(files,i) in file" :key="i">
                <div v-if="!$gate.isAdmin()" class="ifcondition">
                  <div v-if="files.user_id == user" class="ifcondition">
                    <td>{{ files.filename }}</td>
                    <td>{{ files.size }} bytes</td>
                  </div>
                </div>
                <div v-else class="ifcondition">
                  <td>{{ files.filename }}</td>
                  <td>{{ files.size }} bytes</td>
                </div>
              </tr>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      file: [],
      user: ""
    };
  },
  mounted() {
    console.log("Component mounted.");
  },
  methods: {},
  created() {
    axios
      .get("/fil")
      .then(response => {
        this.file = response.data;
      })
      .catch(e => {
        console.log(e);
      });

    axios
      .get("/id-user")
      .then(response => {
        this.user = response.data;
      })
      .catch(e => {
        console.log(e);
      });
  }
};
</script>

<style scoped>
.ifcondition {
  display: contents;
}
</style>