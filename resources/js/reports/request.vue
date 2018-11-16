<template>
    <div class="container">

                    <div class="card-body">
                        <table class="table table-responsive-sm table-hover">
                            <thead>
                                <th>ID</th>
                                <th>Firstname</th>
                                <th>Lastname</th>
                                <th>Received At</th>
                                
                            </thead>
                            <tbody>
                                <tr v-for="al in approvedlists.data" :key="al.id" class="text-capitalize">
                                    <td>{{ al.id }}</td>
                                    <td>{{ al.recipient.user.firstname }}</td>
                                    <td>{{ al.recipient.user.lastname }}</td>
                                    <td>{{ al.updated_at }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
    </div>
</template>

<script>
    export default {
        data (){
            return{
                requestings :{},
                approvedlists :{},

                form: new Form({
                    month: '',
                    year: '',
                }),
                
                milkrequests: [],
                months: [
                    {id : 1, text: 'january'},
                    {id : 2, text: 'febuary'},
                    {id : 3, text: 'march'},
                    {id : 4, text: 'april'},
                    {id : 5, text: 'may'},
                    {id : 6, text: 'june'},
                    {id : 7, text: 'july'},
                    {id : 8, text: 'august'},
                    {id : 9, text: 'september'},
                    {id : 10, text: 'october'},
                    {id : 11, text: 'november'},
                    {id : 12, text: 'december'},
                ],
                years: [
                    { id: 1, text: "2018"},
                    { id: 2, text: "2019"},
                    { id: 3, text: "2020"},
                    { id: 4, text: "2021"},
                    { id: 5, text: "2022"},
                    { id: 6, text: "2023"},
                    { id: 7, text: "2024"},
                    { id: 8, text: "2025"},
                    { id: 9, text: "2026"},
                    { id: 10, text: "2027"},
                    { id: 11, text: "2028"},
                    { id: 12, text: "2029"},
                ],
            }
        },
        methods: {  
            getResults(page = 1) {
                axios.get('api/requesting?page=' + page)
                    .then(response => {
                        this.requestings = response.data;
                    });
            },

            getResults2(page = 1) {
                axios.get('api/rapprovedlist?page=' + page)
                    .then(response => {
                        this.approvedlist = response.data;
                    });
            },

            loadmilkrequest(){
                axios.get('api/displaymilkrequest').then(({ data }) => {
                    this.milkrequests = data.data
                }).catch(() => {

                });
            },
            loaddata(){
                axios.get('api/requesting').then(({ data }) => (this.requestings = data ));
            },

            loadapprovedlist(){
                axios.get('api/rapprovedlist').then(({ data }) => (this.approvedlists = data ));
            },
            postrequestpdf(){
                this.$Progress.start();
                this.form.post('postrequestpdf').then(() => {
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
            excel(){
                axios.get('api/excelmilkrequest').then(() => {
                }).catch(() => {
                    
                });
            }
        },
        created () {

        }
    }
</script>


