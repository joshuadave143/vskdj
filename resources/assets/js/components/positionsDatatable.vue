<template>
    <div class="portlet-body">
        <div class="table-toolbar">
            <div class="btn-group">
                <button @click="newForm()" id="voters_new" class="btn btn-success" data-toggle="modal" data-target="#positionForm">
                    Add New <i class="fa fa-plus"></i>
                </button>
            </div>
        </div>
        <table class="table table-striped table-bordered table-hover" id="positions">
        <thead>
        <tr>
            <th>
                    Description
            </th>
            <th>
                    Maximum Vote
            </th>
            <th>
                    Actions
            </th>
        </tr>
        </thead>
        <tbody>
            <tr v-for="position in positions" v-bind:key="position.id">
                <td>{{ position.description }}</td>
                <td>{{ position.max_vote }}</td>
                <td>
                    <button class="btn btn-danger" @click="deletePosition(position.position_id)">Delete</button>
                    <button data-toggle="modal" data-target="#positionForm" class="btn btn-warning" @click="editPosition(position)" >Edit</button>
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
                            <a href="#" onClick="return false;" title="First"  @click="fetchPositions(pagination.first)">
                                <i class="fa fa-angle-double-left"></i>
                                </a>
                        </li>
                        <li class="prev" v-bind:class="[{disabled: !pagination.prev_page_url}]">
                            <a href="#" onClick="return false;" title="Prev" @click="fetchPositions(pagination.prev_page_url)">
                                <i class="fa fa-angle-left"></i>
                            </a>
                        </li>
                        <li class="prev disabled">
                            <a href="#" title="Prev">
                                Page {{ pagination.current_page }} of {{ pagination.last_page }}
                            </a>
                        </li>
                        <li class="next" v-bind:class="[{disabled: !pagination.next_page_url}]">
                            <a href="#" onClick="return false;" title="Next" @click="fetchPositions(pagination.next_page_url)">
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </li>
                        <li class="next" v-bind:class="[{disabled: !pagination.next_page_url}]">
                            <a href="#" onClick="return false;" title="Last" @click="fetchPositions(pagination.last)">
                                <i class="fa fa-angle-double-right"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        
        <form @submit.prevent="addPosition">
            <div class="modal fade" id="positionForm" tabindex="-1" role="basic" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                            <h4 class="modal-title">Position</h4>
                        </div>
                        <div class="modal-body">
                            
                                <div class="form-group">
                                    <label for="Description">Description</label>
                                    <input v-model="position.description" type="text" class="form-control" placeholder="Description" required>
                                </div>
                                <div class="form-group">
                                    <label for="max_vote">Max vote</label>
                                    <input v-model="position.max_vote" type="number" class="form-control" placeholder="Max vote" required>
                                    <span class="help-block">
                                            <!-- <CODE>NOTE</CODE> Lastname, Firstname MI -->
                                    </span>
                                </div>                          
                        </div>
                        <div class="modal-footer">
                            <button type="button" @close="close()" class="btn btn-default" id="close" data-dismiss="modal">Close</button>
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
            positions:[],
            position:{
                position_id:'',
                description:'',
                max_vote:''
            },
            position_id:'',
            pagination:{},
            last_visit_page:'',
            edit:false,
        }        
    },
    created(){
        this.fetchPositions();
    },
    methods:{
        fetchPositions(page_url){
            let vm = this;
            page_url = page_url || '../api/positions';
            fetch(page_url)
            .then(res => res.json())
            .then(res => {
                // console.log(res.data);
                this.positions = res.data
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
        deletePosition(id){
            if(confirm('Are you sure?')){
                fetch(`../api/position/${id}` , {
                    method: 'delete'
                })
                .then(res => res.json())
                .then(data => {
                    this.$toastr.s('Position Removed');
                    this.fetchPositions(this.last_visit_page)
                })
                .catch(error => console.log(error))
            }
        },
        
        addPosition(){
            let vm = this;
            if(this.edit === false){
                fetch('../api/position', {
                    method: 'post',
                    body: JSON.stringify(this.position),
                    headers:{
                        'Content-Type': 'application/json'
                    }
                })
                .then(res => res.json())
                .then(data => {
                    console.log(data)
                    this.position.description = '';
                    this.position.max_vote = '';
                    
                     this.$toastr.s('Position Added');
                     $("#positionForm").click()
                    this.fetchPositions();

                })
                .catch(err => console.log(err))
            }
            else{
                // update
                fetch('../api/position', {
                    method: 'put',
                    body: JSON.stringify(this.position),
                    headers:{
                        'Content-Type': 'application/json'
                    }
                })
                .then(res => res.json())
                .then(data => {
                    console.log(data)
                    this.position.position_id = '';
                    this.position.description = '';
                    this.position.max_vote = '';
                    
                    this.$toastr.s('Position Updated');
                    $("#positionForm").click()
                    this.fetchPositions();
                    this.edit = false;

                })
                .catch(err => console.log(err))
            }
        },
        editPosition(position){
            this.edit = true;
            this.position.position_id = position.position_id;
            this.position.description = position.description;
            this.position.max_vote = position.max_vote;
            console.log(position);
        },
        close(){
            this.edit = false;
            this.position.position_id = '';
            this.position.description = '';
            this.position.max_vote = '';
        },
        newForm(){
            this.close();
        }
    }
}
</script>