<template>
  <div class="hello">
    <table ref="suppliersTable" id="suppliersTable" class="table table-hover table-nomargin table-bordered dataTable">
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
  </div>
</template>

<script>
// import faker from 'faker';
const $ = require('jquery');
// import $ from "jquery";

const dt = require('datatables.net');
// var $ = require( 'jquery' );

// const dt = require( 'datatables.net' )( );
// console.log(dt)
export default {
  data() {
    return {
        suppliers: [],
        voters:[],
        voter:{
            voter_id:'',
            student_id:'',
            name:'',
            course:''
        },
        voter_id:'',
    };
  },
//   created(){
//       this.fetchVoters()
//   },
  mounted() {
    
    setTimeout(() => this.fetchVoters(), 1000);
    
  },
  methods:{
        fetchVoters(){
            let vm = this;
            var page_url =  '../api/voters';
            // this.last_visit_page = page_url;
            fetch('../api/voters')
            .then(res => res.json())
            .then(res => {
                // console.log(res.data);
                this.dt = $('#suppliersTable').DataTable({
                    data: res.data
                });
                this.voters = res.data
            })
            .catch(err => console.log(err));
        }
  },
  watch: {
    suppliers(val) {
      this.dt.destroy();
      this.$nextTick(() => {
        this.dt = $(this.$refs.suppliersTable).DataTable()
      })
    }
  }
};

</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<!--<style src="./jquery.datatables.css"/>-->
