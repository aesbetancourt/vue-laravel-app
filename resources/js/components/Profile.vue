<template>
  <div class="container">
    <div class="row">
      <div class="col-md-12 mt-3">
        <div class="card card-widget widget-user">
          <!-- Add the bg color to the header using any of the bg-* classes -->
          <div
            class="widget-user-header text-white"
            style="background-image:url('./img/user-cover.jpg')"
          >
            <h3 class="widget-user-username">{{this.form.name}}</h3>
            <h5 class="widget-user-desc">{{this.form.type}}</h5>
          </div>
          <div class="widget-user-image">
            <img class="img-circle" :src="getProfilePhoto()" alt="User Avatar" />
          </div>
          <div class="card-footer">
            <div class="row">
              <div class="col-sm-4 border-right">
                <div class="description-block">
                  <h5 class="description-header">25</h5>
                  <span class="description-text">Publicaciones</span>
                </div>
                <!-- /.description-block -->
              </div>
              <!-- /.col -->
              <div class="col-sm-4 border-right">
                <div class="description-block">
                  <h5 class="description-header">500</h5>
                  <span class="description-text">Seguidores</span>
                </div>
                <!-- /.description-block -->
              </div>
              <!-- /.col -->
              <div class="col-sm-4">
                <div class="description-block">
                  <h5 class="description-header">10</h5>
                  <span class="description-text">Libros Terminados</span>
                </div>
                <!-- /.description-block -->
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->
          </div>
        </div>
      </div>

      <!-- tab -->

      <div class="col-md-12">
        <div class="card">
          <div class="card-header p-2">
            <h6 class="text-primary font-weight-bold m-0">Configuración</h6>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="tab-content">
              <!-- Setting Tab -->
              <div class="tab-pane active show" id="settings">
                <form class="form-horizontal">
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Nombre</label>
                    <div class="col-sm-12">
                      <input
                        type="text"
                        v-model="form.name"
                        class="form-control"
                        id="inputName"
                        placeholder="Name"
                        :class="{ 'is-invalid': form.errors.has('name') }"
                      />
                      <has-error :form="form" field="name"></has-error>
                    </div>
                    <label for="inputCi" class="col-sm-2 control-label">Cedula</label>
                    <div class="col-sm-12">
                      <input
                        v-model="form.ci"
                        type="text"
                        class="form-control"
                        placeholder="Cedula"
                        id="inputCi"
                      />
                      <has-error :form="form" field="ci"></has-error>
                    </div>
                    <label for="inputPhone" class="col-sm-2 control-label">Telefono</label>
                    <div class="col-sm-12">
                      <input
                        type="text"
                        v-model="form.phone"
                        class="form-control"
                        placeholder="Telefono"
                        id="inputPhone"
                      />
                      <has-error :form="form" field="phone"></has-error>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputEmail" class="col-sm-2 control-label">Email</label>

                    <div class="col-sm-12">
                      <input
                        type="email"
                        v-model="form.email"
                        class="form-control"
                        id="inputEmail"
                        placeholder="Email"
                        :class="{ 'is-invalid': form.errors.has('email') }"
                      />
                      <has-error :form="form" field="email"></has-error>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="photo" class="col-sm-2 control-label">Foto de perfil</label>
                    <div class="col-sm-12">
                      <input type="file"  id="btn_file" @change="updateProfile" name="photo" class="form-input" />
                    </div>
                  </div>

                  <div class="form-group">
                    <label
                      for="password"
                      class="col-sm-12 control-label"
                    >Contraseña (Dejar si no se va a cambiar)</label>

                    <div class="col-sm-12">
                      <input
                        type="password"
                        v-model="form.password"
                        class="form-control"
                        id="password"
                        placeholder="Contraseña"
                        :class="{ 'is-invalid': form.errors.has('password') }"
                      />
                      <has-error :form="form" field="password"></has-error>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-12">
                      <input type="password" id="rp_password" class="form-control" placeholder="Repetir contraseña" />
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-12">
                      <button
                        @click.prevent="updateInfo"
                        type="submit"
                        class="btn btn-success"
                        id= "btn_update"
                      >Actualizar</button>
                    </div>
                  </div>
                </form>
              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.nav-tabs-custom -->
      </div>
      <!-- end tabs -->
    </div>
  </div>
</template>



<script>
export default {
  data() {
    return {
      is_photo_changed: false,
      form: new Form({
        id: "",
        name: "",
        email: "",
        password: "",
        type: "",
        photo: "",
        ci: "",
        phone: ""
      })
    };
  },
  mounted() {
    console.log("Component mounted.");
  },
  methods: {
    updateInfo() {
      this.$Progress.start();
      if (this.form.password === "") {
        this.form.password = undefined;
      }
      this.form
        .put("api/profile")
        .then(() => {
          Fire.$emit("AfterCreate");
          this.$Progress.finish();
        })
        .catch(() => {
          this.$Progress.fail();
        });
    },
    updateProfile(e) {
      let file = e.target.files[0];
      let reader = new FileReader();
      let limit = 1024 * 1024 * 2;
      if (file["size"] > limit) {
        swal({
          type: "error",
          title: "Oops...",
          text: "You are uploading a large file"
        });
        return false;
      }
      reader.onloadend = file => {
        this.form.photo = reader.result;
      };
      reader.readAsDataURL(file);
    },
    getProfilePhoto() {
      let photo =
        this.form.photo.length > 200
          ? this.form.photo
          : "img/profile/" + this.form.photo;
      return photo;
    }
  },
  created() {
    axios.get("api/profile").then(({ data }) => this.form.fill(data));
  }
};
</script>

<style>
.widget-user-header {
  background-position: center center;
  background-size: cover;
  height: 250px !important;
}
.widget-user .card-footer {
  padding: 0;
}
</style>
