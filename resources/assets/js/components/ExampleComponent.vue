
    <template slot="actions" scope="props">
        <div class="table-button-container">
            <button class="btn btn-warning btn-sm" @click="editRow(props.rowData)">
            <span class="glyphicon glyphicon-pencil"></span> Edit</button>&nbsp;&nbsp;
            <button class="btn btn-danger btn-sm" @click="deleteRow(props.rowData)">
            <span class="glyphicon glyphicon-trash"></span> Delete</button>&nbsp;&nbsp;
        </div>
    </template>

<script>
        
    import ServerDatasource from 'vue-datasource';
    export default {
        components: {
            ServerDatasource
        },
        data(){
            return {
                columns:[
                    {
                        name: 'Name', // Table column name to display
                        key: 'name', // Key name from row object
                    }
                ],
                actions: [
                    {
                        text: 'Click me', // Button label
                        icon: 'glyphicon glyphicon-check', // Button icon
                        class: 'btn-primary', // Button class (background color)
                        show(selectedRow) { // Event to define a condition to display the button with the selected row
                            return true
                        },
                        event(e, row) { // Event handler callback. Gets event instace and selected row
                            console.log('Click row: ', row); // If no row is selected, row will be NULL
                        }
                    }
                ]
            }
        },
        // created(){
        //     $.ajax({
        //         url: '../api/voters',
        //         success(res) {
                    
        //             this.voters = res.data;
        //             console.log(this.voters)
        //         }
        //     });
        //},
            computed:{
            /*httpOptions(){
                return {headers: {'Authorization': "my-token"}} //table props -> :http-options="httpOptions"
            },*/
            },
            methods: {
                onPaginationData (paginationData) {
                this.$refs.pagination.setPaginationData(paginationData)
                },
                onChangePage (page) {
                this.$refs.vuetable.changePage(page)
                },
                editRow(rowData){
                alert("You clicked edit on"+ JSON.stringify(rowData))
                },
                deleteRow(rowData){
                alert("You clicked delete on"+ JSON.stringify(rowData))
                },
                onLoading() {
                console.log('loading... show your spinner here')
                },
                onLoaded() {
                console.log('loaded! .. hide your spinner here')
                }
            }
        // methods:{
            
        //     close(){
        //         this.edit = false;
        //         this.voter.voter_id = '';
        //         this.voter.student_id = '';
        //         this.voter.name = '';
        //         this.voter.course ='';
        //     },
        //     newForm(){
        //         this.close();
        //     }
        // }
        
    }
</script>