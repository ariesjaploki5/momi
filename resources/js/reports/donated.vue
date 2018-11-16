<template>
    <div class="container">

                    <div class="card-body">
                        <table class="table table-responsive-sm table-hover">
                            <thead>
                                <th>ID</th>
                                <th>Donor's Name</th>
                                <th></th>
                                
                            </thead>
                            <tbody>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
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
                donated :{},


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
                        this.donated = response.data;
                    });
            },




            loaddata(){
                axios.get('api/requesting').then(({ data }) => (this.donated = data ));
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


        },
        created () {
            this.loaddata();
        }
    }
</script>


