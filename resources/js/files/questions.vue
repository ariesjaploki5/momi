<template>
    <div class="container">
        
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Screening Questions</h3>
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
                                                <th width="65%">Text</th>
                                                <th>Selected</th>
                                                <th>Added At</th>
                                                <th>Action</th>
                                            </thead>
                                            <tbody>
                                                <tr v-for="question in questions.data" :key="question.id" class="text-capitalize">
                                                    <td>{{ question.id }}</td>
                                                    <td>{{ question.text }}</td>
                                                    <td>
                                                       <p v-if="question.selected == 1">Yes</p>
                                                       <p v-else>No</p>
                                                    </td>
                                                    <td>{{ question.created_at | myDate }}</td>
                                                    <td>
                                                        
                                                            <button type="button" class="btn btn-sm btn-primary" @click="editmodal(question)" data-toggle="tooltip" data-placement="top" title="Edit">               
                                                                <i class="fa fa-edit"></i>
                                                                
                                                            </button>
                                                            <button type="button" class="btn btn-sm btn-danger" @click="archivequestion(question.id)" data-toggle="tooltip" data-placement="top" title="Archive">
                                                                <i class="fa fa-trash"></i>
                                                            </button>
                                                        
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="card-footer">
                                        <pagination :data="questions" @pagination-change-page="getResults">
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
                                                <th width="65%">Text</th>
                                                <th>Selected</th>
                                                <th>Added At</th>
                                                <th>Action</th>
                                            </thead>
                                            <tbody>
                                                <tr v-for="archive in archives.data" :key="archive.id" class="text-capitalize">
                                                    <td>{{ archive.id }}</td>
                                                    <td>{{ archive.text }}</td>
                                                    <td>
                                                       <p v-if="archive.selected == 1">Yes</p>
                                                       <p v-else>No</p>
                                                    
                                                    </td>
                                                    <td>{{ archive.created_at | myDate }}</td>
                                                    <td>
                                                        <button type="button" class="btn btn-sm btn-success" @click="restorequestion(archive.id)" data-toggle="tooltip" data-placement="top" title="Restore">               
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
        </div>
        <div class="row">
            <div class="modal fade" id="questionmodal" tabindex="-1" role="dialog" aria-labelledby="addmodalLabel" aria-hidden="true">
                <div class="modal-dialog  modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 v-show="!editmode" class="modal-title" id="addmodalLabel">Add New Question</h5>
                            <h5 v-show="editmode" class="modal-title" id="addmodalLabel">Update Question</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form @submit.prevent="editmode ? updatequestion() : createquestion()">
                            <div class="modal-body">
                                <div class="form-group">
                                    <textarea v-model="form.text" row="7" class="form-control" :class="{ 'is-invalid': form.errors.has('text') }">
                                    </textarea>
                                    <has-error :form="form" field="text"></has-error>
                                </div>
                                <div class="form-group">
                                    <select v-model="form.selected" name="selected" class="form-control" :class="{ 'is-invalid': form.errors.has('selected') }">
                                        <option value="0">no</option>
                                        <option value="1">yes</option>
                                    </select>
                                    <has-error :form="form" field="selected"></has-error>
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
        </div>
    </div>
   
</template>
<script>
    export default {
        data() {
            return{
                editmode: false,
                questions :{},
                archives: {},
                form: new Form({
                    id: '',
                    text: '',
                    selected: '',
                })
            }
        },
        methods: {
            getResults(page = 1) {
                axios.get('api/question?page=' + page)
                    .then(response => {
                        this.questions = response.data;
                    });
            },
            getResults2(page = 1) {
                axios.get('api/questionarchives?page=' + page)
                    .then(response => {
                        this.questionsarchives = response.data;
                    });
            },
            loaddata(){
                axios.get('api/question').then(({ data }) => (this.questions = data ));
            },
            loadarchiveds(){
                axios.get('api/questionarchives').then(({ data }) => (this.archives = data ));
            },
            newmodal(){
                this.editmode = false;
                this.form.reset();
                $('#questionmodal').modal('show');
            },
            editmodal(question){
                this.editmode = true;
                this.form.reset();
                $('#questionmodal').modal('show');
                this.form.fill(question);
            },
            createquestion() {
                this.$Progress.start();
                this.form.post('api/question').then(() => {
                    Fire.$emit('success');
                    $('#questionmodal').modal('hide');
                        toast({
                            type: 'success',
                            title: 'Question Created in Successfully'
                        });
                    this.$Progress.finish();
                }).catch(() =>{
                    this.$Progress.fail();
                })
            },
            updatequestion(id) {
                this.$Progress.start();
                this.form.put('api/question/'+this.form.id).then(() => {
                    Fire.$emit('success');
                    $('#questionmodal').modal('hide');
                        toast({
                            type: 'success',
                            title: 'Question Created in Successfully'
                        });
                    this.$Progress.finish();
                }).catch(() =>{
                    this.$Progress.fail();
                })
            },
            archivequestion(id) {
                swal({
                title: 'Are you sure?',

                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, archive it!'
                }).then((result) => {
                    //Send request to the server
                    if (result.value){
                        this.form.delete('api/question/'+id).then(()=>{
                            swal(
                                'Archived!',
                                'Question has been archived.',
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
            
            restorequestion(id){
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
                        axios.get('api/questionrestore/'+id).then(()=>{
                            swal(
                                'Restored!',
                                'Question has been restore.',
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
