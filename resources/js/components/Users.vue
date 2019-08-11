<template>
    <div class="container">
        <div class="row mt-5" v-if="$gate.isAdmin()">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Usuarios Registrados</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-primary" @click="newModal">
                                Nuevo Usuario <i class="fas fa-user-plus"></i>
                            </button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Email</th>
                                <th>Cedula</th>
                                <th>Telefono</th>
                                <th>Acceso</th>
                                <th>Miembro desde</th>
                                <th>Editar</th>

                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="user in users.data" :key="user.id">
                                <td>{{user.id}}</td>
                                <td>{{user.name}}</td>
                                <td>{{user.email}}</td>
                                <td>{{user.ci}}</td>
                                <td>{{user.phone}}</td>
                                <td>{{user.type}}</td>
                                <td>{{user.created_at}}</td>
                                <td>
                                    <a href="#" @click="editModal(user)">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    /
                                    <a href="#" @click="deleteUser(user.id)">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <pagination :data="users" @pagination-change-page="getResults"></pagination>
                    </div>
                </div>
                <!-- /.card -->
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="addNew" tabindex="-1" role="dialog" aria-labelledby="addNewLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addNewLabel" v-show="!editMode">Agregar Usuario</h5>
                        <h5 class="modal-title" id="addNewLabel" v-show="editMode">Editar Usuario</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form @submit.prevent="editMode ? updateUser() : createUser()">
                        <div class="modal-body">
                            <div class="form-group">
                                <input v-model="form.name" type="text" name="name" placeholder="Name"
                                       class="form-control" :class="{ 'is-invalid': form.errors.has('username') }">
                                <has-error :form="form" field="name"></has-error>
                            </div>

                            <div class="form-group">
                                <input v-model="form.email" type="email" name="email"
                                       placeholder="Email"
                                       class="form-control" :class="{ 'is-invalid': form.errors.has('email') }">
                                <has-error :form="form" field="email"></has-error>
                            </div>
                            <div class="form-group">
                                <input type="text" name="ci"
                                       placeholder="Cedula"
                                       class="form-control" v-model="form.ci">
                                <has-error :form="form" field="ci"></has-error>
                            </div>
                            <div class="form-group">
                                <input type="text" name="phone" placeholder="Telefono" class="form-control" v-model="form.phone">
                                <has-error :form="form" field="phone"></has-error>
                            </div>


                            <div class="form-group">
                                <select name="type" v-model="form.type" id="type" class="form-control" placeholder="Seleccionar tipo de Usuario" :class="{ 'is-invalid': form.errors.has('type') }">
                                    <option value="Administrador">Administrador</option>
                                    <option value="Estándar">Usuario estándar</option>
                                </select>
                                <has-error :form="form" field="type"></has-error>
                            </div>

                            <div class="form-group">
                                <input v-model="form.password" type="password" name="password" id="password" placeholder="Password"
                                       class="form-control" :class="{ 'is-invalid': form.errors.has('password') }">
                                <has-error :form="form" field="password"></has-error>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                            <button v-show="editMode" type="submit" class="btn btn-success">Actualizar</button>
                            <button v-show="!editMode" type="submit" class="btn btn-primary">Crear</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return {
                editMode: false,
                users: {},
                form: new Form({
                    id: '',
                    name: '',
                    email: '',
                    password: '',
                    type: '',
                    phone: '',
                    ci: ''
                }),
            }
        },
        methods: {
            createUser(){
                this.$Progress.start();
                this.form.post('api/user')
                    .then(()=>{
                        Fire.$emit('AfterCreate');
                        $('#addNew').modal('hide');
                        // toast shold be here
                        this.$Progress.finish();
                        console.log('OK');
                    })
                    .catch(()=>{
                        this.$Progress.fail();
                        console.log('Fuck');
                    })
            },
            updateUser(){
                this.$Progress.start();
                this.form.put('api/user/'+this.form.id)
                    .then(() => {
                        Fire.$emit('AfterCreate');
                        $('#addNew').modal('hide');
                        // toast should be here
                        this.$Progress.finish();
                    })
                    .catch(() => {
                        this.$Progress.fail();
                    });
            },
            loadUsers(){
                if (this.$gate.isAdmin()) {
                    axios.get("api/user").then(({ data }) => (this.users = data));
                }
            },
            deleteUser(id){
                //
                swal.fire({
                    title: 'Seguro?',
                    text: "Esta acción no puede ser revertida!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Borrar'
                }).then((result) => {

                    //Server API
                    if (result.value) {
                        this.form.delete('api/user/'+id).then(()=>{
                            swal.fire(
                                'Borrado',
                                'El usuario seleccionado ha sido eliminado',
                                'success'
                            )
                            Fire.$emit('AfterCreate');
                        }).catch(()=>{
                            swal("Error", "Algo esta mal :(", "warning");
                        })
                    }
                })
            },
            newModal(){
                this.editMode = false;
                this.form.reset();
                $('#addNew').modal('show');
            },
            editModal(user){
                this.editMode = true;
                this.form.reset();
                $('#addNew').modal('show');
                this.form.fill(user)
            },
            getResults(page = 1) {
                axios.get('api/user?page=' + page)
                    .then(response => {
                        this.users = response.data;
                    });
            },
        },
        created() {
            this.loadUsers();
            Fire.$on('AfterCreate',() => {
                this.loadUsers();
            });
            //setInterval(()=> this.loadUsers(), 3000);
        }
    }
</script>
