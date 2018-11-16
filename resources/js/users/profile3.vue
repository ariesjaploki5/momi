<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header pb-0">
                        <div class="card-title">
                            Account Details
                        </div>
                    </div>
                    <div class="card-body">
                    
                    <form class="text-capitalize" @submit.prevent="updateProfile()">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label text-right pr-0" for="email">email</label>
                            <div class="col-sm-9 pl-1">
                                <input type="text" id="email" v-model="form.email" name="email" 
                                class="form-control form-control-sm" :class="{ 'is-invalid': form.errors.has('email') }">
                                    <has-error :form="form" field="email"></has-error>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label text-right pr-0" for="password">password</label>
                            <div class="col-sm-9 pl-1">
                                <input type="password" id="password" v-model="form.password" name="password" class="form-control form-control-sm" placeholder="Optional">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row justify-content-center">
                                <button type="submit" class="btn btn-success" id="update1">Update</button>
                            </div>
                        </div>
                    </form>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header pb-0">
                        <div class="card-title">
                            Profile Details
                        </div>
                    </div>
                    <div class="card-body">
                        <form class="text-capitalize" @submit.prevent="updateProfile2()">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label text-right pr-0" for="firstname">firstname</label>
                                <div class="col-sm-9 pl-1">
                                    <input type="text" id="firstname" v-model="formtwo.firstname" name="firstname" 
                                    class="form-control form-control-sm" :class="{ 'is-invalid': formtwo.errors.has('firstname') }">
                                    <has-error :form="formtwo" field="firstname"></has-error>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label text-right pr-0" for="middlename">middlename</label>
                                <div class="col-sm-9 pl-1">
                                    <input type="text" id="middlename" v-model="formtwo.middlename" name="middlename" 
                                    class="form-control form-control-sm" :class="{ 'is-invalid': formtwo.errors.has('middlename') }">
                                    <has-error :form="formtwo" field="middlename"></has-error>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label text-right pr-0" for="lastname">lastname</label>
                                <div class="col-sm-9 pl-1">
                                    <input type="text" id="lastname" v-model="formtwo.lastname" name="lastname" 
                                    class="form-control form-control-sm" :class="{ 'is-invalid': formtwo.errors.has('lastname') }">
                                    <has-error :form="formtwo" field="lastname"></has-error>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label text-right pr-0" for="contact">contact</label>
                                <div class="col-sm-9 pl-1">
                                    <input type="text" id="contact" v-model="formtwo.contact" name="contact" 
                                    class="form-control form-control-sm" :class="{ 'is-invalid': formtwo.errors.has('contact') }">
                                    <has-error :form="formtwo" field="contact"></has-error>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label text-right pr-0" for="address">address</label>
                                <div class="col-sm-9 pl-1">
                                    <input type="text" id="address" v-model="formtwo.address" name="address" 
                                    class="form-control form-control-sm" :class="{ 'is-invalid': formtwo.errors.has('address') }">
                                    <has-error :form="formtwo" field="address"></has-error>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label text-right pr-0" for="city">city</label>
                                <div class="col-sm-9 pl-1">
                                    <input type="text" id="city" v-model="formtwo.city" name="city" 
                                    class="form-control form-control-sm" :class="{ 'is-invalid': formtwo.errors.has('city') }">
                                    <has-error :form="formtwo" field="city"></has-error>
                                </div>
                            </div>
    
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label text-right pr-0" for="birthdate">birthdate</label>
                                <div class="col-sm-9 pl-1">
                                    <input type="date" id="birthdate" v-model="formtwo.birthdate" name="birthdate" 
                                    class="form-control form-control-sm" :class="{ 'is-invalid': formtwo.errors.has('birthdate') }">
                                    <has-error :form="formtwo" field="birthdate"></has-error>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row justify-content-center">
                                    <button type="submit" class="btn btn-success" id="update2">Update</button>
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
                formtwo: new Form({
                    id: '',
                    firstname: '',
                    middlename: '',
                    lastname: '',
                    contact: '',
                    address: '',
                    city: '', 
                    contact: '',
                    birthdate: '',
                }),
                
                form: new Form({
                    id: '',
                    email: '',
                    password: '',

                }),

                
                
            }
        },
        methods:{
            updateProfile(){
                this.$Progress.start();
                
                if(this.form.password == ''){
                    this.form.password = undefined;
                }

                this.form.put('api/profile/'+this.form.id)
                .then(() => {
                    swal(
                    'Updated!',
                    'Account Updated',
                    'success'
                    )
                    this.$Progress.finish();
                })
                .catch(() => {
                    this.$Progress.fail();
                });
            },
            updateProfile2(){
                this.$Progress.start();
                this.formtwo.put('api/profile2/'+this.formtwo.id)
                .then(() => {
                    swal(
                    'Updated!',
                    'Profile Updated',
                    'success'
                    )
                    this.$Progress.finish();
                })
                .catch(() => {
                    this.$Progress.fail();
                });
            },
            loadaccount(){
                axios.get("profile").then(({ data }) => (this.form.fill(data)));
            },
            loadprofile(){
                axios.get("profile").then(({ data }) => (this.formtwo.fill(data)));
            }
        },
        created() {
            this.loadprofile();
            this.loadaccount();
        }
    }
</script>
