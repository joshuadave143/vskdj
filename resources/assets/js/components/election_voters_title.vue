<template>

    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN PAGE TITLE & BREADCRUMB-->
            <h2 class="page-title" style="text-align: center;font-size: -webkit-xxx-large; font-weight: bold !important;">
                {{title.name[0]}}
            </h2>
            
            <!-- END PAGE TITLE & BREADCRUMB-->
        </div>
    </div>
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
            
            fetch('../api/getconfig')
            .then(res => res.json())
            .then(res => {
               
                this.title.name = res
                //  console.log(this.title.name);
            })
            .catch(err =>  this.$toastr.e(err));
        }
    }
 
}
</script>
