<template>
    <div class="portlet box blue">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-edit"></i>Votes Table
                    </div>
                    <div class="tools">
						<a href="javascript:;" @click="truncate()" class="reload"></a>
					</div>
                </div>
                <div class="portlet-body">
                    
                    <table ref="votes" class="table table-striped table-bordered table-hover" id="votes">
                        <thead>
                            <tr>
                                <th>Position</th>
                                <th>Candidate</th>
                                <th>Voter</th>
                            </tr>
                        </thead>
                    </table>
                    <data-table :votes="filteredVotes"></data-table>   
                </div>
    </div>
</template>

<script> 
    import DataTable from './DataTable.vue'
    export default {
        components:{
            DataTable
        },
        data(){
            return {
                votes: []
            }
        },
        computed: {
            filteredVotes: function () {
                let self = this
                return self.votes;
            }
        },
        mounted() {
            let vm = this;
            $.ajax({
                url: '../api/votes',
                success(res) {
                    vm.votes = res;
                }
            });
            console.log(this.votes)
        },
        methods:{
            truncate(){
                fetch('../api/deleteAll')
                .then(res => res.json())
                .then(data => {
                    if(data == "ok"){
                        location.reload()
                    }
                    // this.$toastr.s(data);
                })
                .catch(err=>this.$toastr.e(err));
            }
        }
    }
</script>
