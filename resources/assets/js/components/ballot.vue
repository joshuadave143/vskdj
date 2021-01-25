<template>
    <div class="col-xs-10 col-xs-offset-1">
        <div v-for="position in positions" v-bind:key="position.position_id" class="row">
            <div :id="position.position_id" class="portlet box blue" >
                
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-tasks"></i><b>{{position.description}}</b>
                    </div>
                    <div class="tools">
                        
                        <button v-if="position.priority == 1" disabled type="button" class="btn btn-default btn-sm moveup" data-id="position.position_id" @click="up(position.position_id)"><i class="fa fa-arrow-up"></i> </button>
                        <button v-else type="button" class="btn btn-default btn-sm moveup" data-id="position.position_id" @click="up(position.position_id)"><i class="fa fa-arrow-up"></i> </button>
                        
                        <button v-if="position.priority == positions.length" disabled type="button" class="btn btn-default btn-sm movedown" @click="down(position.position_id)"><i class="fa fa-arrow-down"></i></button>
                        <button v-else type="button" class="btn btn-default btn-sm movedown" @click="down(position.position_id)"><i class="fa fa-arrow-down"></i></button>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="form-body">
                        <p v-if="position.max_vote > 1">You may select up to {{ position.max_vote }} candidates</p>
                        <p v-else>Select only one candidate
                        
                        </p>
                        <div id="candidate_list">
                            <ul class="list-group list-group-flush">
                                
                                <li class="list-group-item" v-for="candidate in position.candiList" v-bind:key="candidate.candidate_id" >
                                    <!-- <input type="checkbox" class="flat-red sample" name="sample[]" style="position: absolute; opacity: 0;"> -->
                                    
                                    <input v-if="position.max_vote == 1" type="radio" class="chckbox" value="">
                                    <input v-else type="checkbox" class="chckbox" value="">
                                    <button data-toggle="modal" data-target="#platformModal" @click="viewPlatform(candidate.lastname+', '+candidate.firstname+' '+candidate.MI, candidate.platform)" class="btn btn-info btn-sm btn-flat det">
                                        <i class="fa fa-search"></i>
                                        Platform
                                    </button>
                                    <img :src="candidate.photo" height="100px" width="100px" class="det">
                                    <span class="det name">{{candidate.lastname}}, {{candidate.firstname}}</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
        <div class="modal fade" id="platformModal" tabindex="-1" role="basic" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                        <h4 class="modal-title" id="candiName">PLATFORM</h4>
                    </div>
                    <div class="modal-body">
                        <P id="platformText">TEST</P>                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
    </div>
</template>

<script>
export default {
    data(){
        return{
            positions:[],
            position:{
                position_id:'',
                priority:0
            },
            candidates:[]
        }        
    },
    created(){
        this.fetchBallotPositions();
    },
    methods:{
        fetchBallotCandidates(id){
            let vm = this;
            var ress = [];
            fetch(`../api/ballot/getCandidates/${id}`)
            .then(res => res.json())
            .then(res => {
                var e = 0
                // console.log(res)
                for ( var i = 0; i < this.positions.length; i++ ){
                    if(this.positions[i].position_id == id){
                        this.positions[i].candiList = res
                        console.log( this.positions)
                        e++
                    }
                }
                
            })
            .catch(err => console.log(err));
        },
        viewPlatform(name,platform){
            $('#candiName').html(name)
            $("#platformText").html(platform);
        },
        fetchBallotPositions(){
            let vm = this
            fetch('../api/ballot/positions')
            .then(res => res.json())
            .then(res => {
                res.forEach(function(element) {
                    vm.updatePosition(element.position_id)
                    
                    vm.fetchBallotCandidates(element.position_id)
                });

                console.log(res)
                this.positions = res
               
            })
            .catch(err => console.log(err));
        },
        updatePosition(id){
            this.position.priority++;
            this.position.position_id = id;
            fetch('../api/ballot', {
                method: 'put',
                body: JSON.stringify(this.position),
                headers:{
                    'Content-Type': 'application/json'
                }
            })
            .then(res => res.json())
            .then(data => {
                // console.log(data) 
                this.position.priority = 0;  
                this.position.position_id =''
            })
            .catch(err => this.$toastr.e(err))
        },
        up(id){
            
            var ids = {'position_id':id}
            fetch('../api/moveup', {
                method: 'put',
                body: JSON.stringify(ids),
                headers:{
                    'Content-Type': 'application/json'
                }
            })
            .then(res => res.json())
            .then(data => {
                console.log(data.position_id) 
                
                this.fetchBallotPositions(); 
            })
            .catch(err => this.$toastr.e(err))
        },
        down(id){
            var ids = {'position_id':id}
            fetch('../api/movedown', {
                method: 'put',
                body: JSON.stringify(ids),
                headers:{
                    'Content-Type': 'application/json'
                }
            })
            .then(res => res.json())
            .then(data => {
                console.log(data.position_id) 
                
                this.fetchBallotPositions(); 
            })
            .catch(err => this.$toastr.e(err))
        }
    }
}
</script>