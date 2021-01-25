<template>
    <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h2>{{positions}}</h2>

              <p>No. of Positions</p>
            </div>
            <div class="icon">
              <i class="fa fa-tasks"></i>
            </div>
            <a href="/admin/positions" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h2>{{candidates}}</h2>
          
              <p>No. of Candidates</p>
            </div>
            <div class="icon">
              <i class="fa fa-male"></i>
            </div>
            <a href="/admin/candidates" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h2>{{voters}}</h2>
             
              <p>Total Voters</p>
            </div>
            <div class="icon">
              <i class="fa fa-group"></i>
            </div>
            <a href="/admin/voters" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h2>{{votes}}</h2>

              <p>Voters Voted</p>
            </div>
            <div class="icon">
              <i class="fa fa-edit"></i>
            </div>
            <a href="/admin/votes" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div>
</template>
<script>

export default {
    data(){
        return{
            candidates:'',
            positions:'',
            voters:'',
            votes:'',
            timer: ''
        }        
    },
    created(){
        this.fetchData()
        this.timer = setInterval(this.fetchData, 3000)
    },
    methods:{
        fetchData(){
            
            fetch('../api/get_total_PCVV')
            .then(res => res.json())
            .then(data => {
                this.candidates = data.cand;
                this.positions = data.pos;
                this.voters = data.voters;
                this.votes = data.votes
                // console.log(data)
            })
            .catch(err => console.log(err))
        },
    }
}
</script>
