<template>
    <div class="container">
        
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">staffs</h3>

                        <div class="card-tools">
                        
                        <button class="btn btn-success" @click="newmodal">Add New <i class="fas fa-user-plus fa-fw"></i></button>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <table class="table table-responsive-sm table-hover">
                            <tbody>
                                <tr>
                                    <th>ID</th>
                                    <th>Firstname</th>
                                    <th>Middlename</th>
                                    <th>Lastname</th>
                                    <th>Email</th>
                                    <th>Access Level</th>
                                    <th>Registered At</th>
                                    <th>Action</th>
                                </tr>
                                <tr v-for="s in staffs" :key="s.id" class="text-capitalize">
                                    <td>{{ staff.id }}</td>
                                    <td>{{ staff.firstname }}</td>
                                    <td>{{ staff.middlename }}</td>
                                    <td>{{ staff.lastname }}</td>
                                    <td>{{ staff.email }}</td>
                                    <td>{{ staff.type | capText }}</td>
                                    <td>{{ staff.created_at | myDate }}</td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-primary" @click="editmodal(staff)" >               
                                            <i class="fa fa-edit"></i>
                                        </button>
                                        
                                        <button type="button" class="btn btn-sm btn-danger" @click="deletestaff(staff.id)">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div><!--  row -->

        <div class="row">
            <div class="modal fade" id="staffmodal" tabindex="-1" role="dialog" aria-labelledby="addmodalLabel" aria-hidden="true">
                <div class="modal-dialog  modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 v-show="!editmode" class="modal-title" id="addmodalLabel">Add new</h5>
                            <h5 v-show="editmode" class="modal-title" id="addmodalLabel">Update User's Info</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form @submit.prevent="editmode ? updatestaff() : createstaff()">
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
                                <button v-show="!editmode" type="submit" class="btn btn-primary">Create</button>
                                <button v-show="editmode" type="submit" class="btn btn-success">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div><!--  row -->
    </div>
</template>
<script>
    export default {
        data() {
            return{
                editmode: false,
                staff :[],
                form: new Form({
                    id: '',
                    email: '',
                    password: '',

                    firstname: '',
                    middlename: '',
                    lastname: '',
                })
            }
        },
        methods: {
            loaddata(){
                axios.get('api/staff').then(({ data }) => (this.staff = data ));
            },

            newmodal(){
                this.editmode = false;
                this.form.reset();
                $('#staffmodal').modal('show');
            },

            editmodal(staff){
                this.editmode = true;
                this.form.reset();
                $('#staffmodal').modal('show');
                this.form.fill(staff);
            },

            createstaff() {
                this.$Progress.start();
                this.form.post('api/staff').then(() => {
                    Fire.$emit('success');
                    $('#staffmodal').modal('hide');
                    toast({
                        type: 'success',
                        title: 'staff Created in Successfully'
                    });
                    this.$Progress.finish();
                }).catch(() =>{
                    this.$Progress.fail();
                })
            },

            updatestaff(id) {
                this.$Progress.start();
                this.form.post('api/staff'+id).then(() => {
                    Fire.$emit('success');
                    $('#staffmodal').modal('hide');
                    toast({
                        type: 'success',
                        title: 'Staff Created in Successfully'
                    });
                    this.$Progress.finish();
                }).catch(() =>{
                    this.$Progress.fail();
                })
            },

            deletestaff(id) {
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
                        this.form.delete('api/staff/'+id).then(()=>{
                            swal(
                            'Deleted!',
                            'Staff has been deleted.',
                            'success'
                            )
                            Fire.$emit('success');
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

        },
        created() {
            this.loaddata();
            Fire.$on('success',() => {
                this.loaddata();
            });
        }
    }
</script>
