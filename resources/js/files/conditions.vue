<template>
    <div class="container">
        
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Medical Conditions</h3>
                        <div class="card-tools">
                            <button class="btn add-btn" @click="newmodal">Add New</button>
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
                                                <th>Name</th>
                                                <th>Type</th>
                                                <th>Added At</th>
                                                <th>Modify</th>
                                            </thead>
                                            <tbody>
                                                <tr v-for="condition in conditions.data" :key="condition.id" class="text-capitalize">
                                                    <td>{{ condition.id }}</td>
                                                    <td>{{ condition.name }}</td>
                                                    <td>{{ condition.type }}</td>
                                                    <td>
                                                        <p v-if="condition.created_at === null"></p>
                                                        <p v-else>{{ condition.created_at | myDate }}</p>
                                                    </td>
                                                    <td>
                                                        <button type="button" class="btn btn-sm btn-primary" @click="editmodal(condition)" data-toggle="tooltip" data-placement="top" title="Edit">               
                                                                <i class="fa fa-edit"></i>
                                                            </button>
                                                            <button type="button" class="btn btn-sm btn-danger" @click="archivecondition(condition.id)" data-toggle="tooltip" data-placement="top" title="Archive">
                                                                <i class="fa fa-trash"></i>
                                                            </button>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="card-footer">
                                        <pagination :data="conditions" @pagination-change-page="getResults">
                                        </pagination>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="archives" role="tabpanel" aria-labelledby="archives-tab">
                                <div class="card mx-2 my-2">
                                    <div class="card-body">
                                        <table class="table table-responsive-sm table-hover">
                                            <thead>
                                                <th>ID</th>
                                                <th>Name</th>
                                                <th>Type</th>
                                                <th>Added At</th>
                                                <th>Modify</th>
                                            </thead>
                                            <tbody>
                                                <tr v-for="archive in archives.data" :key="archive.id" class="text-capitalize">
                                                    <td>{{ archive.id }}</td>
                                                    <td>{{ archive.name }}</td>
                                                    <td>{{ archive.type }}</td>
                                                    <td>
                                                        <p v-if="archive.created_at === null"></p>
                                                        <p v-else>{{ archive.created_at | myDate }}</p>
                                                    </td>
                                                    <td>
                                                        <button type="button" class="btn btn-sm btn-success" @click="restorecondition(archive.id)" data-toggle="tooltip" data-placement="top" title="Restore">               
                                                            <i class="fas fa-window-restore"></i>
                                                        </button>

                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="card-footer">
                                        <pagination :data="archives" @pagination-change-page="getResults2">
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
            <div class="modal fade" id="conditionmodal" tabindex="-1" role="dialog" aria-labelledby="addmodalLabel" aria-hidden="true">
                <div class="modal-dialog  modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 v-show="!editmode" class="modal-title" id="addmodalLabel">Add new</h5>
                            <h5 v-show="editmode" class="modal-title" id="addmodalLabel">Update User's Info</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form @submit.prevent="editmode ? updatecondition() : createcondition()">
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="name">Condition</label>
                                    <input v-model="form.name" type="text" name="name" 
                                        placeholder="Condition"
                                            class="form-control" :class="{ 'is-invalid': form.errors.has('name') }" required>
                                    <has-error :form="form" field="name"></has-error>
                                </div>
                                <div class="form-group">
                                    <label for="name">Selected?</label>
                                    <select v-model="form.type" placeholder="type" class="form-control" 
                                    :class="{ 'is-invalid': form.errors.has('type') }" required>
                                        <option value="disease">Disease</option>
                                        <option value="disorder">Disorder</option>
                                    </select>
                                    <has-error :form="form" field="type"></has-error>
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
                conditions :{},
                archives: {},
                form: new Form({
                    id: '',
                    name: '',
                    type: '',
                })
            }
        },
        methods: {
            getResults(page = 1) {
                axios.get('api/condition?page=' + page)
                    .then(response => {
                        this.conditions = response.data;
                    });
            },
            getResults2(page = 1) {
                axios.get('api/conditionarchives?page=' + page)
                    .then(response => {
                        this.conditionsarchives = response.data;
                    });
            },
            loaddata(){
                axios.get('api/condition').then(({ data }) => (this.conditions = data ));
            },
            loadarchiveds(){
                axios.get('api/conditionarchives').then(({ data }) => (this.archives = data ));
            },
            newmodal(){
                this.editmode = false;
                this.form.reset();
                $('#conditionmodal').modal('show');
            },
            editmodal(condition){
                this.editmode = true;
                this.form.reset();
                $('#conditionmodal').modal('show');
                this.form.fill(condition);
            },
            createcondition() {
                this.$Progress.start();
                this.form.post('api/condition').then(() => {
                    Fire.$emit('success');
                    $('#conditionmodal').modal('hide');
                        toast({
                            type: 'success',
                            title: 'Condition Created in Successfully'
                        });
                    this.$Progress.finish();
                }).catch(() =>{
                    this.$Progress.fail();
                })
            },
            updatecondition(id) {
                this.$Progress.start();
                this.form.put('api/condition/'+this.form.id).then(() => {
                    Fire.$emit('success');
                    $('#conditionmodal').modal('hide');
                        toast({
                            type: 'success',
                            title: 'Condition Created in Successfully'
                        });
                    this.$Progress.finish();
                }).catch(() =>{
                    this.$Progress.fail();
                })
            },
            archivecondition(id) {
                swal({
                title: 'Are you sure?',

                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    //Send request to the server
                    if (result.value){
                        this.form.delete('api/condition/'+id).then(()=>{
                            swal(
                                'Archived!',
                                'Condition has been archived.',
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
            restorecondition(id){
                swal({
                title: 'Are you sure?',

                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    //Send request to the server
                    if (result.value){
                        axios.get('api/conditionrestore/'+id).then(()=>{
                            swal(
                                'Restored!',
                                'Condition has been restore.',
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
            loadall(){
                this.loaddata();
                this.loadarchiveds();
            },
        },
        created() {
                this.loadall();
            Fire.$on('success',() => {
                this.loadall();
                
            });
        }
    }
</script>
