<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">
            Files
            <a href class="btn btn-info">Add files</a>
          </div>

          <div class="card-body">
            <!-- @if($files->count()) -->
            <table class="table">
              <th>Name</th>
              <th>Size</th>
              <!-- @foreach($files as $file) -->
              <tr v-for="(file,i) in files" :key="i">
                <td>{{file.filename}}</td>
                <td>{{file.size}} bytes</td>
              </tr>
              <!-- @endforeach -->
            </table>
            <!-- @else -->
            <!-- You have no files yet! -->
            <!-- @endif -->
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
      files: []
    };
  },
  mounted() {
    console.log("Component mounted.");
  },
  methods: {},
  created() {
    axios.get("/fil").then(response => (this.files = response));
  }
};
</script>

<style scoped>
</style>