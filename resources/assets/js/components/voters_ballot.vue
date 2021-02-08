<template>
    <div class="col-xs-10 col-xs-offset-1">
        <div id="startID" class="portlet col-md-6 col-xs-offset-3">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-barcode"></i> LOGIN
                </div>
            </div>
            <div class="portlet-body form">
                <div class="form-body">
                    <div class="form-group">
                        <!-- <h4 class="block">ID NUMBER</h4> -->
                        <div class="form-group">
                            <label for="exampleInputEmail1">ID NUMBER</label>
                            <input v-model="student_id" type="text" class="form-control" placeholder="ID NUMBER" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">PASSCODE</label>
                            <input v-model="passcode" type="PASSWORD" class="form-control" placeholder="PASSCODE" required>
                        </div>
                            
                    </div>
                </div>
                <div class="form-actions">
                    <button type="button"  @click="getvoterDetials()" class="btn btn-info">Login</button>
                </div>
            </div>
        </div>
        
        <div class="listc" style="display: none;">
            <div class="portlet-body form">
                    <!-- BEGIN FORM-->
                    <form class="form-horizontal" role="form">
                        <div class="form-body">
                            <h3 class="form-section">Voter's Info</h3>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">ID No.:</label>
                                        <div class="col-md-9">
                                            <p class="form-control-static">
                                                    <b>{{voters.student_id}}</b>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <!--/span-->
                            </div>
                            <!--/row-->
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Name:</label>
                                        <div class="col-md-9">
                                            <p class="form-control-static">
                                                    <b>{{voters.name}}</b>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <!--/span-->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Position:</label>
                                        <div class="col-md-9">
                                            <p class="form-control-static">
                                                    <b>{{voters.course}}</b>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <!--/span-->
                            </div>
                            
                        </div>
                        
                    </form>
                        <!-- END FORM-->
            </div>
            <form id="poss">
                <div v-for="position in positions" v-bind:key="position.position_id" class="row">
                    <div :id="position.position_id" class="portlet box blue"  >
                        
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa fa-tasks"></i><b>{{position.description}}</b>
                            </div>
                            
                            <div class="tools">
                                <a href="javascript:;" class="collapse"></a>
                                <a href="javascript:;" class="reload" @click="reset(position.description)"></a>
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
                                            
                                            <input v-if="position.max_vote == 1" type="radio"  class="chckbox" :class="position.description" v-bind:name="position.description" :value="candidate.candidate_id">

                                            <input v-else type="checkbox" class="chckbox" :class="position.description" v-bind:name="position.description+'[]'" :value="candidate.candidate_id">

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
            
                <div class="text-center">
                    <button type="button" @click="Preview()" class="btn btn-success btn-flat" ><i class="fa fa-file-text"></i> Preview</button> 
                    <button type="button" data-toggle="modal" data-target="#votePreview" id="preview" hidden></button> 
                    <button type="button" @click="submit()" class="btn btn-primary btn-flat" name="vote"><i class="fa fa-check-square-o"></i> Submit</button>
                </div>
            </form>
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

        <div class="modal fade" id="votePreview" tabindex="-1" role="basic" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                        <h4 class="modal-title" id="candiName">VOTE PREVIEW</h4>
                    </div>
                    <div class="modal-body">
                        <span v-html="result"></span>                  
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
            candidates:[],
            voters:[],
            voter_id:'',
            votes:[],
            student_id:'',
            passcode:'',
            result:""

        }        
    },
    created(){
        this.fetchBallotPositions();
    },
    methods:{
        reset(name){
            // var desc = $(this).data('desc');
            $('.'+name).iCheck('uncheck');
        },
        submit(){
            this.votes = $('#poss').serialize();
            if( this.votes == "" ){
                this.$toastr.e('Please vote atleast one candidate');
                return
            }
            this.votes  = this.votes +"&voter_id="+this.voter_id;
            console.log($.deparam(this.votes))
            fetch('../api/voter/submitvotes', {
                method: 'post',
                body: JSON.stringify($.deparam(this.votes)),
                headers:{
                    'Content-Type': 'application/json'
                }
            })
            .then(res => res.json())
            .then(data => {
                if(!data.error){
		    //this.positions.description
		    //this.positions.forEach(function(posi){
			//$('.'+posi.description).iCheck('uncheck');
		     //})
		    
                    this.$toastr.s('Ballot Submitted');
                    this.student_id = ""
                    this.passcode   = ""
                    $('#startID').show()
                    $('.listc').hide('fold')
                }
                
            })
            .catch(err => console.log(err))
        },
        Preview(){
            this.votes = $('#poss').serialize();
            if( this.votes == "" ){
                this.$toastr.e('You must vote atleast one candidate');
                return
            }
            fetch('../api/voter/votesprev', {
                method: 'post',
                body: JSON.stringify($.deparam(this.votes)),
                headers:{
                    'Content-Type': 'application/json'
                }
            })
            .then(res => res.json())
            .then(data => {
                if(!data.error){
                    this.result = data.list
                    $( "#preview" ).click()
                }
                // console.log(data)
                
            })
            .catch(err => console.log(err))
        },
        getvoterDetials(){
            if(this.passcode == "" && this.student_id == ""){
                this.$toastr.e("Please enter ID NUMBER and PASSCODE!");
                return
            }
            else if(this.passcode == ""){
                this.$toastr.e("Please enter PASSCODE!");
                return
            }
            else if(this.student_id == ""){
                this.$toastr.e("Please enter ID NUMBER!");
                return
            }
            fetch(`../api/voter_page/get_voter_info=${this.student_id}&${this.passcode}`)
            .then(res => res.json())
            .then(res => {
                if( res.msg != undefined ){
                    this.$toastr.w(res.msg);
                    return
                }
                this.voters = res
                this.voter_id = res.voter_id
                //  console.log(res.voter_id);
                $('#startID').hide('fold')
                $('.listc').show()
                
                //  this.$toastr.s('Voter Removed');
            })
            .catch(err => console.log(err));
        },
        fetchBallotCandidates(id){
            //$('.listc').hide()
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
                        // console.log( this.positions)
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
            var can = {'can':''}
            fetch('../api/ballot/positions')
            .then(res => res.json())
            .then(res => {
                res.forEach(function(element) {                    
                    vm.fetchBallotCandidates(element.position_id)
                });
                this.positions = res
               
            })
            .catch(err => console.log(err));
        }
    }
}
</script>