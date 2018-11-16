<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                    <div class="card-title">
                        Account Details
                    </div>
                    <form class="text-capitalize" @submit.prevent="updateProfile()">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label" for="email">email</label>
                            <div class="col-sm-9">
                                <input type="text" id="email" v-model="form.email" name="email" class="form-control form-control-sm">
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label" for="firstname">firstname</label>
                            <div class="col-sm-9">
                                <input type="text" id="firstname" v-model="form.firstname" name="firstname" class="form-control form-control-sm">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label" for="middlename">middlename</label>
                            <div class="col-sm-9">
                                <input type="text" id="middlename" v-model="form.middlename" name="middlename" class="form-control form-control-sm">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label" for="lastname">lastname</label>
                            <div class="col-sm-9">
                                <input type="text" id="lastname" v-model="form.lastname" name="lastname" class="form-control form-control-sm">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label" for="contact">contact</label>
                            <div class="col-sm-9">
                                <input type="text" id="contact" v-model="form.contact" name="contact" class="form-control form-control-sm">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label" for="address">address</label>
                            <div class="col-sm-9">
                                <input type="text" id="address" v-model="form.address" name="address" class="form-control form-control-sm">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label" for="address">city</label>
                            <div class="col-sm-9">
                                <input type="text" id="address" v-model="form.city" name="address" class="form-control form-control-sm">
                            </div>
                        </div>
 
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label" for="address">birthdate</label>
                            <div class="col-sm-9">
                                <input type="date" id="address" v-model="form.birthdate" name="address" class="form-control form-control-sm">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row justify-content-center">
                                <button type="submit" class="btn btn-success">Update</button>
                            </div>
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
        data(){
            return{
               
                form: new Form({
                    id: '',
                    firstname: '',
                    middlename: '',
                    lastname: '',
                    email: '',
                    password: '',
                    contact: '',
                    address: '',
                    city: '', 
                    contact: '',
                    birthdate: '',
                }),
                
            }
        },
        methods:{
            updateProfile(){
                this.$Progress.start();
                
                if(this.form.password == ''){
                    this.form.password = undefined;
                }

                this.form.put('profile/'+this.form.id)
                .then(() => {
                    swal(
                    'Updated!',
                    'Account Profile Updated',
                    'success'
                    )
                    this.$Progress.finish();
                })
                .catch(() => {
                    this.$Progress.fail();
                });
            },
            loadprofile(){
                axios.get("profile").then(({ data }) => (this.form.fill(data)));
                
            }
        },
        created() {
            this.loadprofile();
            Fire.$on('success',() => {
                this.loadprofile();
            });
        },
    }
</script>
