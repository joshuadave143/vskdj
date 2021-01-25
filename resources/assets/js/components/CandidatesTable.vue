<template>
    <div class="portlet-body">
        <div class="table-toolbar">
            <div class="btn-group">
                <button class="btn btn-success" data-toggle="modal" @click="newForm()" data-target="#candidateForm">
                    Add New <i class="fa fa-plus"></i>
                </button>
            </div>
        </div>
        <table class="table table-striped table-bordered table-hover" id="positions">
        <thead>
        <tr>
            <th>
                    Position
            </th>
            <th>
                    Photo
            </th>
            <th>
                    Firstname
            </th>
            <th>
                    Lastname
            </th>
            <th>
                    MI
            </th>
            <th>
                    Platform
            </th>
            <th>
                    Actions
            </th>
        </tr>
        </thead>
        <tbody>
            <tr v-for="candidate in candidates" v-bind:key="candidate.id">
                <td>{{ candidate.positions['description'] }}</td>
                <td><img :src="candidate.photo"  alt=""  style="height: 90px;width: auto;"> </td>
                <td>{{ candidate.firstname }}</td>
                <td>{{ candidate.lastname }}</td>
                <td>{{ candidate.MI }}</td>
                <td>
                    <button data-toggle="modal" data-target="#platformModal" @click="viewPlatform(candidate.lastname+', '+candidate.firstname+' '+candidate.MI, candidate.platform)" class="btn btn-info btn-sm btn-flat"><i class="fa fa-search"></i>View</button>
                </td>
                <td>
                    <button class="btn btn-danger" @click="deleteCandidate(candidate.candidate_id)">Delete</button>
                    <button data-toggle="modal" data-target="#candidateForm" class="btn btn-warning" @click="editCandidate(candidate)" >Edit</button>
                </td>
            </tr>
        </tbody>
        </table>
        <div class="row">
            <div class="col-md-5 col-sm-12">
                <div class="dataTables_info">Total: {{ pagination.entries }} entries
                </div>
            </div>
            <div class="col-md-7 col-sm-12">
                <div class="dataTables_paginate paging_bootstrap_full_number">
                    <ul class="pagination">
                        <li  class="prev" v-bind:class="[{disabled: !pagination.prev_page_url}]">
                            <a href="#" onClick="return false;" title="First"  @click="fetchCandidates(pagination.first)">
                                <i class="fa fa-angle-double-left"></i>
                                </a>
                        </li>
                        <li class="prev" v-bind:class="[{disabled: !pagination.prev_page_url}]">
                            <a href="#" onClick="return false;" title="Prev" @click="fetchCandidates(pagination.prev_page_url)">
                                <i class="fa fa-angle-left"></i>
                            </a>
                        </li>
                        <li class="prev disabled">
                            <a href="#" title="Prev">
                                Page {{ pagination.current_page }} of {{ pagination.last_page }}
                            </a>
                        </li>
                        <li class="next" v-bind:class="[{disabled: !pagination.next_page_url}]">
                            <a href="#" onClick="return false;" title="Next" @click="fetchCandidates(pagination.next_page_url)">
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </li>
                        <li class="next" v-bind:class="[{disabled: !pagination.next_page_url}]">
                            <a href="#" onClick="return false;" title="Last" @click="fetchCandidates(pagination.last)">
                                <i class="fa fa-angle-double-right"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- enctype="multipart/form-data" -->
        <form @submit.prevent="addCandidate" >
            <div class="modal fade" id="candidateForm" tabindex="-1" role="basic" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                            <h4 class="modal-title">Candidate</h4>
                        </div>
                        <div class="modal-body">
                            <div class="form-horizontal">
                                <div class="form-group">
                                    <label for="firstname" class="col-sm-3 control-label">Firstname</label>

                                    <div class="col-sm-9">
                                    <input v-model="candidate.firstname" type="text" class="form-control" id="firstname" name="firstname" required="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="MI" class="col-sm-3 control-label">MI</label>

                                    <div class="col-sm-9">
                                    <input v-model="candidate.MI" type="text" class="form-control" id="MI" name="MI" maxlength="1" required="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="lastname" class="col-sm-3 control-label">Lastname</label>

                                    <div class="col-sm-9">
                                    <input v-model="candidate.lastname" type="text" class="form-control" id="lastname" name="lastname" required="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="position" class="col-sm-3 control-label">Position</label>

                                    <div class="col-sm-9">
                                        <select v-model="candidate.position_id" name="position" class="form-control" tabindex="12" required>
                                            <option value="" selected="">- Select -</option>
                                            <option v-for="position in positions"  v-bind:key="position.id" :value="position.position_id">{{position.description}}</option>

                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="photo" class="col-sm-3 control-label">Photo</label>

                                    <div class="col-sm-9">
                                    <!-- <input type="file" id="photo" name="photo" v-on:change="onFileChange"> -->
                                        <input type="file" @change="onFileChange" name="file" id="file" class="form-control" required>
                                        <div id="preview-pane" class="img-preview" v-show="image.length">
                                            <div class="preview-container" >
                                                <img :src="image" style="width: 247px;">
                                               
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="platform" class="col-sm-3 control-label">Platform</label>

                                    <div class="col-sm-9">
                                    <textarea v-model="candidate.platform" class="form-control" id="platform" name="platform" rows="7" required></textarea>
                                    </div>
                                </div>
                            </div>                         
                        </div>
                        <div class="modal-footer">
                            <button type="button" @click="close" class="btn btn-default" id="close" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-info">Save</button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
        </form>
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
import axios from 'axios';
export default {
    data(){
        return{
            candidates:[],
            candidate:{ 
                candidate_id:'',
                firstname:'',
                lastname:'',
                MI:'',
                photo:'',
                platform:'',
                position_id: ''
            },
            candidate_id:'',
            positions:[],
            file:null,
            image:[],
            pagination:{},
            edit:false,
        }        
    },
    created(){
        this.fetchCandidates();
        this.listOfPositions();
    },
    methods:{
        viewPlatform(name,platform){
            $('#candiName').html(name)
            $("#platformText").html(platform);
        },
        listOfPositions(){
            fetch('../api/positions')
            .then(res => res.json())
            .then(res => {
                this.positions = res.data
            })
            .catch(err => console.log(err));
        },
        fetchCandidates(page_url){
            let vm = this;
            page_url = page_url || '../api/candidates';
            fetch(page_url)
            .then(res => res.json())
            .then(res => {
                this.candidates = res.data
                // console.log(this.candidates)
                vm.makePagination(res.meta, res.links)
            })
            .catch(err => console.log(err));
        },
        makePagination(meta, links){
            let pagination = {
                current_page: meta.current_page,
                last_page: meta.last_page,
                next_page_url: links.next,
                prev_page_url: links.prev,
                entries: meta.total,
                last: links.last,
                first: links.first
            }; 

            this.pagination = pagination;
        },
        onFileChange(e){
            e.preventDefault();
            e.stopPropagation();

            const file = e.target.files[0];
           
            this.addImage(file)
            // Array.from(file).forEach(fiel => this.addImage(file));
           
        },
        addImage(file){
            // console.log(file)
            this.image=[];
            if(file.type !== 'image/jpeg' && file.type !== 'image/png'){
                this.$toastr.e(`${file.name} is not an image`);
                $('#file').val('')
                return;
            }
            this.file = file;
           
            const reader = new FileReader();
            
            reader.onload = (e) => this.image = e.target.result
           
            reader.readAsDataURL(file)
        },
        close(){
            this.file=[];
            this.image=[];
            $('#file').val('')
            $('#file').attr("required", "true");
            this.candidate.candidate_id = '';
            this.candidate.firstname = '';
            this.candidate.lastname = '';
            this.candidate.position_id = '';
            this.candidate.MI = '';
            this.candidate.platform = '';
            this.candidate.photo = '';
            this.edit = false;
        },
        newForm(){
            this.close();
        },
        deleteCandidate(id){
            if(confirm('Are you sure?')){
                fetch(`../api/candidate/${id}` , {
                    method: 'delete'
                })
                .then(res => res.json())
                .then(data => {
                    this.$toastr.s('Candidate Removed');
                    this.fetchCandidates()
                })
                .catch(error => this.$toastr.e(error))
            }
        },
        addCandidate(){
            let vm = this;
            
            if(this.edit === false){
                // 
                var fname = this.candidate.firstname.split(/[ ,]+/).filter(function(v){return v!==''}).join('-')
                var lname = this.candidate.lastname.split(/[ ,]+/).filter(function(v){return v!==''}).join('-')
                this.candidate.photo = fname +'-'+ this.candidate.MI +'-'+ lname +'.'+this.file.name.split(".")[1];
                console.log(this.candidate)
                // return
                fetch('../api/candidate', {
                    method: 'post',
                    body: JSON.stringify(this.candidate),
                    headers:{
                        'Content-Type': 'application/json'
                    }
                })
                .then(res => res.json())
                .then(data => {
                   
                    this.candidate.firstname = '';
                    this.candidate.lastname = '';
                    this.candidate.position_id = '';
                     $('#file').val('')
                    this.candidate.MI = '';
                    this.candidate.platform = '';
                    this.uploadImage();
                    this.$toastr.s('Candidate Added');
                    
                })
                .catch(err => this.$toastr.e(err))
            }
            else{
                // update
                if(  $('#file').val() == '' ){
                    this.candidate.photo = null;
                }else{
                    var fname = this.candidate.firstname.split(/[ ,]+/).filter(function(v){return v!==''}).join('-')
                    var lname = this.candidate.lastname.split(/[ ,]+/).filter(function(v){return v!==''}).join('-')
                    var imagename = fname +'-'+ this.candidate.MI +'-'+ lname +'.'+ this.file.name.split(".")[1];
                    this.candidate.photo = imagename;
                }
                
                // console.log(photo)
                fetch('../api/candidate', {
                    method: 'put',
                    body: JSON.stringify(this.candidate),
                    headers:{
                        'Content-Type': 'application/json'
                    }
                })
                .then(res => res.json())
                .then(data => {
                    this.candidate.firstname = '';
                    this.candidate.lastname = '';
                    this.candidate.position_id = '';
                    this.candidate.MI = '';
                    this.candidate.platform = '';
                    if(  $('#file').val() != '' ){
                        this.uploadImage();
                    }else{
                        this.fetchCandidates();
                        $("#candidateForm").click()
                    }
                    $('#file').val('')
                    
                    this.$toastr.s('Candidate Updated');
                    this.edit = false;

                })
                .catch(err => console.log(err))
            }
        },
        uploadImage(){
            // AFTER INSERTING THE DATA WE WILL UPLOAD THE IMAGE

            const formData = new FormData();

            formData.append('image',this.file, this.candidate.photo)
            axios.post('../api/upload', formData)
            .then(res => {
                if(res.data === 'error'){
                    this.$toastr.e('Error Uploading Image!');
                    return
                }
                this.file=[];
                this.image=[];
                this.candidate.photo = ''
                this.fetchCandidates();
                $("#candidateForm").click()
                this.$toastr.s('Image Uploaded!');
            })
        },
        editCandidate(candidate){
            this.edit = true;
            this.file=[];
            this.image=[];
            this.candidate.candidate_id = candidate.candidate_id;
            this.candidate.firstname = candidate.firstname;
            this.candidate.lastname = candidate.lastname;
            this.candidate.MI = candidate.MI;
            this.candidate.position_id = candidate.position_id;
            this.candidate.platform = candidate.platform;
            this.candidate.photo = $('#file').val();
            this.image = candidate.photo;
              
            $('#file').removeAttr("required");
            console.log(this.candidate);
        }
    }
}
</script>
<!--
<style lang="sass">
    @import '~vue-toastr/src/vue-toastr.scss';
</style>
-->