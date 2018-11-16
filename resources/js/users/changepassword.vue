<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header pb-0">
                        <div class="card-title">
                            First Time Login
                        </div>
                    </div>
                    <div class="card-body">
                    
                    <form class="text-capitalize" @submit.prevent="updatePassword()">

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label text-right pr-0" for="password">new password</label>
                            <div class="col-sm-9 pl-1">
                                <input type="password" id="password" v-model="form.password" name="password" 
                                class="form-control form-control-sm" placeholder="Optional">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label text-right pr-0" for="password">password confirmation</label>
                            <div class="col-sm-9 pl-1">
                                <input type="password" id="password" v-model="form.password_confirmation" name="password" 
                                class="form-control form-control-sm" placeholder="Optional">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row justify-content-center">
                                <button type="submit" class="btn btn-success" id="update1">Submit</button>
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
                    password: '',
                    password_confirmation: '',
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
