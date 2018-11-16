<template>
    <div class="container">
        
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Nurses</h3>
                        <div class="card-tools">
                            <button class="btn add-btn" @click="newmodal">Add New <i class="fas fa-user-plus fa-fw"></i></button>
                        </div>
                    </div>
                    <div class="card-body p-0 mx-2 my-2">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="active-tab" data-toggle="tab" href="#active" role="tab" aria-controls="active" aria-selected="true">Active</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="archives-tab" data-toggle="tab" href="#archives" role="tab" aria-controls="archives" aria-selected="false">Archives</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="active" role="tabpanel" aria-labelledby="active-tab">
                                <div class="card mx-2 my-2">
                                    <div class="card-body">
                                        <table class="table table-responsive-sm table-hover">
                                            <thead>
                                                <th>ID</th>
                                                <th>Firstname</th>
                                                <th>Middlename</th>
                                                <th>Lastname</th>
                                                <th>Email</th>
                                                <th>Registered At</th>
                                                <th>Action</th>
                                            </thead>
                                            <tbody>
                                                <tr v-for="nurse in nurses.data" :key="nurse.id">
                                                    <td>{{ nurse.id }}</td>
                                                    <td class="text-capitalize">{{ nurse.firstname }}</td>
                                                    <td class="text-capitalize">{{ nurse.middlename }}</td>
                                                    <td class="text-capitalize">{{ nurse.lastname }}</td>
                                                    <td>{{ nurse.email }}</td>
                                                    <td>{{ nurse.created_at | myDate }}</td>
                                                    <td>
                                                        <button type="button" class="btn btn-sm btn-primary" @click="editmodal(nurse)" >               
                                                            <i class="fa fa-edit"></i>
                                                            Edit
                                                        </button>
                                                        <button type="button" class="btn btn-sm btn-danger" @click="archivenurse(nurse.id)">               
                                                            <i class="fas fa-trash"></i>
                                                            Delete
                                                        </button>
                                                        <!-- <button type="button" class="btn btn-sm btn-warning" @click="archivenurse(nurse.id)">
                                                            <i class="fa fa-trash"></i>
                                                            Archive
                                                        </button> -->
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="card-footer">
                                        <pagination :data="nurses" @pagination-change-page="getResults">
                                        </pagination>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    
                </div>
            </div>
        </div><!--  row -->
        <div class="row">
            <div class="modal fade" id="nursemodal" tabindex="-1" role="dialog" aria-labelledby="addmodalLabel" aria-hidden="true">
                <div class="modal-dialog  modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 v-show="!editmode" class="modal-title" id="addmodalLabel">Add new</h5>
                            <h5 v-show="editmode" class="modal-title" id="addmodalLabel">Update User's Info</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form @submit.prevent="editmode ? updatenurse() : createnurse()">
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
                nurses :{},
                archives: {},
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
            getResults(page = 1) {
                axios.get('api/nurse?page=' + page)
                    .then(response => {
                        this.nurses = response.data;
                    });
            },
            getResults2(page = 1) {
                axios.get('api/nursearchives?page=' + page)
                    .then(response => {
                        this.nursesarchives = response.data;
                    });
            },
            loaddata(){
                axios.get('api/nurse').then(({ data }) => (this.nurses = data ));
            },
            loadarchiveds(){
                axios.get('api/nursearchives').then(({ data }) => (this.archives = data ));
            },
            newmodal(){
                this.editmode = false;
                this.form.reset();
                $('#nursemodal').modal('show');
            },
            editmodal(nurse){
                this.editmode = true;
                this.form.reset();
                $('#nursemodal').modal('show');
                this.form.fill(nurse);
            },
            createnurse() {
                this.$Progress.start();
                this.form.post('api/nurse').then(() => {
                    Fire.$emit('success');
                    $('#nursemodal').modal('hide');
                        toast({
                            type: 'success',
                            title: 'nurse Created in Successfully'
                        });
                    this.$Progress.finish();
                }).catch(() =>{
                    this.$Progress.fail();
                })
            },
            updatenurse(id) {
                this.$Progress.start();
                this.form.put('api/nurse/'+this.form.id).then(() => {
                    Fire.$emit('success');
                    $('#nursemodal').modal('hide');
                        toast({
                            type: 'success',
                            title: 'nurse Created in Successfully'
                        });
                    this.$Progress.finish();
                }).catch(() =>{
                    this.$Progress.fail();
                })
            },
            archivenurse(id) {
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
                        this.form.delete('api/nurse/'+id).then(()=>{
                            swal(
                                'Deleted!',
                                'Nurse has been deleted.',
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
            restorenurse(id){
                swal({
                title: 'Are you sure?',

                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, restore it!'
                }).then((result) => {
                    //Send request to the server
                    if (result.value){
                        axios.get('api/nurserestore/'+id).then(()=>{
                            swal(
                                'Restored!',
                                'Nurse Account has been restore',
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
            forcedeletenurse(id){
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
                        axios.get('api/nurseforcedelete/'+id).then(()=>{
                            swal(
                                'Deleted!',
                                'Nurse account has been deleted',
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
            this.loadarchiveds();
            Fire.$on('success',() => {
                this.loaddata();
                this.loadarchiveds();
            });
        }
    }
</script>
