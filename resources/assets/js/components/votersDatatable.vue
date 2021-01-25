<template>
    <div class="portlet-body">
        <div class="table-toolbar">
            <div class="btn-group">
                <button @click="newForm()" id="voters_new" class="btn btn-success" data-toggle="modal" data-target="#voterForm">
                    Add New <i class="fa fa-plus"></i>
                </button>
                <a href="voters/import" class="btn btn-success"> Add CSV <i class="fa fa-file"></i></a>
                
            </div>
            <div class="row">
                <div class="col-md-6 col-sm-12">
                </div>
                <div class="col-md-6 col-sm-12">
                    <div class="dataTables_filter" id="filter">
                        <label>Search: 
                            <input type="text"  v-model="search" @change="searchVoter()" class="form-control input-medium">
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <table ref="voters" class="table table-striped table-bordered table-hover" id="voters">
        <thead>
        <tr>
            <th>
                    No
            </th>
            <th>
                    Student ID
            </th>
            <th>
                    Name
            </th>
            <th>
                    Course
            </th>
            <th>
                    Actions
            </th>
        </tr>
        </thead>
        <tbody>
            <tr v-for="voter in voters" v-bind:key="voter.id">
                <td>{{ voter.voter_id }}</td>
                <td>{{ voter.student_id }}</td>
                <td>{{ voter.name }}</td>
                <td>{{ voter.course }}</td>
                <td>
                    <button class="btn btn-danger" @click="deleteVoter(voter.voter_id)">Delete</button>
                    <button data-toggle="modal" data-target="#voterForm" class="btn btn-warning" @click="editVoter(voter)" >Edit</button>
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
                    <ul v-if="search == ''" class="pagination">
                        <li  class="prev" v-bind:class="[{disabled: !pagination.prev_page_url}]">
                            <a href="#" onClick="return false;" title="First"  @click="fetchVoters(pagination.first)">
                                <i class="fa fa-angle-double-left"></i>
                                </a>
                        </li>
                        <li class="prev" v-bind:class="[{disabled: !pagination.prev_page_url}]">
                            <a href="#" onClick="return false;" title="Prev" @click="fetchVoters(pagination.prev_page_url)">
                                <i class="fa fa-angle-left"></i>
                            </a>
                        </li>
                        <li class="prev disabled">
                            <a href="#" title="Prev">
                                Page {{ pagination.current_page }} of {{ pagination.last_page }}
                            </a>
                        </li>
                        <li class="next" v-bind:class="[{disabled: !pagination.next_page_url}]">
                            <a href="#" onClick="return false;" title="Next" @click="fetchVoters(pagination.next_page_url)">
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </li>
                        <li class="next" v-bind:class="[{disabled: !pagination.next_page_url}]">
                            <a href="#" onClick="return false;" title="Last" @click="fetchVoters(pagination.last)">
                                <i class="fa fa-angle-double-right"></i>
                            </a>
                        </li>
                    </ul>
                    <ul v-else class="pagination">
                        <li  class="prev" v-bind:class="[{disabled: !pagination.prev_page_url}]">
                            <a href="#" onClick="return false;" title="First"  @click="searchVoter(pagination.first)">
                                <i class="fa fa-angle-double-left"></i>
                                </a>
                        </li>
                        <li class="prev" v-bind:class="[{disabled: !pagination.prev_page_url}]">
                            <a href="#" onClick="return false;" title="Prev" @click="searchVoter(pagination.prev_page_url)">
                                <i class="fa fa-angle-left"></i>
                            </a>
                        </li>
                        <li class="prev disabled">
                            <a href="#" title="Prev">
                                Page {{ pagination.current_page }} of {{ pagination.last_page }}
                            </a>
                        </li>
                        <li class="next" v-bind:class="[{disabled: !pagination.next_page_url}]">
                            <a href="#" onClick="return false;" title="Next" @click="searchVoter(pagination.next_page_url)">
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </li>
                        <li class="next" v-bind:class="[{disabled: !pagination.next_page_url}]">
                            <a href="#" onClick="return false;" title="Last" @click="searchVoter(pagination.last)">
                                <i class="fa fa-angle-double-right"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        
        <form @submit.prevent="addVoter">
            <div class="modal fade" id="voterForm" tabindex="-1" role="basic" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                            <h4 class="modal-title">Voter</h4>
                        </div>
                        <div class="modal-body">
                            
                                <div class="form-group">
                                    <label for="Student_ID">Student ID</label>
                                    <input v-model="voter.student_id" type="text" class="form-control" placeholder="Student ID" required>
                                </div>
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input v-model="voter.name" type="text" class="form-control" placeholder="Name" required>
                                    <span class="help-block">
                                            <CODE>NOTE</CODE> Lastname, Firstname MI
                                    </span>
                                </div>
                                <div class="form-group">
                                    <label for="course">Course</label>
                                    <input v-model="voter.course" type="text" class="form-control" placeholder="course" required>
                                </div>                           
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" @click="close()" id="close" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-info">Save</button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
        </form>
    </div>

</template>

<script>

export default {
    data(){
        return{
            voters:[],
            voter:{
                voter_id:'',
                student_id:'',
                name:'',
                course:''
            },
            voter_id:'',
            pagination:{},
            last_visit_page:'',
            search:'',
            edit:false,
        }        
    },
    created(){
        this.fetchVoters();
    },
    watch:{
        search(val) {
            if(this.search == ''){
                this.fetchVoters()
            }else{
                this.searchVoter();
            }
            
        }
    },
    methods:{
        fetchVoters(page_url){
            let vm = this;
            page_url = page_url || '../api/voters';
            this.last_visit_page = page_url;
            fetch(page_url)
            .then(res => res.json())
            .then(res => {
                // console.log(res.data);
                this.voters = res.data
                vm.makePagination(res.meta, res.links)
            })
            .catch(err => console.log(err));
        },
        searchVoter(page_url){
            // console.log(page_url)
            var searchs = {
                search:this.search
            }
            // console.log(searchs)
            // return 
            let vm = this;
            page_url = page_url || '../api/voter/search';
            this.last_visit_page = page_url;
            fetch(page_url,{
                method: 'put',
                body: JSON.stringify(searchs),
                headers:{
                    'Content-Type': 'application/json'
                }
            })
            .then(res => res.json())
            .then(res => {
                // console.log(res.data);
                this.voters = res.data
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
        deleteVoter(id){
            if(confirm('Are you sure?')){
                fetch(`../api/voter/${id}` , {
                    method: 'delete'
                })
                .then(res => res.json())
                .then(data => {
                    this.$toastr.s('Voter Removed');
                    this.fetchVoters(this.last_visit_page)
                })
                .catch(error => console.log(error))
            }
        },
        addVoter(){
            let vm = this;
            if(this.edit === false){
                fetch('../api/voter', {
                    method: 'post',
                    body: JSON.stringify(this.voter),
                    headers:{
                        'Content-Type': 'application/json'
                    }
                })
                .then(res => res.json())
                .then(data => {
                    console.log(data)
                    this.voter.student_id = '';
                    this.voter.name = '';
                    this.voter.course = '';
                    $("#voterForm").click()
                    this.$toastr.s('Voter Added');
                    this.fetchVoters();

                })
                .catch(err => console.log(err))
            }
            else{
                // update
                fetch('../api/voter', {
                    method: 'put',
                    body: JSON.stringify(this.voter),
                    headers:{
                        'Content-Type': 'application/json'
                    }
                })
                .then(res => res.json())
                .then(data => {
                    console.log(data)
                    this.voter.student_id = '';
                    this.voter.voter_id ='';
                    this.voter.name = '';
                    this.voter.course = '';
                    
                    this.$toastr.s('Voter Updated');
                    $("#voterForm").click()
                    this.fetchVoters();
                    this.edit = false;


                })
                .catch(err => console.log(err))
            }
        },
        editVoter(voter){
            this.edit = true;
            this.voter.voter_id = voter.voter_id;
            this.voter.student_id = voter.student_id;
            this.voter.name = voter.name;
            this.voter.course = voter.course;
        },
        close(){
            this.edit = false;
            this.voter.voter_id = '';
            this.voter.student_id = '';
            this.voter.name = '';
            this.voter.course ='';
        },
        newForm(){
            this.close();
        }
    }
}
</script>

