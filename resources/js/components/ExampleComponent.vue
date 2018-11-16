<template>
    <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="card mt-3">
              <div class="card-header">
                <h3 class="card-title">Administrators</h3>

                <div class="card-tools">
                  <button class="btn btn-success" @click="newModal">Add New <i class="fas fa-user-plus fa-fw"></i></button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover">
                  <tbody>
                      <tr>
                        <th>ID</th>
                        <th>Firstname</th>
                        <th>Middlename</th>
                        <th>Lastname</th>
                        <th>Email</th>
                        <th>Access Level</th>
                        <th>Registered At</th>
                        <th>Modify</th>
                    </tr>
                    <tr v-for="admin in admins" :key="admin.id">
                        <td>{{ admin.id }}</td>
                        <td>{{ admin.firstname }}</td>
                        <td>{{ admin.middlename }}</td>
                        <td>{{ admin.lastname }}</td>
                        <td>{{ admin.email }}</td>
                        <td>{{ admin.access_level | capText }}</td>
                        <td>{{ admin.created_at | myDate }}</td>
                        <td>
                            <button type="button" class="btn btn-sm btn-primary"  @click="editModal(admin)" >               
                                <i class="fa fa-edit"></i>
                            </button>
                            /
                            <button type="button" class="btn btn-sm btn-danger"   @click="deleteAdmin(admin.id)">
                                <i class="fa fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                    </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
        <!-- Modal -->
        <div class="row">
            <div class="modal fade" id="addNew" tabindex="-1" role="dialog" aria-labelledby="addmodalLabel" aria-hidden="true">
            <div class="modal-dialog  modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 v-show="!editMode" class="modal-title" id="addmodalLabel">Add new</h5>
                        <h5 v-show="editMode" class="modal-title" id="addmodalLabel">Update User's Info</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form @submit.prevent="editMode ? updateAdmin() : createAdmin()">
                        <div class="modal-body">


                            <div class="form-group">
                                <input v-model="form.firstname" type="text" name="firstname" 
                                    placeholder="Firstname"
                                        class="form-control" :class="{ 'is-invalid': form.errors.has('firstname') }">
                                <has-error :form="form" field="firstname"></has-error>
                            </div>
                            <div class="form-group">
                                <input v-model="form.middlename" type="text" name="middlename" 
                                    placeholder="Middlename"
                                        class="form-control" :class="{ 'is-invalid': form.errors.has('middlename') }">
                                <has-error :form="form" field="middlename"></has-error>
                            </div>
                            <div class="form-group">
                                <input v-model="form.lastname" type="text" name="lastname" 
                                    placeholder="Lastname"
                                        class="form-control" :class="{ 'is-invalid': form.errors.has('lastname') }">
                                <has-error :form="form" field="lastname"></has-error>
                            </div>
                            <div class="form-group">
                                <input v-model="form.email" type="text" name="email" 
                                    placeholder="Email Address"
                                        class="form-control" :class="{ 'is-invalid': form.errors.has('email') }">
                                <has-error :form="form" field="email"></has-error>
                            </div>

                            <div class="form-group">
                                <input v-model="form.password" type="password" name="password" id="password"
                                    placeholder="Password"
                                        class="form-control" :class="{ 'is-invalid': form.errors.has('password') }">
                                <has-error :form="form" field="password"></has-error>
                            </div>
                            

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            <button v-show="!editMode" type="submit" class="btn btn-primary">Create</button>
                            <button v-show="editMode" type="submit" class="btn btn-success">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        </div>
    </div>
</template>


<script>
    export default {
        data() {
            return{
                editMode: false,
                admins: [],
                form: new Form({
                    id: '',
                    firstname: '',
                    middlename: '',
                    lastname: '',
                    email: '',
                    password: '',
                })
            }
        },
        methods: {
        updateAdmin(id){
            this.$Progress.start();
            this.form.put('api/admin/'+this.form.id)
            .then(() => {
                //success
                swal(
                'Updated!',
                'Information has been updated.',
                'success'
                )
                $('#addNew').modal('hide');
                this.$Progress.finish();
                Fire.$emit('Success');
            })
            .catch(() => {
                this.$Progress.fail();
            });
            // console.log('Editing data');
        },
        editModal(admin){
            this.editMode = true;
            this.form.reset();
            $('#addNew').modal('show');
          
            this.form.fill(admin);
        },
        newModal(){
            this.editMode = false;
            this.form.reset();
            $('#addNew').modal('show');
        },
        deleteAdmin(id){
            swal({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    //Send request to the server
                    if (result.value){
                        this.form.delete('api/admin/'+id).then(()=>{
                            swal(
                            'Deleted!',
                            'Admin has been deleted.',
                            'success'
                            )
                            Fire.$emit('Success');
                    }).catch(()=>{
                        swal(
                        'Failed!',
                        'There was something wrong',
                        'warning'
                        )
                    });
                    }
                    
                })
        },
        loadAdmins() {
            axios.get("api/admin")
                .then(({ data }) => (this.admins = data.data));
        },
        createAdmin() {
            // progress-bar seen when validating creation of admin
            // in starting process
            this.$Progress.start();
            // Submit the form via a POST request
            this.form.post('api/admin').then(()=>{
                // update after creating admin
                Fire.$emit('Success');
                // hide creating admin modal
                $('#addNew').modal('hide');
                // toasting msge
                toast({
                    type: 'success',
                    title: 'Admin Created in successfully'
                });
                // end of progressbar
                this.$Progress.finish();
            })
            .catch(()=>{

            })
        }
      
    },
    created() {
        this.loadAdmins();
            Fire.$on('Success',() => {
                this.loadAdmins();
            });
        }﻿
    }
</script>
