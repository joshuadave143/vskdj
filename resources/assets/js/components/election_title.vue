<template>

    <form @submit.prevent="config">
        <div class="modal fade" id="ElectionTittle" tabindex="-1" role="basic" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                        <h4 class="modal-title" id="candiName">Configure</h4>
                    </div>
                    <div class="modal-body">
                        
                            <div class="form-group">
                                <label for="title" class="col-sm-3 control-label">Title</label>

                                <div class="col-sm-9">
                                <input type="text" v-model="title.name" class="form-control" id="title" name="title">
                                </div>
                            </div>                    
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Save</button>
                        
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
    </form>
</template>
<script>
export default {
    data(){
        return{
            title:{
                name:''
            }
        }
    },
    created(){
        this.fetchconfig();
    },
    methods:{
        fetchconfig(){
            var currentUrl = window.location.pathname;
            var back = "";
            for(var i = 0; i < currentUrl.split('/').length-2;i++){
                back +="../";
            }
            fetch(back+'api/getconfig')
            .then(res => res.json())
            .then(res => {
               
                this.title.name = res
                //  console.log(this.title.name);
            })
            .catch(err =>  this.$toastr.e(err));
        },
        config(){
            let vm = this;
            fetch('../api/election_config', {
                method: 'put',
                body: JSON.stringify(this.title),
                headers:{
                    'Content-Type': 'application/json'
                }
            })
            .then(res => res.json())
            .then(data => {
                // console.log(data)
                this.title.name = '';
                $("#ElectionTittle").click()
                this.$toastr.s('Election Tittle has been save!');
                this.fetchconfig();

            })
            .catch(err => this.$toastr.e(err))
            
        }
    }
 
}
</script>
